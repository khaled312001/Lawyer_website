<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Rating;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Modules\Lawyer\app\Models\Lawyer;

class CreateAndUpdateRatings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ratings:create-and-update {--min=4 : Minimum rating (4 or 5)} {--max=5 : Maximum rating (4 or 5)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'إنشاء تقييمات للمحاميين الذين لا يملكون تقييمات وتحديث التقييمات الموجودة لتكون بين 4 و 5';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $minRating = (int) $this->option('min');
        $maxRating = (int) $this->option('max');

        // التحقق من القيم
        if ($minRating < 1 || $minRating > 5 || $maxRating < 1 || $maxRating > 5) {
            $this->error('التقييم يجب أن يكون بين 1 و 5');
            return Command::FAILURE;
        }

        if ($minRating > $maxRating) {
            $this->error('الحد الأدنى يجب أن يكون أقل من أو يساوي الحد الأقصى');
            return Command::FAILURE;
        }

        $this->info('🔄 بدء عملية إنشاء وتحديث التقييمات...');
        $this->newLine();

        // الحصول على أول أدمن
        $admin = Admin::first();
        if (!$admin) {
            $this->error('❌ لا يوجد أدمن في قاعدة البيانات. يرجى إنشاء أدمن أولاً.');
            return Command::FAILURE;
        }

        $this->info("✅ تم العثور على الأدمن: {$admin->name} (ID: {$admin->id})");
        $this->newLine();

        // الحصول على جميع المحاميين النشطين
        $lawyers = Lawyer::where('status', 'active')->get();

        if ($lawyers->isEmpty()) {
            $this->warn('⚠️  لا يوجد محاميين نشطين في قاعدة البيانات.');
            return Command::SUCCESS;
        }

        $this->info("📊 تم العثور على {$lawyers->count()} محامي نشط");
        $this->newLine();

        $totalUpdated = 0;
        $totalCreated = 0;
        $skipped = 0;

        $bar = $this->output->createProgressBar($lawyers->count());
        $bar->start();

        // التعليقات العشوائية
        $comments = [
            5 => [
                'محامي ممتاز ومحترف جداً',
                'خدمة رائعة ومهنية عالية',
                'خبرة واسعة وأداء متميز',
                'محامي موثوق ومحترف',
                'أفضل محامي تعاملت معه',
                'خدمة ممتازة وتوصيات قيمة',
                'محترف في مجاله',
                'رائع جداً ومتجاوب',
            ],
            4 => [
                'محامي جيد ومحترف',
                'خدمة جيدة',
                'أداء جيد',
                'محترف',
                'مستشار قانوني موثوق',
            ],
        ];

        foreach ($lawyers as $lawyer) {
            // التحقق من وجود تقييمات للمحامي
            $existingRatings = Rating::where('lawyer_id', $lawyer->id)
                ->where('status', true)
                ->get();

            if ($existingRatings->count() > 0) {
                // تحديث التقييمات الموجودة
                foreach ($existingRatings as $rating) {
                    $newRating = rand($minRating, $maxRating);
                    $rating->update([
                        'rating' => $newRating,
                        'comment' => $rating->comment ?: ($comments[$newRating][array_rand($comments[$newRating])] ?? 'تقييم جيد'),
                    ]);
                    $totalUpdated++;
                }
            } else {
                // إنشاء تقييم جديد للمحامي
                $newRating = rand($minRating, $maxRating);
                Rating::create([
                    'lawyer_id' => $lawyer->id,
                    'user_id' => null,
                    'rating' => $newRating,
                    'comment' => $comments[$newRating][array_rand($comments[$newRating])] ?? 'تقييم جيد',
                    'is_admin_created' => true,
                    'created_by_admin_id' => $admin->id,
                    'status' => true,
                ]);
                $totalCreated++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // عرض ملخص النتائج
        $this->info('✅ تم الانتهاء بنجاح!');
        $this->newLine();
        $this->table(
            ['الإحصائية', 'العدد'],
            [
                ['المحاميين المعالجين', $lawyers->count()],
                ['التقييمات الجديدة', $totalCreated],
                ['التقييمات المحدثة', $totalUpdated],
                ['نطاق التقييم', "{$minRating} - {$maxRating} نجوم"],
            ]
        );

        // عرض إحصائيات التقييمات بعد التحديث
        $this->newLine();
        $this->info('📈 إحصائيات التقييمات بعد التحديث:');
        $stats = Rating::select('rating', DB::raw('count(*) as count'))
            ->where('status', true)
            ->groupBy('rating')
            ->orderBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        foreach ($stats as $rating => $count) {
            $this->line("   ⭐ {$rating} نجوم: {$count} تقييم");
        }

        return Command::SUCCESS;
    }
}

