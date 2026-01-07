<?php

namespace App\Console\Commands;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Console\Command;
use Modules\Lawyer\app\Models\Lawyer;

class GiveHighRatingsToAllLawyers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lawyers:give-high-ratings {--count=3 : Number of fake reviews per lawyer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add high ratings (4-5 stars) to all lawyers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->option('count');
        $lawyers = Lawyer::active()->get();
        
        if ($lawyers->isEmpty()) {
            $this->error('No active lawyers found!');
            return 1;
        }

        $fakeNames = [
            'أحمد محمد', 'فاطمة علي', 'محمد حسن', 'سارة أحمد', 'خالد إبراهيم',
            'نورا محمود', 'عمر يوسف', 'ليلى عبدالله', 'يوسف كمال', 'مريم سالم',
            'علي محمود', 'هند يوسف', 'طارق أحمد', 'ريم خالد', 'سامي فؤاد'
        ];

        $fakeComments = [
            'محامي ممتاز ومحترف جداً. ساعدني في حل قضيتي بسرعة وفعالية.',
            'خدمة رائعة ومهنية عالية. أنصح الجميع بالتعامل معه.',
            'خبرة واسعة ومعرفة عميقة بالقانون. استشارة قيمة جداً.',
            'محامي محترف ومتفهم. شرح لي كل شيء بوضوح.',
            'خدمة ممتازة وتواصل سريع. راضٍ جداً عن الخدمة.',
            'محامي خبير ومتمكن. ساعدني في الحصول على حقوقي.',
            'خدمة احترافية ومتابعة دقيقة. أنصح به بشدة.',
            'محامي متميز وذو خبرة عالية. استشارة مفيدة جداً.',
            'خدمة رائعة وسريعة. محامي محترف ومتفهم.',
            'محامي ممتاز ومحترف. ساعدني في حل مشكلتي القانونية.',
            'محامي محترف جداً. استشارة قيمة وسريعة.',
            'خدمة ممتازة ومهنية. أنصح به بشدة.',
            'محامي خبير ومتمكن من القانون. راضٍ جداً.',
            'خدمة رائعة وتواصل ممتاز. محامي محترف.',
            'محامي متميز وذو خبرة واسعة. استشارة مفيدة.'
        ];

        $bar = $this->output->createProgressBar($lawyers->count());
        $bar->start();

        $totalRatings = 0;

        foreach ($lawyers as $lawyer) {
            // Check existing admin ratings count
            $existingRatings = Rating::where('lawyer_id', $lawyer->id)
                ->where('is_admin_created', true)
                ->count();

            $ratingsToAdd = max(0, $count - $existingRatings);

            for ($i = 0; $i < $ratingsToAdd; $i++) {
                $rating = rand(4, 5); // Only 4 or 5 stars
                $fakeName = $fakeNames[array_rand($fakeNames)];
                $fakeComment = $fakeComments[array_rand($fakeComments)];

                // Try to find a user with similar name, or use null
                $fakeUser = User::where('name', 'like', '%' . $fakeName . '%')->first();

                Rating::create([
                    'lawyer_id' => $lawyer->id,
                    'user_id' => $fakeUser?->id ?? null,
                    'rating' => $rating,
                    'comment' => $fakeComment,
                    'is_admin_created' => true,
                    'created_by_admin_id' => null, // System generated
                    'status' => true,
                ]);

                $totalRatings++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Successfully added {$totalRatings} high ratings to {$lawyers->count()} lawyers!");

        return 0;
    }
}

