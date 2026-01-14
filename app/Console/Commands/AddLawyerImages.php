<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Lawyer\app\Models\Lawyer;
use Modules\GlobalSetting\app\Models\Setting;
use Illuminate\Support\Facades\File;

class AddLawyerImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lawyers:add-images {--force : تحديث جميع المحاميين حتى لو كان لديهم صور}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'إضافة صور للمحاميين الذين لا يملكون صوراً';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== إضافة صور للمحاميين الذين لا يملكون صوراً ===');
        $this->newLine();

        try {
            $force = $this->option('force');
            
            // الحصول على جميع المحاميين
            $lawyers = Lawyer::all();
            $updatedCount = 0;
            $skippedCount = 0;
            $invalidImageCount = 0;

            // الحصول على الصورة الافتراضية من الإعدادات
            $defaultAvatar = Setting::where('key', 'default_avatar')->first()?->value;
            $defaultAvatarPath = $defaultAvatar && File::exists(public_path($defaultAvatar)) 
                ? $defaultAvatar 
                : 'uploads/website-images/default-avatar.png';

            // قائمة بصور المحاميين المتاحة
            $availableLawyerImages = [
                'uploads/website-images/dummy/lawyer-1.webp',
                'uploads/website-images/dummy/lawyer-2.webp',
                'uploads/website-images/dummy/lawyer-3.webp',
                'uploads/website-images/dummy/lawyer-4.webp',
                'uploads/website-images/dummy/lawyer-5.webp',
                'uploads/website-images/dummy/lawyer-6.webp',
                'uploads/website-images/dummy/lawyer-7.webp',
                'uploads/website-images/dummy/lawyer-8.webp',
                'uploads/website-images/dummy/lawyer-9.webp',
                'uploads/website-images/dummy/lawyer-10.webp',
            ];

            // فلترة الصور المتاحة فعلياً
            $existingImages = [];
            foreach ($availableLawyerImages as $imagePath) {
                if (File::exists(public_path($imagePath))) {
                    $existingImages[] = $imagePath;
                }
            }

            if (empty($existingImages)) {
                $this->warn('⚠️  لم يتم العثور على صور محاميين في المجلد المحدد.');
                $this->info("سيتم استخدام الصورة الافتراضية: {$defaultAvatarPath}");
                $this->newLine();
            } else {
                $this->info('✓ تم العثور على ' . count($existingImages) . ' صورة محامي متاحة');
                $this->newLine();
            }

            $imageIndex = 0;
            $bar = $this->output->createProgressBar($lawyers->count());
            $bar->start();

            foreach ($lawyers as $lawyer) {
                // التحقق من وجود صورة للمحامي
                $needsImage = false;
                $imageStatus = '';
                
                if (empty($lawyer->image)) {
                    $needsImage = true;
                    $imageStatus = 'لا توجد صورة';
                } elseif (!File::exists(public_path($lawyer->image))) {
                    $needsImage = true;
                    $imageStatus = 'الصورة غير موجودة: ' . $lawyer->image;
                    $invalidImageCount++;
                } else {
                    $imageStatus = 'لديه صورة صحيحة';
                }
                
                // إذا كان الخيار --force مفعّل، قم بتحديث جميع المحاميين
                if ($force || $needsImage) {
                    // اختيار صورة من القائمة المتاحة
                    if (!empty($existingImages)) {
                        $selectedImage = $existingImages[$imageIndex % count($existingImages)];
                        $lawyer->image = $selectedImage;
                        $imageIndex++;
                    } else {
                        // استخدام الصورة الافتراضية
                        $lawyer->image = $defaultAvatarPath;
                    }
                    
                    $lawyer->save();
                    $updatedCount++;
                    
                    if ($this->getOutput()->isVerbose()) {
                        $this->line("  ✓ {$lawyer->name}: {$imageStatus} -> تم التحديث إلى: {$lawyer->image}");
                    }
                } else {
                    $skippedCount++;
                    if ($this->getOutput()->isVerbose()) {
                        $this->line("  - {$lawyer->name}: {$imageStatus}");
                    }
                }
                
                $bar->advance();
            }

            $bar->finish();
            $this->newLine(2);

            $this->info('=== النتائج ===');
            $this->info("تم تحديث: {$updatedCount} محامي");
            $this->info("تم تخطي: {$skippedCount} محامي");
            if ($invalidImageCount > 0) {
                $this->warn("صور غير موجودة تم اكتشافها: {$invalidImageCount}");
            }
            $this->newLine();
            
            if ($force) {
                $this->info('تم تحديث جميع المحاميين بنجاح! ✅');
            } else {
                $this->info('تم الانتهاء بنجاح! ✅');
                if ($updatedCount == 0 && $skippedCount > 0) {
                    $this->newLine();
                    $this->comment('💡 ملاحظة: جميع المحاميين لديهم صور بالفعل.');
                    $this->comment('   استخدم الخيار --force لتحديث جميع المحاميين:');
                    $this->comment('   php artisan lawyers:add-images --force');
                }
            }

            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error('❌ حدث خطأ: ' . $e->getMessage());
            $this->error('الملف: ' . $e->getFile());
            $this->error('السطر: ' . $e->getLine());
            return Command::FAILURE;
        }
    }
}
