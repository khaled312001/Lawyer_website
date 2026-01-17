<?php

require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
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
Settings::setTempDir(sys_get_temp_dir());

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
            $startsWithTitle = preg_match('/^(الأستاذ|المحامي|المحامية|د\.|دكتور|الأستاذة)/u', $line);
            
            // Exclude section headers and common non-name patterns
            $isSectionHeader = preg_match('/^(مجالات|من مواليد|خريج|منتسب|حاصل|أنواع|الدورات|محاضرات|الأنشطة|التدريبية)/u', $line);
            $endsWithColon = str_ends_with($line, ':');
            
            // Check if this could be a name (contains Arabic or English letters, not too long, not a bullet point, not a section header)
            $isName = $isArabicName && 
                     !preg_match('/^[•\-\*]/u', $line) && 
                     strlen($line) > 5 && 
                     strlen($line) < 100 &&
                     !$isSectionHeader &&
                     !$endsWithColon &&
                     ($startsWithTitle || (strlen($line) < 50 && !preg_match('/^(الدعاوى|عقود|ليس|إلا|مارس|ما زال)/u', $line)));
            
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
                    'email' => '',
                    'phone' => '',
                    'fee' => 50.00,
                    'years_of_experience' => '5',
                    'image' => isset($extractedImages[$imageIndex]) ? $extractedImages[$imageIndex] : null,
                    'about' => '',
                    'address' => '',
                    'educations' => '',
                    'experience' => '',
                    'qualifications' => '',
                ];
                $imageIndex++;
            } elseif (!empty($currentLawyer)) {
                // Try to identify email
                if (filter_var($line, FILTER_VALIDATE_EMAIL)) {
                    $currentLawyer['email'] = $line;
                }
                // Try to identify phone
                elseif (preg_match('/^[\d\s\+\-\(\)]+$/', $line) && strlen($line) > 7) {
                    $currentLawyer['phone'] = $line;
                }
                // Check for education info
                elseif (preg_match('/(خريج|جامعة|كلية|إجازة|دبلوم|شهادة)/u', $line)) {
                    if (empty($currentLawyer['educations'])) {
                        $currentLawyer['educations'] = '<ul><li>' . $line . '</li>';
                    } else {
                        $currentLawyer['educations'] .= '<li>' . $line . '</li>';
                    }
                }
                // Check for experience info
                elseif (preg_match('/(عمل|مارس|محكّم|محامي|شريك|مكتب)/u', $line)) {
                    if (empty($currentLawyer['experience'])) {
                        $currentLawyer['experience'] = '<ul><li>' . $line . '</li>';
                    } else {
                        $currentLawyer['experience'] .= '<li>' . $line . '</li>';
                    }
                }
                // Otherwise, add to about
                else {
                    if (empty($currentLawyer['about'])) {
                        $currentLawyer['about'] = $line;
                    } else {
                        $currentLawyer['about'] .= ' ' . $line;
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
        }
        
        if (!empty($currentLawyer) && !empty($currentLawyer['name'])) {
            $lawyers[] = $currentLawyer;
        }
    }
    
    echo "✓ تم العثور على " . count($lawyers) . " محامي في المستند\n\n";
    
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
            if (DB::getSchemaBuilder()->hasTable('meeting_history')) {
                try {
                    if (DB::getSchemaBuilder()->hasColumn('meeting_history', 'lawyer_id')) {
                        DB::table('meeting_history')->whereIn('lawyer_id', $lawyerIds)->delete();
                    }
                } catch (\Exception $e) {
                    // Ignore if column doesn't exist
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
    
    foreach ($lawyers as $index => $lawyerData) {
        try {
            // Generate email if not provided
            if (empty($lawyerData['email'])) {
                $lawyerData['email'] = Str::slug($lawyerData['name'], '.') . '@law.com';
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
            
            $lawyerRecord = [
                'department_id'       => $department->id,
                'location_id'         => $location->id,
                'name'                => $lawyerData['name'],
                'slug'                => Str::slug($lawyerData['name']),
                'email'               => $lawyerData['email'],
                'password'            => Hash::make('1234'),
                'phone'               => $lawyerData['phone'],
                'fee'                 => $lawyerData['fee'],
                'years_of_experience' => $lawyerData['years_of_experience'],
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
            echo "✓ تم إضافة المحامي: {$lawyerData['name']} (ID: {$lawyerId})\n";
            
            // Delete existing translations
            LawyerTranslation::where('lawyer_id', $lawyerId)->delete();
            
            // Create translations
            $translations = [
                [
                    'lawyer_id' => $lawyerId,
                    'lang_code' => 'en',
                    'designations' => 'Lawyer',
                    'seo_title' => $lawyerData['name'],
                    'seo_description' => 'Lawyer ' . $lawyerData['name'],
                    'about' => !empty($lawyerData['about']) ? $lawyerData['about'] : 'Experienced lawyer providing legal services.',
                    'address' => !empty($lawyerData['address']) ? $lawyerData['address'] : '',
                    'educations' => !empty($lawyerData['educations']) ? $lawyerData['educations'] : '',
                    'experience' => !empty($lawyerData['experience']) ? $lawyerData['experience'] : '',
                    'qualifications' => !empty($lawyerData['qualifications']) ? $lawyerData['qualifications'] : '',
                ],
                [
                    'lawyer_id' => $lawyerId,
                    'lang_code' => 'ar',
                    'designations' => 'محامي',
                    'seo_title' => $lawyerData['name'],
                    'seo_description' => 'محامي ' . $lawyerData['name'],
                    'about' => !empty($lawyerData['about']) ? $lawyerData['about'] : 'محامي ذو خبرة يقدم خدمات قانونية.',
                    'address' => !empty($lawyerData['address']) ? $lawyerData['address'] : '',
                    'educations' => !empty($lawyerData['educations']) ? $lawyerData['educations'] : '',
                    'experience' => !empty($lawyerData['experience']) ? $lawyerData['experience'] : '',
                    'qualifications' => !empty($lawyerData['qualifications']) ? $lawyerData['qualifications'] : '',
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
