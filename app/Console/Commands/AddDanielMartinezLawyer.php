<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Lawyer\app\Models\Lawyer;
use Modules\Lawyer\app\Models\LawyerTranslation;
use App\Models\LawyerSocialMedia;

class AddDanielMartinezLawyer extends Command
{
    protected $signature = 'lawyer:add-daniel-martinez';
    protected $description = 'Add or update Daniel Martinez lawyer in database';

    public function handle()
    {
        try {
            DB::beginTransaction();

            $email = 'daniel.martinez@law.com';
            $password = '1234';
            $name = 'Daniel Martinez';
            
            // Check if lawyer exists
            $existingLawyer = Lawyer::where('email', $email)->first();
            
            // Get default department and location (use first available)
            $department = DB::table('departments')->first();
            $location = DB::table('locations')->first();
            
            if (!$department || !$location) {
                $this->error('يجب وجود قسم وموقع واحد على الأقل في قاعدة البيانات');
                return 1;
            }
            
            $now = now();
            
            $lawyerData = [
                'department_id'       => $department->id,
                'location_id'         => $location->id,
                'name'                => $name,
                'slug'                => Str::slug($name),
                'email'               => $email,
                'password'            => Hash::make($password),
                'phone'               => '+41795578786',
                'fee'                 => 50.00,
                'years_of_experience' => '5',
                'image'               => 'lawyers/daniel-martinez.jpg',
                'status'              => 1,
                'show_homepage'       => 1,
                'wallet_balance'      => 0.00,
                'email_verified_at'   => $now,
                'updated_at'          => $now,
            ];
            
            // Only set created_at if creating new record
            if (!$existingLawyer) {
                $lawyerData['created_at'] = $now;
            }

            // Create or update lawyer
            $lawyer = Lawyer::updateOrCreate(['email' => $email], $lawyerData);
            $lawyerId = $lawyer->id;

            $this->info("✓ المحامي تم إنشاؤه/تحديثه بنجاح (ID: {$lawyerId})");

            // Delete existing translations and social media for this lawyer
            LawyerTranslation::where('lawyer_id', $lawyerId)->delete();
            LawyerSocialMedia::where('lawyer_id', $lawyerId)->delete();
            
            // Create translations
            $translations = [
                [
                    'lawyer_id' => $lawyerId,
                    'lang_code' => 'en',
                    'designations' => 'Labor Law',
                    'seo_title' => 'Daniel Martinez',
                    'seo_description' => 'Lawyer specialized in Labor Law',
                    'about' => 'Lawyer specialized in Labor and Employment Law in Syria. Provides legal consultations for companies and workers in employment contracts and labor disputes.',
                    'address' => 'شارع الزراعة، اللاذقية، سوريا',
                    'educations' => '<ul><li>إجازة في الحقوق - جامعة تشرين (2006)</li><li>دبلوم دراسات عليا في قانون العمل - جامعة دمشق (2011)</li><li>عضو نقابة المحامين السورية (2007)</li></ul>',
                    'experience' => '<ul><li>محامي متدرب - مكتب قانون العمل (2006-2011)</li><li>شريك - مكتب القاضي للعمل والتوظيف (2011-حتى الآن)</li></ul>',
                    'qualifications' => '<ul><li>متخصص في قانون العمل السوري</li><li>عضو نقابة المحامين السورية</li><li>محكم معتمد في النزاعات العمالية</li></ul>',
                ],
                [
                    'lawyer_id' => $lawyerId,
                    'lang_code' => 'ar',
                    'designations' => 'قانون العمل',
                    'seo_title' => 'Daniel Martinez',
                    'seo_description' => 'محامي متخصص في قانون العمل',
                    'about' => 'المحامي وليد القاضي متخصص في قانون العمل والتوظيف في سوريا. يقدم استشارات قانونية للشركات والعمال في قضايا عقود العمل والنزاعات العمالية.',
                    'address' => 'شارع الزراعة، اللاذقية، سوريا',
                    'educations' => '<ul><li>إجازة في الحقوق - جامعة تشرين (2006)</li><li>دبلوم دراسات عليا في قانون العمل - جامعة دمشق (2011)</li><li>عضو نقابة المحامين السورية (2007)</li></ul>',
                    'experience' => '<ul><li>محامي متدرب - مكتب قانون العمل (2006-2011)</li><li>شريك - مكتب القاضي للعمل والتوظيف (2011-حتى الآن)</li></ul>',
                    'qualifications' => '<ul><li>متخصص في قانون العمل السوري</li><li>عضو نقابة المحامين السورية</li><li>محكم معتمد في النزاعات العمالية</li></ul>',
                ],
            ];
            
            foreach ($translations as $translation) {
                LawyerTranslation::create($translation);
            }
            
            $this->info("✓ الترجمات تم إنشاؤها بنجاح");

            // Create social media links
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
            ];
            
            foreach ($socialMediaData as $social) {
                LawyerSocialMedia::create($social);
            }
            
            $this->info("✓ روابط وسائل التواصل الاجتماعي تم إنشاؤها بنجاح");

            DB::commit();

            $this->newLine();
            $this->info("✅ تم إضافة/تحديث المحامي بنجاح!");
            $this->newLine();
            $this->line("📧 البريد الإلكتروني: {$email}");
            $this->line("🔑 كلمة المرور: {$password}");
            $this->line("🔗 رابط تسجيل الدخول: https://amanlaw.ch/login?type=lawyer");
            $this->line("   أو: http://127.0.0.1:8000/login?type=lawyer");
            $this->newLine();

            return 0;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("❌ خطأ: " . $e->getMessage());
            $this->error("الملف: " . $e->getFile());
            $this->error("السطر: " . $e->getLine());
            return 1;
        }
    }
}
