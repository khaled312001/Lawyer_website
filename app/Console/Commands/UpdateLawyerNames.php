<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Modules\Lawyer\app\Models\Lawyer;
use Modules\Lawyer\app\Models\LawyerTranslation;

class UpdateLawyerNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lawyers:update-names';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all lawyer names to English names';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to update lawyer names...');

        // Mapping of old Arabic names to new English names
        $nameMapping = [
            'أحمد الحسن' => 'James Anderson',
            'فاطمة السيد' => 'Sarah Mitchell',
            'محمد الخطيب' => 'Robert Thompson',
            'ليلى الأحمد' => 'Emily Johnson',
            'بشار الزعبي' => 'Michael Williams',
            'سامر حمود' => 'David Brown',
            'مريم الحموي' => 'Jessica Davis',
            'طارق النابلسي' => 'Christopher Wilson',
            'نادية الشريف' => 'Amanda Taylor',
            'وليد القاضي' => 'Daniel Martinez',
            // Also check for partial matches or variations
            'Ahmad' => 'James',
            'Ahmed' => 'James',
            'Fatima' => 'Sarah',
            'Mohammad' => 'Robert',
            'Mohammed' => 'Robert',
            'Layla' => 'Emily',
            'Leila' => 'Emily',
            'Bashar' => 'Michael',
            'Samer' => 'David',
            'Mariam' => 'Jessica',
            'Maryam' => 'Jessica',
            'Tarek' => 'Christopher',
            'Tariq' => 'Christopher',
            'Nadia' => 'Amanda',
            'Walid' => 'Daniel',
        ];

        $updated = 0;
        $notFound = [];

        // Get all lawyers
        $lawyers = Lawyer::all();

        foreach ($lawyers as $lawyer) {
            $oldName = $lawyer->name;
            $newName = null;

            // Check if name matches any Arabic name in mapping
            foreach ($nameMapping as $arabicName => $englishName) {
                if (stripos($oldName, $arabicName) !== false || $oldName === $arabicName) {
                    $newName = $englishName;
                    break;
                }
            }

            // If no match found, check if name contains Arabic characters
            if (!$newName && preg_match('/[\x{0600}-\x{06FF}]/u', $oldName)) {
                // Generate English name based on ID or use Faker
                $englishNames = [
                    1 => 'James Anderson',
                    2 => 'Sarah Mitchell',
                    3 => 'Robert Thompson',
                    4 => 'Emily Johnson',
                    5 => 'Michael Williams',
                    6 => 'David Brown',
                    7 => 'Jessica Davis',
                    8 => 'Christopher Wilson',
                    9 => 'Amanda Taylor',
                    10 => 'Daniel Martinez',
                    11 => 'Thomas Anderson',
                    12 => 'Jennifer White',
                    13 => 'Matthew Harris',
                    14 => 'Lisa Jackson',
                    15 => 'Kevin Moore',
                ];

                // Use predefined name or generate one
                if (isset($englishNames[$lawyer->id])) {
                    $newName = $englishNames[$lawyer->id];
                } else {
                    // Generate random English name
                    $firstNames = ['John', 'Michael', 'David', 'James', 'Robert', 'William', 'Richard', 'Joseph', 'Thomas', 'Charles', 'Sarah', 'Jennifer', 'Lisa', 'Jessica', 'Emily', 'Amanda', 'Melissa', 'Michelle', 'Kimberly', 'Amy'];
                    $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Wilson', 'Anderson', 'Thomas', 'Taylor', 'Moore', 'Jackson', 'Martin', 'Lee'];
                    
                    $newName = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
                }
            }

            // Also check for generic names like "Lawyer X"
            if (!$newName && preg_match('/^Lawyer\s+\d+$/i', $oldName)) {
                $englishNames = [
                    1 => 'James Anderson',
                    2 => 'Sarah Mitchell',
                    3 => 'Robert Thompson',
                    4 => 'Emily Johnson',
                    5 => 'Michael Williams',
                    6 => 'David Brown',
                    7 => 'Jessica Davis',
                    8 => 'Christopher Wilson',
                    9 => 'Amanda Taylor',
                    10 => 'Daniel Martinez',
                    11 => 'Thomas Anderson',
                    12 => 'Jennifer White',
                    13 => 'Matthew Harris',
                    14 => 'Lisa Jackson',
                    15 => 'Kevin Moore',
                ];
                $newName = $englishNames[$lawyer->id] ?? null;
            }

            if ($newName && $oldName !== $newName) {
                // Update lawyer name
                $lawyer->name = $newName;
                $lawyer->slug = Str::slug($newName);
                $lawyer->save();

                // Update translations SEO titles
                $translations = LawyerTranslation::where('lawyer_id', $lawyer->id)->get();
                foreach ($translations as $translation) {
                    // Only update if SEO title contains Arabic characters or old name
                    if (preg_match('/[\x{0600}-\x{06FF}]/u', $translation->seo_title) || 
                        stripos($translation->seo_title, $oldName) !== false) {
                        $translation->seo_title = $newName;
                        $translation->save();
                    }
                }

                $this->info("Updated: {$oldName} -> {$newName}");
                $updated++;
            } else {
                if (!preg_match('/[\x{0600}-\x{06FF}]/u', $oldName)) {
                    $this->line("Already English: {$oldName}");
                } else {
                    $notFound[] = $oldName;
                }
            }
        }

        $this->info("\nTotal updated: {$updated}");

        if (count($notFound) > 0) {
            $this->warn("\nNames not found in mapping:");
            foreach ($notFound as $name) {
                $this->warn("  - {$name}");
            }
        }

        $this->info("\nDone!");
        
        return 0;
    }
}
