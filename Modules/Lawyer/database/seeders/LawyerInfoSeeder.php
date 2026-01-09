<?php

namespace Modules\Lawyer\database\seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\LawyerSocialMedia;
use Modules\Lawyer\app\Models\Lawyer;
use Modules\Lawyer\app\Models\LawyerTranslation;

class LawyerInfoSeeder extends Seeder {
    public function run() {
        $faker = Faker::create();
        $lawyers = [
            [
                'department_id'     => 1,
                'location_id'       => 1,
                'name'              => 'James Anderson',
                'email'             => 'james.anderson@law.com',
                'about' => 'المحامي أحمد الحسن متخصص في القانون المدني والتجاري السوري مع خبرة واسعة في القضايا المدنية والعقود التجارية. يقدم استشارات قانونية متخصصة ويمثل العملاء أمام المحاكم السورية.',
                'address' => 'شارع المحاكم، دمشق، سوريا',
                'educations' => '
                    <ul>
                        <li>إجازة في الحقوق - جامعة دمشق (2006)</li>
                        <li>دبلوم دراسات عليا في القانون المدني - جامعة دمشق (2011)</li>
                        <li>عضو نقابة المحامين السورية (2007)</li>
                    </ul>',
                'experience' => '
                    <ul>
                        <li>محامي متدرب - مكتب الأستاذ محمد العلي (2006-2011)</li>
                        <li>محامي أول - مكتب الحسن للمحاماة، دمشق (2011-حتى الآن)</li>
                    </ul>',
                'qualifications' => '
                    <ul>
                        <li>متخصص في القانون المدني والتجاري السوري</li>
                        <li>عضو نقابة المحامين السورية</li>
                        <li>خبرة في المرافعات أمام محاكم الاستئناف</li>
                    </ul>',
                'translations'      => [
                    ['lang_code' => 'en', 'designations' => 'Civil and Commercial Law', 'seo_title' => 'James Anderson', 'seo_description' => 'Lawyer specialized in Civil and Commercial Law'],
                    ['lang_code' => 'ar', 'designations' => 'القانون المدني والتجاري', 'seo_title' => 'James Anderson', 'seo_description' => 'محامي متخصص في القانون المدني والتجاري'],
                ],
                'wallet_balance' => 10,
            ],
            [
                'department_id'     => 2,
                'location_id'       => 1,
                'name'              => 'Sarah Mitchell',
                'email'             => 'sarah.mitchell@law.com',
                'about' => 'المحامية فاطمة السيد محامية متخصصة في قانون الأحوال الشخصية والأسرة السوري. تمتلك خبرة واسعة في قضايا الطلاق والحضانة والميراث، وتقدم خدمات قانونية متميزة للعائلات السورية.',
                'address' => 'شارع بغداد، دمشق، سوريا',
                'educations' => '
                    <ul>
                        <li>إجازة في الحقوق - جامعة دمشق (2004)</li>
                        <li>دبلوم دراسات عليا في قانون الأحوال الشخصية - جامعة دمشق (2009)</li>
                        <li>عضو نقابة المحامين السورية (2005)</li>
                    </ul>',
                'experience' => '
                    <ul>
                        <li>محامي متدرب - مكتب الأستاذة ليلى الأحمد (2004-2009)</li>
                        <li>شريك - مكتب السيد للاستشارات القانونية (2009-حتى الآن)</li>
                    </ul>',
                'qualifications' => '
                    <ul>
                        <li>متخصصة في قانون الأحوال الشخصية السوري</li>
                        <li>عضو نقابة المحامين السورية</li>
                        <li>خبيرة في قضايا الأسرة والميراث</li>
                    </ul>',

                'translations'      => [
                    ['lang_code' => 'en', 'designations' => 'Family and Personal Status Law', 'seo_title' => 'Sarah Mitchell', 'seo_description' => 'Lawyer specialized in Family Law'],
                    ['lang_code' => 'ar', 'designations' => 'قانون الأحوال الشخصية والأسرة', 'seo_title' => 'Sarah Mitchell', 'seo_description' => 'محامية متخصصة في قانون الأسرة'],
                ],
                'wallet_balance' => 420,
            ],
            [
                'department_id'     => 3,
                'location_id'       => 1,
                'name'              => 'Robert Thompson',
                'email'             => 'robert.thompson@law.com',
                'about' => 'المحامي محمد الخطيب محامي جنائي متمرس متخصص في الدفاع عن المتهمين في القضايا الجزائية. يمتلك فهماً عميقاً لقانون العقوبات السوري والإجراءات الجزائية.',
                'address' => 'ساحة العباسيين، دمشق، سوريا',
                'educations' => '
                    <ul>
                        <li>إجازة في الحقوق - جامعة حلب (2005)</li>
                        <li>دبلوم دراسات عليا في القانون الجنائي - جامعة دمشق (2010)</li>
                        <li>عضو نقابة المحامين السورية (2006)</li>
                    </ul>',
                'experience' => '
                    <ul>
                        <li>محامي متدرب - مكتب الدفاع الجنائي (2005-2010)</li>
                        <li>محامي أول - مكتب الخطيب للمحاماة (2010-حتى الآن)</li>
                    </ul>',
                'qualifications' => '
                    <ul>
                        <li>متخصص في القانون الجنائي السوري</li>
                        <li>عضو نقابة المحامين السورية</li>
                        <li>خبرة واسعة في المحاكمات الجنائية</li>
                    </ul>',
                'translations'      => [
                    ['lang_code' => 'en', 'designations' => 'Criminal Law', 'seo_title' => 'Robert Thompson', 'seo_description' => 'Lawyer specialized in Criminal Law'],
                    ['lang_code' => 'ar', 'designations' => 'القانون الجنائي', 'seo_title' => 'Robert Thompson', 'seo_description' => 'محامي متخصص في القانون الجنائي'],
                ],
                'wallet_balance' => 10,
            ],
            [
                'department_id'     => 4,
                'location_id'       => 1,
                'name'              => 'Emily Johnson',
                'email'             => 'emily.johnson@law.com',
                'about' => 'المحامية ليلى الأحمد محامية متخصصة في قانون العقارات والملكية في سوريا. تمتلك خبرة واسعة في المعاملات العقارية ونزاعات الملكية وتسجيل الأراضي.',
                'address' => 'شارع الثورة، دمشق، سوريا',
                'educations' => '
                    <ul>
                        <li>إجازة في الحقوق - جامعة دمشق (2007)</li>
                        <li>دبلوم دراسات عليا في قانون العقارات - جامعة دمشق (2012)</li>
                        <li>عضو نقابة المحامين السورية (2008)</li>
                    </ul>',
                'experience' => '
                    <ul>
                        <li>محامي متدرب - مكتب الأستاذ وليد الشامي (2007-2012)</li>
                        <li>شريك - مكتب الأحمد للعقارات (2012-حتى الآن)</li>
                    </ul>',
                'qualifications' => '
                    <ul>
                        <li>متخصصة في قانون العقارات السوري</li>
                        <li>عضو نقابة المحامين السورية</li>
                        <li>خبيرة في تسجيل الأراضي والملكيات</li>
                    </ul>',
                'translations'      => [
                    ['lang_code' => 'en', 'designations' => 'Real Estate Law', 'seo_title' => 'Emily Johnson', 'seo_description' => 'Lawyer specialized in Real Estate Law'],
                    ['lang_code' => 'ar', 'designations' => 'قانون العقارات', 'seo_title' => 'Emily Johnson', 'seo_description' => 'محامية متخصصة في قانون العقارات'],
                ],
            ],
            [
                'department_id'     => 1,
                'location_id'       => 2,
                'name'              => 'Michael Williams',
                'email'             => 'michael.williams@law.com',
                'about' => 'المحامي بشار الزعبي محامي متمرس في القانون المدني والتجاري، متخصص في عقود الشركات والنزاعات التجارية. يقدم استشارات قانونية شاملة للشركات والأفراد.',
                'address' => 'شارع الملك فيصل، حلب، سوريا',
                'educations' => '
                    <ul>
                        <li>إجازة في الحقوق - جامعة حلب (2004)</li>
                        <li>دبلوم دراسات عليا في القانون التجاري - جامعة دمشق (2009)</li>
                        <li>عضو نقابة المحامين السورية (2005)</li>
                    </ul>',
                'experience' => '
                    <ul>
                        <li>محامي متدرب - مكتب المحاماة التجارية (2004-2009)</li>
                        <li>شريك أول - مكتب الزعبي القانوني (2009-حتى الآن)</li>
                    </ul>',
                'qualifications' => '
                    <ul>
                        <li>متخصص في القانون التجاري السوري</li>
                        <li>عضو نقابة المحامين السورية</li>
                        <li>محكم معتمد في النزاعات التجارية</li>
                    </ul>',
                'translations'      => [
                    ['lang_code' => 'en', 'designations' => 'Civil and Commercial Law', 'seo_title' => 'Michael Williams', 'seo_description' => 'Lawyer specialized in Civil Law'],
                    ['lang_code' => 'ar', 'designations' => 'القانون المدني والتجاري', 'seo_title' => 'Michael Williams', 'seo_description' => 'محامي متخصص في القانون المدني'],
                ],
            ],
            [
                'department_id'     => 6,
                'location_id'       => 2,
                'name'              => 'David Brown',
                'email'             => 'david.brown@law.com',
                'about' => 'المحامي سامر حمود متخصص في القانون الإداري السوري، مع خبرة واسعة في العقود الحكومية والتراخيص والنزاعات الإدارية أمام المحاكم الإدارية.',
                'address' => 'شارع العروبة، حلب، سوريا',
                'educations' => '
                    <ul>
                        <li>إجازة في الحقوق - جامعة حلب (2005)</li>
                        <li>دبلوم دراسات عليا في القانون الإداري - جامعة دمشق (2010)</li>
                        <li>عضو نقابة المحامين السورية (2006)</li>
                    </ul>',
                'experience' => '
                    <ul>
                        <li>محامي متدرب - المحكمة الإدارية (2005-2010)</li>
                        <li>شريك - مكتب حمود للقانون الإداري (2010-حتى الآن)</li>
                    </ul>',
                'qualifications' => '
                    <ul>
                        <li>متخصص في القانون الإداري السوري</li>
                        <li>عضو نقابة المحامين السورية</li>
                        <li>خبير في العقود الإدارية</li>
                    </ul>',
                'translations'      => [
                    ['lang_code' => 'en', 'designations' => 'Administrative Law', 'seo_title' => 'David Brown', 'seo_description' => 'Lawyer specialized in Administrative Law'],
                    ['lang_code' => 'ar', 'designations' => 'القانون الإداري', 'seo_title' => 'David Brown', 'seo_description' => 'محامي متخصص في القانون الإداري'],
                ],
            ],
            [
                'department_id'     => 4,
                'location_id'       => 3,
                'name'              => 'Jessica Davis',
                'email'             => 'jessica.davis@law.com',
                'about' => 'المحامية مريم الحموي محامية متخصصة في قانون العقارات والملكية. تركز على المعاملات العقارية ونزاعات الملكية وتقديم حلول قانونية شاملة للعائلات والشركات.',
                'address' => 'شارع الكورنيش، حمص، سوريا',
                'educations' => '
                    <ul>
                        <li>إجازة في الحقوق - جامعة دمشق (2008)</li>
                        <li>دبلوم دراسات عليا في قانون العقارات - جامعة دمشق (2013)</li>
                        <li>عضو نقابة المحامين السورية (2009)</li>
                    </ul>',
                'experience' => '
                    <ul>
                        <li>محامي متدرب - مكتب العقارات القانوني (2008-2013)</li>
                        <li>شريك - مكتب الحموي للعقارات (2013-حتى الآن)</li>
                    </ul>',
                'qualifications' => '
                    <ul>
                        <li>متخصصة في قانون العقارات السوري</li>
                        <li>عضو نقابة المحامين السورية</li>
                        <li>مستشارة قانونية معتمدة</li>
                    </ul>',
                'translations'      => [
                    ['lang_code' => 'en', 'designations' => 'Real Estate Law', 'seo_title' => 'Jessica Davis', 'seo_description' => 'Lawyer specialized in Real Estate Law'],
                    ['lang_code' => 'ar', 'designations' => 'قانون العقارات', 'seo_title' => 'Jessica Davis', 'seo_description' => 'محامية متخصصة في قانون العقارات'],
                ],
            ],
            [
                'department_id'     => 3,
                'location_id'       => 3,
                'name'              => 'Christopher Wilson',
                'email'             => 'christopher.wilson@law.com',
                'about' => 'المحامي طارق النابلسي محامي جنائي متخصص في الدفاع الجنائي وحماية حقوق المتهمين. يتمتع بخبرة واسعة في التعامل مع القضايا الجنائية المعقدة أمام المحاكم السورية.',
                'address' => 'شارع الحمراء، حمص، سوريا',
                'educations' => '
                    <ul>
                        <li>إجازة في الحقوق - جامعة حلب (2003)</li>
                        <li>دبلوم دراسات عليا في القانون الجنائي - جامعة دمشق (2008)</li>
                        <li>عضو نقابة المحامين السورية (2004)</li>
                    </ul>',
                'experience' => '
                    <ul>
                        <li>محامي متدرب - المحاكم الجنائية (2003-2008)</li>
                        <li>شريك أول - مكتب النابلسي للدفاع الجنائي (2008-حتى الآن)</li>
                    </ul>',
                'qualifications' => '
                    <ul>
                        <li>متخصص في القانون الجنائي السوري</li>
                        <li>عضو نقابة المحامين السورية</li>
                        <li>خبير في الدفاع الجنائي</li>
                    </ul>',

                'translations'      => [
                    ['lang_code' => 'en', 'designations' => 'Criminal Law', 'seo_title' => 'Christopher Wilson', 'seo_description' => 'Lawyer specialized in Criminal Law'],
                    ['lang_code' => 'ar', 'designations' => 'القانون الجنائي', 'seo_title' => 'Christopher Wilson', 'seo_description' => 'محامي متخصص في القانون الجنائي'],
                ],
            ],
            [
                'department_id'     => 2,
                'location_id'       => 4,
                'name'              => 'Amanda Taylor',
                'email'             => 'amanda.taylor@law.com',
                'about' => 'المحامية نادية الشريف محامية متخصصة في قانون الأحوال الشخصية والأسرة. تقدم استشارات قانونية شاملة في قضايا الزواج والطلاق والحضانة والميراث.',
                'address' => 'شارع الشط، اللاذقية، سوريا',
                'educations' => '
                    <ul>
                        <li>إجازة في الحقوق - جامعة تشرين (2007)</li>
                        <li>دبلوم دراسات عليا في قانون الأسرة - جامعة دمشق (2012)</li>
                        <li>عضو نقابة المحامين السورية (2008)</li>
                    </ul>',
                'experience' => '
                    <ul>
                        <li>محامي متدرب - محكمة الأحوال الشخصية (2007-2012)</li>
                        <li>شريك - مكتب الشريف لقانون الأسرة (2012-حتى الآن)</li>
                    </ul>',
                'qualifications' => '
                    <ul>
                        <li>متخصصة في قانون الأحوال الشخصية السوري</li>
                        <li>عضو نقابة المحامين السورية</li>
                        <li>مستشارة أسرية قانونية معتمدة</li>
                    </ul>',

                'translations'      => [
                    ['lang_code' => 'en', 'designations' => 'Family Law', 'seo_title' => 'Amanda Taylor', 'seo_description' => 'Lawyer specialized in Family Law'],
                    ['lang_code' => 'ar', 'designations' => 'قانون الأسرة', 'seo_title' => 'Amanda Taylor', 'seo_description' => 'محامية متخصصة في قانون الأسرة'],
                ],
            ],
            [
                'department_id'     => 5,
                'location_id'       => 4,
                'name'              => 'Daniel Martinez',
                'email'             => 'daniel.martinez@law.com',
                'about' => 'المحامي وليد القاضي متخصص في قانون العمل والتوظيف في سوريا. يقدم استشارات قانونية للشركات والعمال في قضايا عقود العمل والنزاعات العمالية.',
                'address' => 'شارع الزراعة، اللاذقية، سوريا',
                'educations' => '
                    <ul>
                        <li>إجازة في الحقوق - جامعة تشرين (2006)</li>
                        <li>دبلوم دراسات عليا في قانون العمل - جامعة دمشق (2011)</li>
                        <li>عضو نقابة المحامين السورية (2007)</li>
                    </ul>',
                'experience' => '
                    <ul>
                        <li>محامي متدرب - مكتب قانون العمل (2006-2011)</li>
                        <li>شريك - مكتب القاضي للعمل والتوظيف (2011-حتى الآن)</li>
                    </ul>',
                'qualifications' => '
                    <ul>
                        <li>متخصص في قانون العمل السوري</li>
                        <li>عضو نقابة المحامين السورية</li>
                        <li>محكم معتمد في النزاعات العمالية</li>
                    </ul>',
                'translations'      => [
                    ['lang_code' => 'en', 'designations' => 'Labor Law', 'seo_title' => 'Daniel Martinez', 'seo_description' => 'Lawyer specialized in Labor Law'],
                    ['lang_code' => 'ar', 'designations' => 'قانون العمل', 'seo_title' => 'Daniel Martinez', 'seo_description' => 'محامي متخصص في قانون العمل'],
                ],
            ],
        ];

        foreach ($lawyers as $key => $lawyer) {
            $index = ++$key;
            $now = now();
            
            // Use email as the unique identifier to find existing lawyer
            $existingLawyer = Lawyer::where('email', $lawyer['email'])->first();
            
            $lawyerData = [
                'department_id'       => $lawyer['department_id'],
                'location_id'         => $lawyer['location_id'],
                'name'                => $lawyer['name'],
                'slug'                => Str::slug($lawyer['name']),
                'email'               => $lawyer['email'],
                'password'            => bcrypt(1234),
                'phone'               => $faker->phoneNumber,
                'fee'                 => $faker->numberBetween(15, 200),
                'years_of_experience' => $faker->numberBetween(1, 5),
                'image'               => "uploads/website-images/dummy/lawyer-{$index}.webp",
                'status'              => 1,
                'show_homepage'       => 1,
                'wallet_balance'       => $lawyer['wallet_balance'] ?? 0.00,
                'email_verified_at'   => $now,
                'updated_at'          => $now,
            ];
            
            // Only set created_at if creating new record
            if (!$existingLawyer) {
                $lawyerData['created_at'] = $now;
            }

            // Use email as the unique identifier instead of id to avoid conflicts
            $lawyerModel = Lawyer::updateOrCreate(['email' => $lawyer['email']], $lawyerData);
            $lawyerId = $lawyerModel->id;

            // Delete existing translations and social media for this lawyer
            LawyerTranslation::where('lawyer_id', $lawyerId)->delete();
            LawyerSocialMedia::where('lawyer_id', $lawyerId)->delete();
            
            foreach ($lawyer['translations'] as $translation) {
                LawyerTranslation::create([
                    'lawyer_id' => $lawyerId,
                    'lang_code' => $translation['lang_code'],
                    ...$translation,
                    'about' => $lawyer['about'],
                    'address' => $lawyer['address'],
                    'educations' => $lawyer['educations'],
                    'experience' => $lawyer['experience'],
                    'qualifications' => $lawyer['qualifications'],
                ]);
            }

            $socialMediaData = [
                [
                    'lawyer_id' => $lawyerId,
                    'icon'      => 'fab fa-facebook-f',
                    'link'      => 'https://www.facebook.com',
                    'status'    => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'lawyer_id' => $lawyerId,
                    'icon'      => 'fab fa-twitter',
                    'link'      => 'https://www.twitter.com',
                    'status'    => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'lawyer_id' => $lawyerId,
                    'icon'      => 'fab fa-linkedin-in',
                    'link'      => 'https://www.linkedin.com',
                    'status'    => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'lawyer_id' => $lawyerId,
                    'icon'      => 'fab fa-instagram',
                    'link'      => 'https://www.instagram.com',
                    'status'    => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'lawyer_id' => $lawyerId,
                    'icon'      => 'fas fa-globe',
                    'link'      => 'https://www.yourwebsite.com',
                    'status'    => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            ];
            LawyerSocialMedia::insert($socialMediaData);
        }
    }
}
