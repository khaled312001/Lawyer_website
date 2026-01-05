<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Rating;
use Illuminate\Console\Command;
use Modules\Lawyer\app\Models\Lawyer;

class GiveHighRatingsToLawyers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lawyers:give-high-ratings 
                            {--rating=5 : Rating value (1-5)}
                            {--force : Force update existing ratings}
                            {--count=1 : Number of ratings per lawyer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'إعطاء تقييم عالي لكل المحاميين في قاعدة البيانات';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ratingValue = (int) $this->option('rating');
        $force = $this->option('force');
        $countPerLawyer = (int) $this->option('count');

        // Validate rating value
        if ($ratingValue < 1 || $ratingValue > 5) {
            $this->error('التقييم يجب أن يكون بين 1 و 5');
            return Command::FAILURE;
        }

        // Get first admin or create a system admin
        $admin = Admin::first();
        if (!$admin) {
            $this->error('لا يوجد أدمن في قاعدة البيانات. يرجى إنشاء أدمن أولاً.');
            return Command::FAILURE;
        }

        // Get all active lawyers
        $lawyers = Lawyer::where('status', 'active')->get();

        if ($lawyers->isEmpty()) {
            $this->warn('لا يوجد محاميين نشطين في قاعدة البيانات.');
            return Command::SUCCESS;
        }

        $this->info("تم العثور على {$lawyers->count()} محامي نشط.");
        $this->newLine();

        $totalRatingsCreated = 0;
        $totalRatingsUpdated = 0;
        $skipped = 0;

        $bar = $this->output->createProgressBar($lawyers->count());
        $bar->start();

        foreach ($lawyers as $lawyer) {
            // Check if lawyer already has admin-created ratings
            $existingRatings = Rating::where('lawyer_id', $lawyer->id)
                ->where('is_admin_created', true)
                ->count();

            if ($existingRatings > 0 && !$force) {
                $skipped++;
                $bar->advance();
                continue;
            }

            // If force is enabled, delete existing admin ratings first
            if ($force && $existingRatings > 0) {
                Rating::where('lawyer_id', $lawyer->id)
                    ->where('is_admin_created', true)
                    ->delete();
            }

            // Create new high ratings for this lawyer
            for ($i = 0; $i < $countPerLawyer; $i++) {
                Rating::create([
                    'lawyer_id' => $lawyer->id,
                    'user_id' => null, // Admin-created ratings don't need user_id
                    'rating' => $ratingValue,
                    'comment' => $this->getRandomComment($ratingValue),
                    'is_admin_created' => true,
                    'created_by_admin_id' => $admin->id,
                    'status' => true,
                ]);
                $totalRatingsCreated++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Display summary
        $this->info('✅ تم الانتهاء بنجاح!');
        $this->newLine();
        $this->table(
            ['الإحصائية', 'العدد'],
            [
                ['المحاميين المعالجين', $lawyers->count()],
                ['التقييمات الجديدة', $totalRatingsCreated],
                ['المحاميين المتخطيين', $skipped],
                ['قيمة التقييم', $ratingValue . ' / 5'],
            ]
        );

        return Command::SUCCESS;
    }

    /**
     * Get random comment based on rating value
     */
    private function getRandomComment(int $rating): string
    {
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
            ],
            3 => [
                'مقبول',
                'أداء متوسط',
            ],
            2 => [
                'أداء ضعيف',
            ],
            1 => [
                'أداء سيء',
            ],
        ];

        $ratingComments = $comments[$rating] ?? $comments[5];
        return $ratingComments[array_rand($ratingComments)];
    }
}
