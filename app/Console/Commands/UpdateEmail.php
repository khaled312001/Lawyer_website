<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\ContactMessage\app\Models\ContactInfo;
use Illuminate\Support\Facades\Cache;

class UpdateEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:update-email {email=info@amanlaw.ch : البريد الإلكتروني الجديد}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'تحديث الإيميل في معلومات الاتصال';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newEmail = $this->argument('email');
        
        $this->info('=== تحديث الإيميل ===');
        $this->info("الإيميل الجديد: {$newEmail}");
        $this->newLine();

        try {
            // الحصول على سجل ContactInfo الأول (عادة يكون واحد فقط)
            $contactInfo = ContactInfo::first();
            
            if (!$contactInfo) {
                $this->warn('⚠️  لم يتم العثور على سجل معلومات الاتصال.');
                $this->info('سيتم إنشاء سجل جديد...');
                
                if ($this->confirm('هل تريد المتابعة؟', true)) {
                    $contactInfo = ContactInfo::create([
                        'top_bar_email' => $newEmail,
                        'email' => $newEmail,
                    ]);
                    $this->info("✓ تم إنشاء سجل جديد مع الإيميل: {$newEmail}");
                } else {
                    $this->info('تم الإلغاء.');
                    return Command::SUCCESS;
                }
            } else {
                $oldTopBarEmail = $contactInfo->top_bar_email;
                $oldEmail = $contactInfo->email;
                
                $this->info('الإيميل الحالي في الهيدر (top_bar_email): ' . ($oldTopBarEmail ?: 'غير محدد'));
                $this->info('الإيميل الحالي (email): ' . ($oldEmail ?: 'غير محدد'));
                $this->newLine();
                
                if ($this->confirm('هل تريد تحديث الإيميل؟', true)) {
                    // تحديث الإيميل
                    $contactInfo->top_bar_email = $newEmail;
                    $contactInfo->email = $newEmail;
                    $contactInfo->save();
                    
                    // مسح الكاش
                    Cache::forget('contactInfo');
                    
                    $this->info('✓ تم تحديث الإيميل بنجاح!');
                    $this->info("  - top_bar_email: {$oldTopBarEmail} -> {$newEmail}");
                    $this->info("  - email: {$oldEmail} -> {$newEmail}");
                } else {
                    $this->info('تم الإلغاء.');
                    return Command::SUCCESS;
                }
            }
            
            $this->newLine();
            $this->info('تم الانتهاء بنجاح! ✅');

            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error('❌ حدث خطأ: ' . $e->getMessage());
            $this->error('الملف: ' . $e->getFile());
            $this->error('السطر: ' . $e->getLine());
            return Command::FAILURE;
        }
    }
}
