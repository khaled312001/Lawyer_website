<?php

require __DIR__ . '/vendor/autoload.php';

// Check if PhpWord is installed before using it
if (!class_exists('PhpOffice\PhpWord\IOFactory')) {
    echo "❌ خطأ: مكتبة PhpOffice\PhpWord غير مثبتة\n";
    echo "يرجى تثبيتها عبر الأمر التالي:\n";
    echo "composer require phpoffice/phpword\n";
    exit(1);
}

use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Lawyer\app\Models\Lawyer;
use Modules\Lawyer\app\Models\LawyerTranslation;
use App\Models\LawyerSocialMedia;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Set temporary directory for image extraction
if (class_exists('PhpOffice\PhpWord\Settings')) {
    \PhpOffice\PhpWord\Settings::setTempDir(sys_get_temp_dir());
}

echo "=== استيراد المحاميين من ملف Word ===\n\n";

try {
    $docxFile = __DIR__ . '/123l.docx';
    
    if (!file_exists($docxFile)) {
        throw new Exception("الملف {$docxFile} غير موجود");
    }
    
    echo "✓ تم العثور على الملف\n";
    echo "جاري قراءة الملف...\n\n";
    
    // Load the document
    $phpWord = IOFactory::load($docxFile);
    
    // Test database connection
    try {
        DB::connection()->getPdo();
        echo "✓ تم الاتصال بقاعدة البيانات بنجاح\n";
    } catch (\Exception $e) {
        throw new Exception('فشل الاتصال بقاعدة البيانات: ' . $e->getMessage() . "\nيرجى التأكد من:\n1. تشغيل MySQL\n2. وجود قاعدة البيانات 'law'\n3. صحة بيانات الاتصال في ملف .env");
    }
    
    // Get default department and location
    $department = DB::table('departments')->first();
    $location = DB::table('locations')->first();
    
    if (!$department) {
        // Create a default department if none exists
        $departmentId = DB::table('departments')->insertGetId([
            'slug' => 'general-law',
            'status' => 1,
            'show_homepage' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Create translations for the department
        DB::table('department_translations')->insert([
            ['department_id' => $departmentId, 'lang_code' => 'en', 'name' => 'General Law', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => $departmentId, 'lang_code' => 'ar', 'name' => 'القانون العام', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        $department = DB::table('departments')->where('id', $departmentId)->first();
        echo "✓ تم إنشاء قسم افتراضي\n";
    }
    
    if (!$location) {
        // Create a default location if none exists
        $locationId = DB::table('locations')->insertGetId([
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Create translations for the location
        DB::table('location_translations')->insert([
            ['location_id' => $locationId, 'lang_code' => 'en', 'name' => 'Syria', 'created_at' => now(), 'updated_at' => now()],
            ['location_id' => $locationId, 'lang_code' => 'ar', 'name' => 'سوريا', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        $location = DB::table('locations')->where('id', $locationId)->first();
        echo "✓ تم إنشاء موقع افتراضي\n";
    }
    
    echo "✓ تم العثور على القسم والموقع الافتراضي\n";
    
    // Extract images from document
    $imagesDir = public_path('uploads/lawyers/');
    if (!File::exists($imagesDir)) {
        File::makeDirectory($imagesDir, 0755, true);
    }
    
    // Extract images from the document
    $zip = new ZipArchive();
    if ($zip->open($docxFile) === TRUE) {
        $imageIndex = 0;
        $extractedImages = [];
        
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $filename = $zip->getNameIndex($i);
            if (strpos($filename, 'word/media/') === 0) {
                $imageData = $zip->getFromIndex($i);
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                
                if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $imageFileName = 'lawyer-' . time() . '-' . $imageIndex . '.' . $extension;
                    $imagePath = $imagesDir . $imageFileName;
                    file_put_contents($imagePath, $imageData);
                    $extractedImages[] = 'uploads/lawyers/' . $imageFileName;
                    $imageIndex++;
                }
            }
        }
        $zip->close();
        
        echo "✓ تم استخراج " . count($extractedImages) . " صورة\n\n";
    }
    
    // Parse document content
    $sections = $phpWord->getSections();
    $lawyers = [];
    $currentLawyer = null;
    $imageCounter = 0;
    
    foreach ($sections as $section) {
        $elements = $section->getElements();
        
        foreach ($elements as $element) {
            // Handle text elements
            if (method_exists($element, 'getElements')) {
                $textElements = $element->getElements();
                foreach ($textElements as $textElement) {
                    if (method_exists($textElement, 'getText')) {
                        $text = trim($textElement->getText());
                        
                        if (!empty($text)) {
                            // Try to identify lawyer data patterns
                            // This is a flexible parser - adjust based on your document structure
                            
                            // Check if this looks like a name (could be at start of line, bold, etc.)
                            if (empty($currentLawyer) || !empty($currentLawyer['name'])) {
                                // Start new lawyer if we have a name and encounter new data
                                if (!empty($currentLawyer) && !empty($currentLawyer['name'])) {
                                    $lawyers[] = $currentLawyer;
                                    $currentLawyer = null;
                                }
                                
                                // Check if this could be a name
                                if (preg_match('/^[A-Za-z\s\.]+$/', $text) && strlen($text) > 3 && strlen($text) < 50) {
                                    $currentLawyer = [
                                        'name' => $text,
                                        'email' => '',
                                        'phone' => '',
                                        'fee' => 50.00,
                                        'years_of_experience' => '5',
                                        'image' => isset($extractedImages[$imageCounter]) ? $extractedImages[$imageCounter] : null,
                                        'about' => '',
                                        'address' => '',
                                        'educations' => '',
                                        'experience' => '',
                                        'qualifications' => '',
                                    ];
                                    if (isset($extractedImages[$imageCounter])) {
                                        $imageCounter++;
                                    }
                                }
                            } else {
                                // Continue building current lawyer
                                if (empty($currentLawyer)) {
                                    $currentLawyer = [
                                        'name' => $text,
                                        'email' => '',
                                        'phone' => '',
                                        'fee' => 50.00,
                                        'years_of_experience' => '5',
                                        'image' => isset($extractedImages[$imageCounter]) ? $extractedImages[$imageCounter] : null,
                                        'about' => '',
                                        'address' => '',
                                        'educations' => '',
                                        'experience' => '',
                                        'qualifications' => '',
                                    ];
                                    if (isset($extractedImages[$imageCounter])) {
                                        $imageCounter++;
                                    }
                                } else {
                                    // Try to identify email
                                    if (filter_var($text, FILTER_VALIDATE_EMAIL)) {
                                        $currentLawyer['email'] = $text;
                                    }
                                    // Try to identify phone
                                    elseif (preg_match('/[\d\s\+\-\(\)]+/', $text) && strlen($text) > 7) {
                                        $currentLawyer['phone'] = $text;
                                    }
                                    // Otherwise, add to about
                                    else {
                                        if (empty($currentLawyer['about'])) {
                                            $currentLawyer['about'] = $text;
                                        } else {
                                            $currentLawyer['about'] .= ' ' . $text;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
    // Add last lawyer if exists
    if (!empty($currentLawyer) && !empty($currentLawyer['name'])) {
        $lawyers[] = $currentLawyer;
    }
    
    // Alternative: Parse by reading all text and splitting
    if (empty($lawyers)) {
        echo "محاولة طريقة بديلة لتحليل المستند...\n";
        
        // Get all text from document
        $allText = '';
        foreach ($sections as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                if (method_exists($element, 'getText')) {
                    $allText .= $element->getText() . "\n";
                } elseif (method_exists($element, 'getElements')) {
                    foreach ($element->getElements() as $subElement) {
                        if (method_exists($subElement, 'getText')) {
                            $allText .= $subElement->getText() . "\n";
                        }
                    }
                }
            }
        }
        
        // Split by lines and process
        $lines = explode("\n", $allText);
        $currentLawyer = null;
        $imageIndex = 0;
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strlen($line) < 2) continue;
            
            // Check if this looks like a lawyer name (starts with الأستاذ or contains Arabic name pattern)
            // Arabic names typically contain Arabic characters
            $isArabicName = preg_match('/[\x{0600}-\x{06FF}]/u', $line);
            $startsWithTitle = preg_match('/^(الأستاذ|المحامي|المحامية|د\.|دكتور|الأستاذة)\s+/u', $line);
            
            // Exclude section headers and common non-name patterns
            $isSectionHeader = preg_match('/^(مجالات|من مواليد|خريج|منتسب|حاصل|أنواع|الدورات|محاضرات|الأنشطة|التدريبية|الدعاوى|عقود|ليس|إلا|مارس|ما زال|محامٍ|منتسب|حاصل|خريج)/u', $line);
            $endsWithColon = str_ends_with($line, ':');
            $containsBullet = preg_match('/[•\-\*]/u', $line);
            
            // Exclude lines that are clearly not names (contain common verbs or phrases)
            $isNotName = preg_match('/(عمل|يقدم|يمثل|متخصص|خبرة|سنة|عام|حتى|خلال|الفترة|تاريخ|حتى تاريخه|إلى جانب|ما زال يمارس)/u', $line);
            
            // More strict name pattern: must start with title OR be a short line (2-4 words) that looks like a name
            $wordCount = count(explode(' ', trim($line)));
            $isShortName = $wordCount >= 2 && $wordCount <= 4;
            
            // Check if this could be a name (contains Arabic or English letters, not too long, not a bullet point, not a section header)
            // Must start with title OR be a short name-like line
            $isName = $isArabicName && 
                     !$containsBullet && 
                     strlen($line) > 5 && 
                     strlen($line) < 80 &&
                     !$isSectionHeader &&
                     !$endsWithColon &&
                     !$isNotName &&
                     ($startsWithTitle || ($isShortName && !preg_match('/^(الدعاوى|عقود|ليس|إلا|مارس|ما زال|محامٍ|منتسب|حاصل|خريج|عمل|يقدم|يمثل|متخصص)/u', $line)));
            
            if ($isName) {
                // Save previous lawyer if exists
                if (!empty($currentLawyer) && !empty($currentLawyer['name'])) {
                    $lawyers[] = $currentLawyer;
                }
                
                // Extract name (remove title if present)
                $name = preg_replace('/^(الأستاذ|المحامي|المحامية|د\.|دكتور)\s+/u', '', $line);
                $name = trim($name);
                
                $currentLawyer = [
                    'name' => $name,
                    'full_name' => '', // الاسم الكامل
                    'email' => '',
                    'phone' => '',
                    'fee' => 50.00,
                    'years_of_experience' => '',
                    'birth_year' => '',
                    'image' => isset($extractedImages[$imageIndex]) ? $extractedImages[$imageIndex] : null,
                    'about' => '',
                    'address' => '',
                    'educations' => '',
                    'experience' => '',
                    'qualifications' => '',
                    'designations' => '',
                    'department_keywords' => [], // Store keywords to match with department later
                    'courses' => '', // الدورات
                    'memberships' => '', // العضويات
                    'current_status' => '', // الحالة الحالية
                ];
                $imageIndex++;
            } elseif (!empty($currentLawyer)) {
                // Check for section headers
                if (preg_match('/^مجالات\s+(العمل|الخبرة)/u', $line) || preg_match('/^أنواع\s+الدعاوى/u', $line)) {
                    $currentLawyer['in_department_section'] = true;
                    continue;
                }
                
                if (preg_match('/^الدورات\s+(والأنشطة|والتدريبية|والخبرات)/u', $line) || preg_match('/^محاضرات\s+ودورات/u', $line)) {
                    $currentLawyer['in_courses_section'] = true;
                    continue;
                }
                
                // Extract full name
                if (preg_match('/الاسم\s*(الكامل)?\s*[:：]\s*(.+)/u', $line, $matches)) {
                    $currentLawyer['full_name'] = trim($matches[2]);
                }
                
                // Extract department keywords from "مجالات العمل" section
                if (isset($currentLawyer['in_department_section']) && preg_match('/[•\-\*]/u', $line)) {
                    $deptLine = preg_replace('/^[•\-\*]\s*/u', '', $line);
                    $deptLine = trim($deptLine);
                    if (!empty($deptLine) && !preg_match('/^(ليس|إلا|مارس|ما زال)/u', $deptLine)) {
                        $currentLawyer['department_keywords'][] = $deptLine;
                    }
                    continue;
                }
                
                // Extract courses
                if (isset($currentLawyer['in_courses_section']) && preg_match('/[•\-\*]/u', $line)) {
                    $courseLine = preg_replace('/^[•\-\*]\s*/u', '', $line);
                    $courseLine = trim($courseLine);
                    if (!empty($courseLine)) {
                        if (empty($currentLawyer['courses'])) {
                            $currentLawyer['courses'] = '<ul><li>' . $courseLine . '</li>';
                        } else {
                            $currentLawyer['courses'] .= '<li>' . $courseLine . '</li>';
                        }
                    }
                    continue;
                }
                
                // Check if line contains department-related keywords (outside section)
                if (preg_match('/(الدعاوى\s+المدنية|الدعاوى\s+الجزائية|الدعاوى\s+الجنائية|الدعاوى\s+العقارية|الدعاوى\s+الشرعية|عقود\s+الشركات|دعاوى\s+الشركات|قانون\s+العمل|القانون\s+المدني|القانون\s+التجاري|القانون\s+الجنائي|القانون\s+العقاري|القانون\s+الشرعي|الأحوال\s+الشخصية|القضايا\s+العقارية)/u', $line)) {
                    $currentLawyer['department_keywords'][] = $line;
                }
                
                // Try to identify email
                if (filter_var($line, FILTER_VALIDATE_EMAIL)) {
                    $currentLawyer['email'] = $line;
                }
                // Try to identify phone
                elseif (preg_match('/^[\d\s\+\-\(\)]+$/', $line) && strlen($line) > 7) {
                    $currentLawyer['phone'] = $line;
                }
                // Extract birth year
                elseif (preg_match('/من\s+مواليد\s+عام\s+(\d{4})/u', $line, $matches)) {
                    $currentLawyer['birth_year'] = $matches[1];
                    $currentYear = date('Y');
                    if (!empty($currentLawyer['birth_year'])) {
                        $age = $currentYear - (int)$currentLawyer['birth_year'];
                        // Estimate experience if not set
                        if (empty($currentLawyer['years_of_experience'])) {
                            $currentLawyer['years_of_experience'] = max(5, $age - 25); // Assume started at 25
                        }
                    }
                }
                // Check for years of experience (multiple patterns)
                elseif (preg_match('/(\d+)\s*(?:–|-)?\s*(\d+)?\s*(?:سنة|عام).*خبرة/u', $line, $matches)) {
                    $currentLawyer['years_of_experience'] = $matches[1] ?? '';
                    if (!empty($matches[2])) {
                        $currentLawyer['years_of_experience'] = $matches[2]; // Use higher number
                    }
                }
                elseif (preg_match('/خبرة.*?(\d+)\s*(?:سنة|عام)/u', $line, $matches)) {
                    $currentLawyer['years_of_experience'] = $matches[1] ?? '';
                }
                elseif (preg_match('/(\d+)\s*(?:سنة|عام).*?خبرة/u', $line, $matches)) {
                    $currentLawyer['years_of_experience'] = $matches[1] ?? '';
                }
                // Check for graduation year and calculate experience
                elseif (preg_match('/تخرج.*?عام\s+(\d{4})/u', $line, $matches) || preg_match('/خريج.*?عام\s+(\d{4})/u', $line, $matches)) {
                    $gradYear = (int)$matches[1];
                    $currentYear = date('Y');
                    $experience = $currentYear - $gradYear;
                    if ($experience > 0) {
                        $currentLawyer['years_of_experience'] = (string)$experience;
                    }
                }
                // Check for education info (improved patterns)
                elseif (preg_match('/(خريج|تخرج|التحق|حاصل\s+على|إجازة|بكالوريوس|كلية\s+الحقوق|جامعة)/u', $line)) {
                    if (empty($currentLawyer['educations'])) {
                        $currentLawyer['educations'] = '<ul><li>' . $line . '</li>';
                    } else {
                        $currentLawyer['educations'] .= '<li>' . $line . '</li>';
                    }
                }
                // Check for membership in bar association
                elseif (preg_match('/(منتسب|انتسب|عضو).*?نقابة\s+المحامين/u', $line)) {
                    if (empty($currentLawyer['memberships'])) {
                        $currentLawyer['memberships'] = '<ul><li>' . $line . '</li>';
                    } else {
                        $currentLawyer['memberships'] .= '<li>' . $line . '</li>';
                    }
                }
                // Check for professor status
                elseif (preg_match('/(حاصل\s+على\s+صفة|حاصل\s+على\s+شهادة).*?(أستاذ|الأستاذية)/u', $line)) {
                    if (empty($currentLawyer['qualifications'])) {
                        $currentLawyer['qualifications'] = '<ul><li>' . $line . '</li>';
                    } else {
                        $currentLawyer['qualifications'] .= '<li>' . $line . '</li>';
                    }
                    // Also set as designation
                    if (empty($currentLawyer['designations'])) {
                        $currentLawyer['designations'] = 'محامي أستاذ';
                    }
                }
                // Check for experience info (improved patterns)
                elseif (preg_match('/(عمل|مارس|محكّم|محامي|شريك|مكتب|محامي\s+متدرب|محامي\s+أول|مثّل|شارك|حضر|تدير|عضو\s+مجلس)/u', $line)) {
                    if (empty($currentLawyer['experience'])) {
                        $currentLawyer['experience'] = '<ul><li>' . $line . '</li>';
                    } else {
                        $currentLawyer['experience'] .= '<li>' . $line . '</li>';
                    }
                }
                // Check for current status
                elseif (preg_match('/ما\s+زال\s+(يمارس|يعمل)/u', $line)) {
                    $currentLawyer['current_status'] = $line;
                }
                // Check for designations (specialization) - improved
                elseif (preg_match('/محام[يٍة]\s+(?:أستاذ|متخصص).*?(\d+)\s*سنة/u', $line, $matches)) {
                    $currentLawyer['designations'] = 'محامي أستاذ بخبرة ' . $matches[1] . ' سنة';
                    if (empty($currentLawyer['years_of_experience'])) {
                        $currentLawyer['years_of_experience'] = $matches[1];
                    }
                }
                elseif (preg_match('/محام[يٍة]\s+أستاذ/u', $line)) {
                    if (empty($currentLawyer['designations'])) {
                        $currentLawyer['designations'] = 'محامي أستاذ';
                    }
                }
                // Otherwise, add to about (but skip section headers)
                else {
                    if (!preg_match('/^(مجالات|من مواليد|خريج|منتسب|حاصل|أنواع|الدورات|محاضرات|الأنشطة|التدريبية|الاسم|الاسم الكامل)/u', $line)) {
                        if (empty($currentLawyer['about'])) {
                            $currentLawyer['about'] = $line;
                        } else {
                            $currentLawyer['about'] .= ' ' . $line;
                        }
                    }
                }
            }
        }
        
        // Close HTML lists if they were opened
        if (!empty($currentLawyer)) {
            if (!empty($currentLawyer['educations']) && !str_ends_with($currentLawyer['educations'], '</ul>')) {
                $currentLawyer['educations'] .= '</ul>';
            }
            if (!empty($currentLawyer['experience']) && !str_ends_with($currentLawyer['experience'], '</ul>')) {
                $currentLawyer['experience'] .= '</ul>';
            }
            if (!empty($currentLawyer['qualifications']) && !str_ends_with($currentLawyer['qualifications'], '</ul>')) {
                $currentLawyer['qualifications'] .= '</ul>';
            }
            if (!empty($currentLawyer['courses']) && !str_ends_with($currentLawyer['courses'], '</ul>')) {
                $currentLawyer['courses'] .= '</ul>';
            }
            if (!empty($currentLawyer['memberships']) && !str_ends_with($currentLawyer['memberships'], '</ul>')) {
                $currentLawyer['memberships'] .= '</ul>';
            }
            
            // Set default years of experience if not set
            if (empty($currentLawyer['years_of_experience'])) {
                $currentLawyer['years_of_experience'] = '5';
            }
            
            // Build comprehensive about text
            $aboutParts = [];
            if (!empty($currentLawyer['current_status'])) {
                $aboutParts[] = $currentLawyer['current_status'];
            }
            if (!empty($currentLawyer['about'])) {
                $aboutParts[] = $currentLawyer['about'];
            }
            if (!empty($aboutParts)) {
                $currentLawyer['about'] = implode(' ', $aboutParts);
            }
        }
        
        if (!empty($currentLawyer) && !empty($currentLawyer['name'])) {
            $lawyers[] = $currentLawyer;
        }
    }
    
    // Limit lawyers to match number of images (if we have images)
    if (!empty($extractedImages) && count($lawyers) > count($extractedImages)) {
        echo "⚠️  تم العثور على " . count($lawyers) . " محامي ولكن هناك " . count($extractedImages) . " صورة فقط\n";
        echo "سيتم استخدام أول " . count($extractedImages) . " محامي فقط\n\n";
        $lawyers = array_slice($lawyers, 0, count($extractedImages));
    }
    
    // Reverse images order because in Word file, images appear AFTER lawyer details
    // So first image belongs to last lawyer, and last image belongs to first lawyer
    if (!empty($extractedImages) && count($lawyers) == count($extractedImages)) {
        $extractedImages = array_reverse($extractedImages);
        echo "✓ تم عكس ترتيب الصور (الصور تظهر بعد تفاصيل المحاميين في الملف)\n\n";
    }
    
    // Re-assign images correctly to lawyers
    if (!empty($extractedImages)) {
        foreach ($lawyers as $index => &$lawyer) {
            $lawyer['image'] = isset($extractedImages[$index]) ? $extractedImages[$index] : null;
        }
        unset($lawyer);
    }
    
    // Get all departments to match with lawyer keywords
    $allDepartments = DB::table('departments')
        ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
        ->where('departments.status', 1)
        ->where('department_translations.lang_code', 'ar')
        ->select('departments.id', 'department_translations.name')
        ->get();
    
    // Department matching keywords
    $departmentKeywords = [
        'civil' => ['مدني', 'المدنية', 'عقود', 'تجاري'],
        'criminal' => ['جنائي', 'الجنائية', 'جزائي', 'الجزائية'],
        'real_estate' => ['عقاري', 'العقارية', 'عقارات'],
        'family' => ['شرعي', 'الشرعية', 'أحوال شخصية', 'عائلي'],
        'commercial' => ['تجاري', 'التجارية', 'شركات'],
        'labor' => ['عمل', 'العمل', 'عمال'],
    ];
    
    // Match lawyers with departments based on keywords
    foreach ($lawyers as &$lawyer) {
        $matchedDepartmentId = null;
        $bestMatch = 0;
        
        // Check department keywords from lawyer info
        $lawyerKeywords = implode(' ', $lawyer['department_keywords'] ?? []);
        $lawyerAbout = $lawyer['about'] ?? '';
        $allLawyerText = strtolower($lawyerKeywords . ' ' . $lawyerAbout);
        
        foreach ($allDepartments as $dept) {
            $deptName = strtolower($dept->name);
            $matchScore = 0;
            
            // Check if department name matches any keywords
            foreach ($lawyer['department_keywords'] ?? [] as $keyword) {
                $keyword = strtolower($keyword);
                if (strpos($deptName, $keyword) !== false || strpos($keyword, $deptName) !== false) {
                    $matchScore += 10;
                }
            }
            
            // Check common patterns
            if (strpos($allLawyerText, 'مدني') !== false && strpos($deptName, 'مدني') !== false) {
                $matchScore += 5;
            }
            if (strpos($allLawyerText, 'جنائي') !== false && strpos($deptName, 'جنائي') !== false) {
                $matchScore += 5;
            }
            if (strpos($allLawyerText, 'عقاري') !== false && strpos($deptName, 'عقاري') !== false) {
                $matchScore += 5;
            }
            if (strpos($allLawyerText, 'شرعي') !== false && strpos($deptName, 'شرعي') !== false) {
                $matchScore += 5;
            }
            if (strpos($allLawyerText, 'عمل') !== false && strpos($deptName, 'عمل') !== false) {
                $matchScore += 5;
            }
            
            if ($matchScore > $bestMatch) {
                $bestMatch = $matchScore;
                $matchedDepartmentId = $dept->id;
            }
        }
        
        // Use matched department or default
        $lawyer['department_id'] = $matchedDepartmentId ?? $department->id;
        
        if ($matchedDepartmentId) {
            $matchedDept = $allDepartments->firstWhere('id', $matchedDepartmentId);
            echo "✓ تم ربط المحامي {$lawyer['name']} بقسم: {$matchedDept->name}\n";
        }
    }
    unset($lawyer);
    
    echo "\n✓ تم العثور على " . count($lawyers) . " محامي في المستند\n";
    if (!empty($extractedImages)) {
        echo "✓ تم العثور على " . count($extractedImages) . " صورة\n";
    }
    echo "\n";
    
    if (empty($lawyers)) {
        echo "⚠️  لم يتم العثور على بيانات محاميين في المستند.\n";
        echo "يرجى التحقق من تنسيق المستند.\n";
        echo "\nمحتوى المستند:\n";
        echo "---\n";
        // Print first 1000 characters for debugging
        $allText = '';
        foreach ($sections as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                if (method_exists($element, 'getText')) {
                    $allText .= $element->getText() . "\n";
                }
            }
        }
        echo substr($allText, 0, 1000) . "\n";
        echo "---\n";
        exit(1);
    }
    
    // Delete all existing lawyers and their related data
    echo "جاري حذف جميع المحاميين الموجودين...\n";
    DB::beginTransaction();
    
    try {
        // Get all existing lawyers to delete their images
        $existingLawyers = DB::table('lawyers')->get();
        $deletedCount = $existingLawyers->count();
        
        if ($deletedCount > 0) {
            // Get lawyer IDs
            $lawyerIds = $existingLawyers->pluck('id')->toArray();
            
            // Delete related data first (due to foreign key constraints)
            // Delete in order to respect foreign key constraints
            
            // Delete appointments
            if (DB::getSchemaBuilder()->hasTable('appointments')) {
                DB::table('appointments')->whereIn('lawyer_id', $lawyerIds)->delete();
            }
            
            // Delete ratings
            if (DB::getSchemaBuilder()->hasTable('ratings')) {
                DB::table('ratings')->whereIn('lawyer_id', $lawyerIds)->delete();
            }
            
            // Delete messages (check if lawyer_id column exists)
            if (DB::getSchemaBuilder()->hasTable('messages')) {
                try {
                    if (DB::getSchemaBuilder()->hasColumn('messages', 'lawyer_id')) {
                        DB::table('messages')->whereIn('lawyer_id', $lawyerIds)->delete();
                    }
                } catch (\Exception $e) {
                    // Ignore if column doesn't exist
                }
            }
            
            // Delete schedules (check if table and column exist)
            if (DB::getSchemaBuilder()->hasTable('schedules')) {
                try {
                    if (DB::getSchemaBuilder()->hasColumn('schedules', 'lawyer_id')) {
                        DB::table('schedules')->whereIn('lawyer_id', $lawyerIds)->delete();
                    }
                } catch (\Exception $e) {
                    // Ignore if column doesn't exist
                }
            }
            
            // Delete leaves (check if table and column exist)
            if (DB::getSchemaBuilder()->hasTable('leaves')) {
                try {
                    if (DB::getSchemaBuilder()->hasColumn('leaves', 'lawyer_id')) {
                        DB::table('leaves')->whereIn('lawyer_id', $lawyerIds)->delete();
                    }
                } catch (\Exception $e) {
                    // Ignore if column doesn't exist
                }
            }
            
            // Delete zoom meetings (check if table and column exist)
            if (DB::getSchemaBuilder()->hasTable('zoom_meetings')) {
                try {
                    if (DB::getSchemaBuilder()->hasColumn('zoom_meetings', 'lawyer_id')) {
                        DB::table('zoom_meetings')->whereIn('lawyer_id', $lawyerIds)->delete();
                    }
                } catch (\Exception $e) {
                    // Ignore if column doesn't exist
                }
            }
            
            // Delete meeting history (check if table and column exist)
            // Try both table names: meeting_history and meeting_histories
            $meetingHistoryTables = ['meeting_history', 'meeting_histories'];
            foreach ($meetingHistoryTables as $tableName) {
                if (DB::getSchemaBuilder()->hasTable($tableName)) {
                    try {
                        if (DB::getSchemaBuilder()->hasColumn($tableName, 'lawyer_id')) {
                            DB::table($tableName)->whereIn('lawyer_id', $lawyerIds)->delete();
                            break; // Found and deleted, no need to check other table names
                        }
                    } catch (\Exception $e) {
                        // Ignore if column doesn't exist
                    }
                }
            }
            
            // Delete zoom credentials (check if table and column exist)
            if (DB::getSchemaBuilder()->hasTable('zoom_credentials')) {
                try {
                    if (DB::getSchemaBuilder()->hasColumn('zoom_credentials', 'lawyer_id')) {
                        DB::table('zoom_credentials')->whereIn('lawyer_id', $lawyerIds)->delete();
                    }
                } catch (\Exception $e) {
                    // Ignore if column doesn't exist
                }
            }
            
            // Delete withdraw requests (check if table and column exist)
            if (DB::getSchemaBuilder()->hasTable('withdraw_requests')) {
                try {
                    if (DB::getSchemaBuilder()->hasColumn('withdraw_requests', 'lawyer_id')) {
                        DB::table('withdraw_requests')->whereIn('lawyer_id', $lawyerIds)->delete();
                    }
                } catch (\Exception $e) {
                    // Ignore if column doesn't exist
                }
            }
            
            // Delete shopping carts (check if table and column exist)
            if (DB::getSchemaBuilder()->hasTable('shopping_carts')) {
                try {
                    if (DB::getSchemaBuilder()->hasColumn('shopping_carts', 'lawyer_id')) {
                        DB::table('shopping_carts')->whereIn('lawyer_id', $lawyerIds)->delete();
                    }
                } catch (\Exception $e) {
                    // Ignore if column doesn't exist
                }
            }
            
            // Delete admin appointments (check if table and column exist)
            if (DB::getSchemaBuilder()->hasTable('admin_appointments')) {
                try {
                    if (DB::getSchemaBuilder()->hasColumn('admin_appointments', 'lawyer_id')) {
                        DB::table('admin_appointments')->whereIn('lawyer_id', $lawyerIds)->delete();
                    }
                } catch (\Exception $e) {
                    // Ignore if column doesn't exist
                }
            }
            
            // Delete lawyer translations
            DB::table('lawyer_translations')->whereIn('lawyer_id', $lawyerIds)->delete();
            
            // Delete lawyer social media
            if (DB::getSchemaBuilder()->hasTable('lawyer_social_media')) {
                DB::table('lawyer_social_media')->whereIn('lawyer_id', $lawyerIds)->delete();
            }
            
            // Delete department_lawyer pivot
            if (DB::getSchemaBuilder()->hasTable('department_lawyer')) {
                DB::table('department_lawyer')->whereIn('lawyer_id', $lawyerIds)->delete();
            }
            
            // Delete lawyers
            DB::table('lawyers')->whereIn('id', $lawyerIds)->delete();
            
            // Delete lawyer images from filesystem
            foreach ($existingLawyers as $lawyer) {
                if (!empty($lawyer->image) && File::exists(public_path($lawyer->image))) {
                    try {
                        File::delete(public_path($lawyer->image));
                    } catch (\Exception $e) {
                        // Ignore file deletion errors
                    }
                }
            }
            
            echo "✓ تم حذف {$deletedCount} محامي موجود\n\n";
        } else {
            echo "✓ لا يوجد محاميين موجودين للحذف\n\n";
        }
        
    } catch (\Exception $e) {
        DB::rollBack();
        throw new Exception('خطأ في حذف المحاميين الموجودين: ' . $e->getMessage());
    }
    
    $now = now();
    $insertedCount = 0;
    $skippedCount = 0;
    
    // Store login credentials for output
    $loginCredentials = [];
    
    foreach ($lawyers as $index => $lawyerData) {
        try {
            // Use full name if available for email generation
            $nameForEmail = !empty($lawyerData['full_name']) ? $lawyerData['full_name'] : $lawyerData['name'];
            
            // Generate professional email if not provided
            if (empty($lawyerData['email'])) {
                // Create email from name: first.last@amanlaw.ch
                $nameParts = explode(' ', $nameForEmail);
                if (count($nameParts) >= 2) {
                    $firstName = Str::slug($nameParts[0], '');
                    $lastName = Str::slug(end($nameParts), '');
                    $lawyerData['email'] = strtolower($firstName . '.' . $lastName . '@amanlaw.ch');
                } else {
                    $lawyerData['email'] = strtolower(Str::slug($nameForEmail, '.') . '@amanlaw.ch');
                }
                
                // Ensure email is unique
                $baseEmail = $lawyerData['email'];
                $counter = 1;
                while (DB::table('lawyers')->where('email', $lawyerData['email'])->exists()) {
                    $emailParts = explode('@', $baseEmail);
                    $lawyerData['email'] = $emailParts[0] . $counter . '@' . $emailParts[1];
                    $counter++;
                }
            }
            
            // Generate professional password (8 characters: name initials + numbers)
            if (empty($lawyerData['password'])) {
                $nameParts = explode(' ', $nameForEmail);
                $initials = '';
                foreach ($nameParts as $part) {
                    if (!empty($part)) {
                        $initials .= mb_substr($part, 0, 1, 'UTF-8');
                    }
                }
                $initials = strtoupper(Str::slug($initials, ''));
                $randomNum = rand(1000, 9999);
                $lawyerData['password'] = $initials . $randomNum;
            }
            
            // Generate phone if not provided
            if (empty($lawyerData['phone'])) {
                $lawyerData['phone'] = '+963' . rand(900000000, 999999999);
            }
            
            // Process image if exists
            $imagePath = null;
            if (!empty($lawyerData['image']) && File::exists(public_path($lawyerData['image']))) {
                // Try to resize and optimize image, but fallback to original if GD is not available
                try {
                    if (extension_loaded('gd')) {
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read(public_path($lawyerData['image']));
                        $image->resize(500, 500);
                        
                        $newImageName = 'lawyer-' . Str::slug($lawyerData['name']) . '-' . time() . '.jpg';
                        $newImagePath = public_path('uploads/lawyers/' . $newImageName);
                        $image->save($newImagePath);
                        $imagePath = 'uploads/lawyers/' . $newImageName;
                    } else {
                        // GD not available, use original image
                        $imagePath = $lawyerData['image'];
                    }
                } catch (\Exception $e) {
                    echo "⚠️  خطأ في معالجة الصورة للمحامي {$lawyerData['name']}: " . $e->getMessage() . "\n";
                    $imagePath = $lawyerData['image'];
                }
            }
            
            // Use matched department or default
            $lawyerDepartmentId = isset($lawyerData['department_id']) ? $lawyerData['department_id'] : $department->id;
            
            // Use full name if available, otherwise use name
            $displayName = !empty($lawyerData['full_name']) ? $lawyerData['full_name'] : $lawyerData['name'];
            
            // Ensure years_of_experience is set
            $yearsOfExperience = !empty($lawyerData['years_of_experience']) ? $lawyerData['years_of_experience'] : '5';
            
            $lawyerRecord = [
                'department_id'       => $lawyerDepartmentId,
                'location_id'         => $location->id,
                'name'                => $displayName,
                'slug'                => Str::slug($displayName),
                'email'               => $lawyerData['email'],
                'password'            => Hash::make($lawyerData['password']),
                'phone'               => $lawyerData['phone'],
                'fee'                 => $lawyerData['fee'],
                'years_of_experience' => $yearsOfExperience,
                'image'               => $imagePath,
                'status'              => 1,
                'show_homepage'       => 1,
                'wallet_balance'      => 0.00,
                'email_verified_at'   => $now,
                'updated_at'          => $now,
            ];
            
            // Always create new lawyer (all existing ones were deleted)
            $lawyerRecord['created_at'] = $now;
            
            // Insert new lawyer
            $lawyerId = DB::table('lawyers')->insertGetId($lawyerRecord);
            
            $insertedCount++;
            
            // Store credentials for final output
            $loginCredentials[] = [
                'name' => $displayName,
                'email' => $lawyerData['email'],
                'password' => $lawyerData['password'],
                'id' => $lawyerId,
            ];
            
            echo "✓ تم إضافة المحامي: {$displayName} (ID: {$lawyerId})\n";
            echo "  📧 الإيميل: {$lawyerData['email']}\n";
            echo "  🔑 كلمة المرور: {$lawyerData['password']}\n";
            if (!empty($lawyerData['years_of_experience'])) {
                echo "  - سنوات الخبرة: {$lawyerData['years_of_experience']}\n";
            }
            if (!empty($lawyerData['department_keywords'])) {
                echo "  - مجالات العمل: " . implode(', ', array_slice($lawyerData['department_keywords'], 0, 3)) . "\n";
            }
            
            // Delete existing translations
            LawyerTranslation::where('lawyer_id', $lawyerId)->delete();
            
            // Extract designations from department keywords or about
            $designationsAr = 'محامي';
            if (!empty($lawyerData['designations'])) {
                $designationsAr = $lawyerData['designations'];
            } elseif (!empty($lawyerData['years_of_experience']) && (int)$lawyerData['years_of_experience'] > 20) {
                $designationsAr = 'محامي أستاذ بخبرة ' . $lawyerData['years_of_experience'] . ' سنة';
            } elseif (!empty($lawyerData['department_keywords'])) {
                // Use first department keyword as designation
                $designationsAr = 'محامي متخصص في ' . implode(' و ', array_slice($lawyerData['department_keywords'], 0, 2));
            }
            
            // Build comprehensive about text in Arabic
            $aboutAr = '';
            if (!empty($lawyerData['current_status'])) {
                $aboutAr .= $lawyerData['current_status'] . '. ';
            }
            if (!empty($lawyerData['about'])) {
                $aboutAr .= $lawyerData['about'];
            }
            if (empty($aboutAr)) {
                $aboutAr = 'محامي ذو خبرة يقدم خدمات قانونية متخصصة.';
            }
            
            // Combine courses with qualifications
            $qualificationsAr = '';
            if (!empty($lawyerData['qualifications'])) {
                $qualificationsAr = $lawyerData['qualifications'];
            }
            if (!empty($lawyerData['courses'])) {
                if (!empty($qualificationsAr)) {
                    $qualificationsAr .= $lawyerData['courses'];
                } else {
                    $qualificationsAr = '<h4>الدورات والأنشطة:</h4>' . $lawyerData['courses'];
                }
            }
            if (!empty($lawyerData['memberships'])) {
                if (!empty($qualificationsAr)) {
                    $qualificationsAr .= '<h4>العضويات:</h4>' . $lawyerData['memberships'];
                } else {
                    $qualificationsAr = '<h4>العضويات:</h4>' . $lawyerData['memberships'];
                }
            }
            
            // Combine experience with courses if needed
            $experienceAr = '';
            if (!empty($lawyerData['experience'])) {
                $experienceAr = $lawyerData['experience'];
            }
            
            // Build comprehensive about text in English
            $aboutEn = '';
            if (!empty($lawyerData['years_of_experience'])) {
                $aboutEn = 'Experienced lawyer with ' . $lawyerData['years_of_experience'] . ' years of experience. ';
            }
            if (!empty($lawyerData['about'])) {
                $aboutEn .= $lawyerData['about'];
            }
            if (empty($aboutEn)) {
                $aboutEn = 'Experienced lawyer providing specialized legal services.';
            }
            
            // Create translations with organized information
            $translations = [
                [
                    'lawyer_id' => $lawyerId,
                    'lang_code' => 'en',
                    'designations' => !empty($lawyerData['designations']) ? $lawyerData['designations'] : 'Lawyer',
                    'seo_title' => $displayName,
                    'seo_description' => 'Lawyer ' . $displayName . ' - ' . (!empty($lawyerData['designations']) ? $lawyerData['designations'] : 'Legal Services'),
                    'about' => $aboutEn,
                    'address' => !empty($lawyerData['address']) ? $lawyerData['address'] : '',
                    'educations' => !empty($lawyerData['educations']) ? $lawyerData['educations'] : '',
                    'experience' => $experienceAr,
                    'qualifications' => $qualificationsAr,
                ],
                [
                    'lawyer_id' => $lawyerId,
                    'lang_code' => 'ar',
                    'designations' => $designationsAr,
                    'seo_title' => $displayName,
                    'seo_description' => 'محامي ' . $displayName . ' - ' . $designationsAr,
                    'about' => $aboutAr,
                    'address' => !empty($lawyerData['address']) ? $lawyerData['address'] : '',
                    'educations' => !empty($lawyerData['educations']) ? $lawyerData['educations'] : '',
                    'experience' => $experienceAr,
                    'qualifications' => $qualificationsAr,
                ],
            ];
            
            foreach ($translations as $translation) {
                LawyerTranslation::create($translation);
            }
            
        } catch (\Exception $e) {
            $skippedCount++;
            echo "❌ خطأ في إضافة المحامي {$lawyerData['name']}: " . $e->getMessage() . "\n";
        }
    }
    
    DB::commit();
    
    echo "\n=== النتائج ===\n";
    echo "تم الإضافة: {$insertedCount} محامي\n";
    echo "تم التخطي: {$skippedCount} محامي\n";
    
    // Display login credentials summary
    if (!empty($loginCredentials)) {
        echo "\n=== بيانات تسجيل الدخول للمحاميين ===\n";
        echo "🔗 رابط تسجيل الدخول: https://amanlaw.ch/login?type=lawyer\n";
        echo "   أو: http://127.0.0.1:8000/login?type=lawyer\n\n";
        
        foreach ($loginCredentials as $cred) {
            echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
            echo "👤 المحامي: {$cred['name']}\n";
            echo "📧 الإيميل: {$cred['email']}\n";
            echo "🔑 كلمة المرور: {$cred['password']}\n";
            echo "🆔 رقم المحامي: {$cred['id']}\n";
            echo "\n";
        }
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    }
    
    echo "\n✅ تم الانتهاء بنجاح!\n";
    
} catch (\Exception $e) {
    if (DB::transactionLevel() > 0) {
        DB::rollBack();
    }
    echo "❌ خطأ: " . $e->getMessage() . "\n";
    echo "الملف: " . $e->getFile() . "\n";
    echo "السطر: " . $e->getLine() . "\n";
    exit(1);
}
