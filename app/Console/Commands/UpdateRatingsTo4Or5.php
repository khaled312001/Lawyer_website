<?php

namespace App\Console\Commands;

use App\Models\Rating;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateRatingsTo4Or5 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ratings:update-to-4-5';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'تحديث جميع التقييمات الموجودة لتكون بين 4 و 5 نجوم';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔄 بدء تحديث التقييمات...');
        $this->newLine();

        // الحصول على عدد التقييمات قبل التحديث
        $totalRatings = Rating::count();
        $this->info("📊 إجمالي التقييمات: {$totalRatings}");

        if ($totalRatings == 0) {
            $this->warn('⚠️  لا توجد تقييمات في قاعدة البيانات.');
            return Command::SUCCESS;
        }

        // عرض إحصائيات قبل التحديث
        $beforeStats = Rating::select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->orderBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        $this->info('📈 التقييمات قبل التحديث:');
        foreach ($beforeStats as $rating => $count) {
            $this->line("   ⭐ {$rating} نجوم: {$count} تقييم");
        }
        $this->newLine();

        // تحديث جميع التقييمات لتكون عشوائياً بين 4 و 5
        $updated = DB::table('ratings')
            ->update([
                'rating' => DB::raw('FLOOR(4 + RAND() * 2)')
            ]);

        $this->info("✅ تم تحديث {$updated} تقييم بنجاح!");
        $this->newLine();

        // عرض إحصائيات بعد التحديث
        $afterStats = Rating::select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->orderBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        $this->info('📈 التقييمات بعد التحديث:');
        foreach ($afterStats as $rating => $count) {
            $this->line("   ⭐ {$rating} نجوم: {$count} تقييم");
        }
        $this->newLine();

        $this->info('✅ تم الانتهاء بنجاح!');
        return Command::SUCCESS;
    }
}

