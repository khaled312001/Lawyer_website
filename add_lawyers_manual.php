<?php

require __DIR__ . '/vendor/autoload.php';

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

echo "=== إضافة المحاميين يدوياً ببيانات كاملة ===\n\n";

try {
    DB::beginTransaction();
    
    // Get default department and location
    $department = DB::table('departments')->first();
    $location = DB::table('locations')->first();
    
    if (!$department) {
        $departmentId = DB::table('departments')->insertGetId([
            'slug' => 'general-law',
            'status' => 1,
            'show_homepage' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('department_translations')->insert([
            ['department_id' => $departmentId, 'lang_code' => 'en', 'name' => 'General Law', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => $departmentId, 'lang_code' => 'ar', 'name' => 'القانون العام', 'created_at' => now(), 'updated_at' => now()],
        ]);
        $department = DB::table('departments')->where('id', $departmentId)->first();
    }
    
    if (!$location) {
        $locationId = DB::table('locations')->insertGetId([
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('location_translations')->insert([
            ['location_id' => $locationId, 'lang_code' => 'en', 'name' => 'Syria', 'created_at' => now(), 'updated_at' => now()],
            ['location_id' => $locationId, 'lang_code' => 'ar', 'name' => 'سوريا', 'created_at' => now(), 'updated_at' => now()],
        ]);
        $location = DB::table('locations')->where('id', $locationId)->first();
    }
    
    // Delete all existing lawyers first
    echo "جاري حذف جميع المحاميين الموجودين...\n";
    $existingLawyers = DB::table('lawyers')->get();
    $deletedCount = $existingLawyers->count();
    
    if ($deletedCount > 0) {
        $lawyerIds = $existingLawyers->pluck('id')->toArray();
        
        // Delete related data
        if (DB::getSchemaBuilder()->hasTable('appointments')) {
            DB::table('appointments')->whereIn('lawyer_id', $lawyerIds)->delete();
        }
        if (DB::getSchemaBuilder()->hasTable('ratings')) {
            DB::table('ratings')->whereIn('lawyer_id', $lawyerIds)->delete();
        }
        if (DB::getSchemaBuilder()->hasTable('schedules')) {
            try {
                if (DB::getSchemaBuilder()->hasColumn('schedules', 'lawyer_id')) {
                    DB::table('schedules')->whereIn('lawyer_id', $lawyerIds)->delete();
                }
            } catch (\Exception $e) {}
        }
        if (DB::getSchemaBuilder()->hasTable('leaves')) {
            try {
                if (DB::getSchemaBuilder()->hasColumn('leaves', 'lawyer_id')) {
                    DB::table('leaves')->whereIn('lawyer_id', $lawyerIds)->delete();
                }
            } catch (\Exception $e) {}
        }
        if (DB::getSchemaBuilder()->hasTable('zoom_meetings')) {
            try {
                if (DB::getSchemaBuilder()->hasColumn('zoom_meetings', 'lawyer_id')) {
                    DB::table('zoom_meetings')->whereIn('lawyer_id', $lawyerIds)->delete();
                }
            } catch (\Exception $e) {}
        }
        $meetingHistoryTables = ['meeting_history', 'meeting_histories'];
        foreach ($meetingHistoryTables as $tableName) {
            if (DB::getSchemaBuilder()->hasTable($tableName)) {
                try {
                    if (DB::getSchemaBuilder()->hasColumn($tableName, 'lawyer_id')) {
                        DB::table($tableName)->whereIn('lawyer_id', $lawyerIds)->delete();
                    }
                } catch (\Exception $e) {}
            }
        }
        if (DB::getSchemaBuilder()->hasTable('zoom_credentials')) {
            try {
                if (DB::getSchemaBuilder()->hasColumn('zoom_credentials', 'lawyer_id')) {
                    DB::table('zoom_credentials')->whereIn('lawyer_id', $lawyerIds)->delete();
                }
            } catch (\Exception $e) {}
        }
        if (DB::getSchemaBuilder()->hasTable('withdraw_requests')) {
            try {
                if (DB::getSchemaBuilder()->hasColumn('withdraw_requests', 'lawyer_id')) {
                    DB::table('withdraw_requests')->whereIn('lawyer_id', $lawyerIds)->delete();
                }
            } catch (\Exception $e) {}
        }
        if (DB::getSchemaBuilder()->hasTable('shopping_carts')) {
            try {
                if (DB::getSchemaBuilder()->hasColumn('shopping_carts', 'lawyer_id')) {
                    DB::table('shopping_carts')->whereIn('lawyer_id', $lawyerIds)->delete();
                }
            } catch (\Exception $e) {}
        }
        if (DB::getSchemaBuilder()->hasTable('admin_appointments')) {
            try {
                if (DB::getSchemaBuilder()->hasColumn('admin_appointments', 'lawyer_id')) {
                    DB::table('admin_appointments')->whereIn('lawyer_id', $lawyerIds)->delete();
                }
            } catch (\Exception $e) {}
        }
        
        DB::table('lawyer_translations')->whereIn('lawyer_id', $lawyerIds)->delete();
        if (DB::getSchemaBuilder()->hasTable('lawyer_social_media')) {
            DB::table('lawyer_social_media')->whereIn('lawyer_id', $lawyerIds)->delete();
        }
        if (DB::getSchemaBuilder()->hasTable('department_lawyer')) {
            DB::table('department_lawyer')->whereIn('lawyer_id', $lawyerIds)->delete();
        }
        
        DB::table('lawyers')->whereIn('id', $lawyerIds)->delete();
        
        foreach ($existingLawyers as $lawyer) {
            if (!empty($lawyer->image) && File::exists(public_path($lawyer->image))) {
                try {
                    File::delete(public_path($lawyer->image));
                } catch (\Exception $e) {}
            }
        }
        
        echo "✓ تم حذف {$deletedCount} محامي موجود\n\n";
    }
    
    // Get all departments for matching
    $allDepartments = DB::table('departments')
        ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
        ->where('departments.status', 1)
        ->where('department_translations.lang_code', 'ar')
        ->select('departments.id', 'department_translations.name')
        ->get();
    
    // Function to find department by keywords
    $findDepartment = function($keywords) use ($allDepartments, $department) {
        $bestMatch = 0;
        $matchedId = null;
        
        foreach ($allDepartments as $dept) {
            $deptName = strtolower($dept->name);
            $matchScore = 0;
            
            foreach ($keywords as $keyword) {
                $keyword = strtolower($keyword);
                if (strpos($deptName, $keyword) !== false || strpos($keyword, $deptName) !== false) {
                    $matchScore += 10;
                }
            }
            
            if ($matchScore > $bestMatch) {
                $bestMatch = $matchScore;
                $matchedId = $dept->id;
            }
        }
        
        return $matchedId ?? $department->id;
    };
    
    // Lawyers data
    $lawyersData = [
        [
            'name' => 'محمد خوالدة',
            'full_name' => 'محمد خوالدة',
            'email' => 'mohammad.khawaldeh@amanlaw.ch',
            'password' => 'MKH1967',
            'phone' => '+963933123456',
            'years_of_experience' => '30',
            'birth_year' => '1967',
            'department_keywords' => ['مدني', 'جزائي', 'جنائي', 'عقاري', 'شرعي', 'شركات'],
            'designations' => 'محامي أستاذ بخبرة تزيد عن 30 سنة',
            'about' => 'محامٍ أستاذ بخبرة تزيد عن 30 سنة. من مواليد عام 1967. ما زال يمارس مهنة المحاماة حتى تاريخه.',
            'educations' => '<ul>
                <li>خريج كلية الحقوق – جامعة دمشق عام 1993</li>
                <li>منتسب إلى فرع نقابة المحامين في درعا عام 1994</li>
                <li>حاصل على شهادة الأستاذية في النقابة عام 1996</li>
            </ul>',
            'experience' => '<ul>
                <li>عمل محكّمًا شرعيًا لدى المحاكم الشرعية خلال الفترة من 2002 حتى 2010</li>
                <li>مارس التحكيم الشرعي إلى جانب عمله في المحاماة</li>
                <li>ما زال يمارس مهنة المحاماة حتى تاريخه</li>
            </ul>',
            'qualifications' => '<ul>
                <li>محامي أستاذ بخبرة تزيد عن 30 سنة</li>
                <li>حاصل على شهادة الأستاذية في النقابة</li>
                <li>محكم شرعي معتمد</li>
            </ul>',
        ],
        [
            'name' => 'محمد علي البلخي',
            'full_name' => 'محمد علي البلخي',
            'email' => 'mohammad.ali.albalkhi@amanlaw.ch',
            'password' => 'MAB1997',
            'phone' => '+963933234567',
            'years_of_experience' => '27',
            'department_keywords' => ['مدني', 'جزائي', 'جنائي', 'شرعي'],
            'designations' => 'محامي أستاذ بخبرة 26-27 سنة',
            'about' => 'محامي أستاذ مارس مهنة المحاماة منذ عام 2000، وتبلغ خبرته حوالي 26–27 سنة. يمتلك خبرة واسعة وشهادات متعددة في التعامل مع قضايا اللاجئين والأنشطة القانونية والحقوقية المرتبطة بها. ما زال يمارس مهنة المحاماة حتى اليوم.',
            'educations' => '<ul>
                <li>درس مراحل التعليم الابتدائي والإعدادي والثانوي</li>
                <li>حاصل على إجازة (بكالوريوس) في العلوم</li>
                <li>التحق بـ كلية الحقوق – جامعة دمشق</li>
                <li>تخرج من كلية الحقوق عام 1997</li>
                <li>حصل على صفة أستاذ عام 2000</li>
            </ul>',
            'experience' => '<ul>
                <li>مارس مهنة المحاماة منذ عام 2000</li>
                <li>يمتلك خبرة واسعة في التعامل مع قضايا اللاجئين</li>
                <li>خبرة في الأنشطة القانونية والحقوقية</li>
                <li>ما زال يمارس مهنة المحاماة حتى اليوم</li>
            </ul>',
            'qualifications' => '<ul>
                <li>حاصل على صفة أستاذ عام 2000</li>
                <li>دورات في التحكيم الدولي في جامعة القاهرة</li>
                <li>دورات في التحكيم الدولي في جامعة دمشق</li>
                <li>شهادات متعددة في التعامل مع قضايا اللاجئين</li>
            </ul>',
        ],
        [
            'name' => 'محمود مشيلح',
            'full_name' => 'محمود المرشد الشالح',
            'email' => 'mahmoud.mashileh@amanlaw.ch',
            'password' => 'MMS1996',
            'phone' => '+963933345678',
            'years_of_experience' => '28',
            'department_keywords' => ['مدني', 'جزائي', 'جنائي', 'شرعي', 'عقاري'],
            'designations' => 'محامي أستاذ',
            'about' => 'محامي أستاذ خريج كلية الحقوق – جامعة دمشق. ما زال يمارس مهنة المحاماة حتى تاريخه.',
            'educations' => '<ul>
                <li>خريج كلية الحقوق – جامعة دمشق عام 1996</li>
                <li>منتسب إلى نقابة المحامين – فرع دمشق عام 2004</li>
                <li>حاصل على إجازة في الحقوق</li>
                <li>حاصل على إجازة في المحاماة</li>
            </ul>',
            'experience' => '<ul>
                <li>منتسب إلى نقابة المحامين – فرع دمشق عام 2004</li>
                <li>ما زال يمارس مهنة المحاماة حتى تاريخه</li>
            </ul>',
            'qualifications' => '<ul>
                <li>حاصل على إجازة في الحقوق</li>
                <li>حاصل على إجازة في المحاماة</li>
                <li>عضو نقابة المحامين – فرع دمشق</li>
            </ul>',
        ],
        [
            'name' => 'زياد الزعبي',
            'full_name' => 'زياد الزعبي',
            'email' => 'ziad.alzoubi@amanlaw.ch',
            'password' => 'ZZA1998',
            'phone' => '+963933456789',
            'years_of_experience' => '26',
            'birth_year' => '1967',
            'department_keywords' => ['مدني', 'جزائي', 'جنائي', 'شرعي', 'عقاري', 'تأمين'],
            'designations' => 'محامي أستاذ',
            'about' => 'محامي أستاذ من مواليد درعا عام 1967. كان عضوًا في فرع النقابة لثلاث دورات متتالية من 2005 حتى 2019. ما زال يمارس مهنة المحاماة بصفة محامٍ أستاذ.',
            'educations' => '<ul>
                <li>خريج كلية الحقوق – جامعة دمشق عام 1998</li>
                <li>انتسب إلى فرع نقابة المحامين في درعا عام 2004</li>
                <li>كان عضوًا في فرع النقابة لثلاث دورات متتالية من 2005 حتى 2019</li>
            </ul>',
            'experience' => '<ul>
                <li>انتسب إلى فرع نقابة المحامين في درعا عام 2004</li>
                <li>كان عضوًا في فرع النقابة لثلاث دورات متتالية من 2005 حتى 2019</li>
                <li>مثّل المؤسسة العامة السورية للتأمين قضائيًا</li>
                <li>ما زال يمارس مهنة المحاماة بصفة محامٍ أستاذ</li>
            </ul>',
            'qualifications' => '<ul>
                <li>محامي أستاذ</li>
                <li>عضو نقابة المحامين – فرع درعا (ثلاث دورات متتالية)</li>
                <li>شارك في دورات تحكيم تجاري نظمها المركز الألماني بدمشق</li>
                <li>حضر دورات قانونية نظمها مركز الساحل في سوريا</li>
            </ul>',
        ],
        [
            'name' => 'محمد باسم الجلدة',
            'full_name' => 'محمد باسم الجلدة',
            'email' => 'mohammad.basem.aljelda@amanlaw.ch',
            'password' => 'MBG2021',
            'phone' => '+963933567890',
            'years_of_experience' => '3',
            'department_keywords' => ['مدني', 'جزائي', 'شرعي', 'شركات'],
            'designations' => 'محامي أستاذ',
            'about' => 'محامي أستاذ شاب حاصل على صفة أستاذ عام 2024. ما زال يمارس مهنة المحاماة حتى الآن.',
            'educations' => '<ul>
                <li>خريج كلية الحقوق – جامعة بلاد الشام الخاصة بدمشق عام 2021</li>
                <li>منتسب إلى نقابة المحامين عام 2022</li>
                <li>حاصل على صفة أستاذ عام 2024</li>
            </ul>',
            'experience' => '<ul>
                <li>منتسب إلى نقابة المحامين عام 2022</li>
                <li>حاصل على صفة أستاذ عام 2024</li>
                <li>ما زال يمارس مهنة المحاماة حتى الآن</li>
            </ul>',
            'qualifications' => '<ul>
                <li>حاصل على صفة أستاذ عام 2024</li>
                <li>عضو نقابة المحامين</li>
            </ul>',
        ],
        [
            'name' => 'غزالة الأشقر',
            'full_name' => 'غزالة الأشقر',
            'email' => 'ghazala.alashqar@amanlaw.ch',
            'password' => 'GAA2009',
            'phone' => '+963933678901',
            'years_of_experience' => '16',
            'department_keywords' => ['نساء', 'عائلي', 'شرعي', 'حقوق إنسان'],
            'designations' => 'محامية أستاذة',
            'about' => 'محامية أستاذة انتسبت إلى نقابة المحامين عام 2009. عملت كمحامية متطوعة في مركز مجتمعي تابع للأونروا من 2008 حتى 2025. تدير مكتب استشارات قانونية. عضو مجلس إدارة جمعية نور للإغاثة من 2020 حتى 2024.',
            'educations' => '<ul>
                <li>انتسبت إلى نقابة المحامين عام 2009</li>
                <li>حاصلة على صفة محامية أستاذة عام 2011</li>
            </ul>',
            'experience' => '<ul>
                <li>عملت كمحامية متطوعة في مركز مجتمعي تابع للأونروا من 2008 حتى 2025</li>
                <li>تدير مكتب استشارات قانونية</li>
                <li>عضو مجلس إدارة جمعية نور للإغاثة من 2020 حتى 2024</li>
            </ul>',
            'qualifications' => '<ul>
                <li>حاصلة على صفة محامية أستاذة عام 2011</li>
                <li>دورات في مناهضة العنف ضد المرأة</li>
                <li>دورات في اتفاقية سيداو</li>
                <li>دورات في مهارات الحياة والتواصل</li>
                <li>دورات في فن التفاوض</li>
                <li>المشاركة في أعمال المجلس التربوي</li>
                <li>نفّذت محاضرات قانونية في تنظيم الأسرة بالتعاون مع الكنيسة وجمعية نور للإغاثة والأونروا</li>
                <li>شاركت في دورات العدالة الانتقالية</li>
            </ul>',
        ],
        [
            'name' => 'بشار محمد الخوالدة',
            'full_name' => 'بشار محمد الخوالدة',
            'email' => 'bashar.mohammad.khawaldeh@amanlaw.ch',
            'password' => 'BMK2023',
            'phone' => '+963933789012',
            'years_of_experience' => '2',
            'birth_year' => '1998',
            'department_keywords' => ['أحوال شخصية', 'عقاري', 'مدني'],
            'designations' => 'محامي أستاذ',
            'about' => 'محامي أستاذ شاب من مواليد عام 1998. حاصل على صفة أستاذ عام 2025. ما زال يمارس مهنة المحاماة حتى اليوم.',
            'educations' => '<ul>
                <li>حاصل على إجازة في الحقوق</li>
                <li>حاصل على إجازة في المحاماة</li>
                <li>منتسب إلى نقابة المحامين – فرع درعا منذ عام 2023</li>
                <li>حاصل على صفة أستاذ عام 2025</li>
            </ul>',
            'experience' => '<ul>
                <li>منتسب إلى نقابة المحامين – فرع درعا منذ عام 2023</li>
                <li>حاصل على صفة أستاذ عام 2025</li>
                <li>ما زال يمارس مهنة المحاماة حتى اليوم</li>
            </ul>',
            'qualifications' => '<ul>
                <li>حاصل على صفة أستاذ عام 2025</li>
                <li>دورات تدريبية في الأحوال الشخصية</li>
                <li>دورات تدريبية في القضايا العقارية</li>
                <li>دورات تدريبية في المهارات الشخصية</li>
            </ul>',
        ],
    ];
    
    $now = now();
    $insertedCount = 0;
    $loginCredentials = [];
    
    foreach ($lawyersData as $lawyerData) {
        try {
            // Find appropriate department
            $lawyerDepartmentId = $findDepartment($lawyerData['department_keywords']);
            
            // Generate email if not set
            if (empty($lawyerData['email'])) {
                $nameParts = explode(' ', $lawyerData['full_name'] ?? $lawyerData['name']);
                if (count($nameParts) >= 2) {
                    $firstName = Str::slug($nameParts[0], '');
                    $lastName = Str::slug(end($nameParts), '');
                    $lawyerData['email'] = strtolower($firstName . '.' . $lastName . '@amanlaw.ch');
                } else {
                    $lawyerData['email'] = strtolower(Str::slug($lawyerData['name'], '.') . '@amanlaw.ch');
                }
                
                $baseEmail = $lawyerData['email'];
                $counter = 1;
                while (DB::table('lawyers')->where('email', $lawyerData['email'])->exists()) {
                    $emailParts = explode('@', $baseEmail);
                    $lawyerData['email'] = $emailParts[0] . $counter . '@' . $emailParts[1];
                    $counter++;
                }
            }
            
            // Generate password if not set
            if (empty($lawyerData['password'])) {
                $nameParts = explode(' ', $lawyerData['full_name'] ?? $lawyerData['name']);
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
            
            // Use full name if available
            $displayName = !empty($lawyerData['full_name']) ? $lawyerData['full_name'] : $lawyerData['name'];
            
            // Create lawyer record
            $lawyerRecord = [
                'department_id'       => $lawyerDepartmentId,
                'location_id'         => $location->id,
                'name'                => $displayName,
                'slug'                => Str::slug($displayName),
                'email'               => $lawyerData['email'],
                'password'            => Hash::make($lawyerData['password']),
                'phone'               => $lawyerData['phone'] ?? '+963' . rand(900000000, 999999999),
                'fee'                 => 50.00,
                'years_of_experience' => $lawyerData['years_of_experience'] ?? '5',
                'image'               => null, // Will be set from images folder if exists
                'status'              => 1,
                'show_homepage'       => 1,
                'wallet_balance'      => 0.00,
                'email_verified_at'   => $now,
                'created_at'          => $now,
                'updated_at'          => $now,
            ];
            
            // Check for existing image
            $imageDir = public_path('uploads/lawyers/');
            $imageSlug = Str::slug($displayName);
            $imageFiles = glob($imageDir . '*lawyer*' . $imageSlug . '*');
            if (empty($imageFiles)) {
                $imageFiles = glob($imageDir . '*lawyer-' . ($insertedCount) . '*');
            }
            if (!empty($imageFiles)) {
                $imageFile = $imageFiles[0];
                $imageRelativePath = 'uploads/lawyers/' . basename($imageFile);
                
                // Resize if GD is available
                if (extension_loaded('gd') && File::exists($imageFile)) {
                    try {
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($imageFile);
                        $image->resize(500, 500);
                        
                        $newImageName = 'lawyer-' . $imageSlug . '-' . time() . '.jpg';
                        $newImagePath = $imageDir . $newImageName;
                        $image->save($newImagePath);
                        $lawyerRecord['image'] = 'uploads/lawyers/' . $newImageName;
                    } catch (\Exception $e) {
                        $lawyerRecord['image'] = $imageRelativePath;
                    }
                } else {
                    $lawyerRecord['image'] = $imageRelativePath;
                }
            }
            
            // Insert lawyer
            $lawyerId = DB::table('lawyers')->insertGetId($lawyerRecord);
            
            // Get department name for display
            $matchedDept = $allDepartments->firstWhere('id', $lawyerDepartmentId);
            $deptName = $matchedDept ? $matchedDept->name : 'القانون العام';
            
            $insertedCount++;
            echo "✓ تم إضافة المحامي: {$displayName} (ID: {$lawyerId})\n";
            echo "  📧 الإيميل: {$lawyerData['email']}\n";
            echo "  🔑 كلمة المرور: {$lawyerData['password']}\n";
            echo "  📁 القسم: {$deptName}\n";
            echo "  ⏱️  سنوات الخبرة: {$lawyerData['years_of_experience']}\n";
            
            // Store credentials
            $loginCredentials[] = [
                'name' => $displayName,
                'email' => $lawyerData['email'],
                'password' => $lawyerData['password'],
                'id' => $lawyerId,
            ];
            
            // Delete existing translations
            LawyerTranslation::where('lawyer_id', $lawyerId)->delete();
            
            // Create translations
            $translations = [
                [
                    'lawyer_id' => $lawyerId,
                    'lang_code' => 'en',
                    'designations' => !empty($lawyerData['designations']) ? $lawyerData['designations'] : 'Lawyer',
                    'seo_title' => $displayName,
                    'seo_description' => 'Lawyer ' . $displayName . ' - ' . (!empty($lawyerData['designations']) ? $lawyerData['designations'] : 'Legal Services'),
                    'about' => !empty($lawyerData['about']) ? $lawyerData['about'] : 'Experienced lawyer providing legal services.',
                    'address' => '',
                    'educations' => !empty($lawyerData['educations']) ? $lawyerData['educations'] : '',
                    'experience' => !empty($lawyerData['experience']) ? $lawyerData['experience'] : '',
                    'qualifications' => !empty($lawyerData['qualifications']) ? $lawyerData['qualifications'] : '',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'lawyer_id' => $lawyerId,
                    'lang_code' => 'ar',
                    'designations' => !empty($lawyerData['designations']) ? $lawyerData['designations'] : 'محامي',
                    'seo_title' => $displayName,
                    'seo_description' => 'محامي ' . $displayName . ' - ' . (!empty($lawyerData['designations']) ? $lawyerData['designations'] : 'خدمات قانونية'),
                    'about' => !empty($lawyerData['about']) ? $lawyerData['about'] : 'محامي ذو خبرة يقدم خدمات قانونية.',
                    'address' => '',
                    'educations' => !empty($lawyerData['educations']) ? $lawyerData['educations'] : '',
                    'experience' => !empty($lawyerData['experience']) ? $lawyerData['experience'] : '',
                    'qualifications' => !empty($lawyerData['qualifications']) ? $lawyerData['qualifications'] : '',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ];
            
            foreach ($translations as $translation) {
                LawyerTranslation::create($translation);
            }
            
            echo "  ✓ تم إضافة الترجمات والمعلومات الكاملة\n\n";
            
        } catch (\Exception $e) {
            echo "❌ خطأ في إضافة المحامي {$lawyerData['name']}: " . $e->getMessage() . "\n";
        }
    }
    
    DB::commit();
    
    echo "\n=== النتائج ===\n";
    echo "تم الإضافة: {$insertedCount} محامي\n";
    
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
