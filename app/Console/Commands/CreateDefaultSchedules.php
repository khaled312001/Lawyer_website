<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Day\app\Models\Day;
use Modules\Lawyer\app\Models\Lawyer;
use Modules\Schedule\app\Models\Schedule;

class CreateDefaultSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedules:create-default';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create default schedules for all lawyers for all days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating default schedules for all lawyers...');

        $lawyers = Lawyer::active()->get();
        $days = Day::active()->get();

        // Default time slots
        $defaultSchedules = [
            ['start_time' => '9:00 AM', 'end_time' => '10:00 AM'],
            ['start_time' => '10:00 AM', 'end_time' => '11:00 AM'],
            ['start_time' => '11:00 AM', 'end_time' => '12:00 PM'],
            ['start_time' => '12:00 PM', 'end_time' => '1:00 PM'],
            ['start_time' => '1:00 PM', 'end_time' => '2:00 PM'],
            ['start_time' => '2:00 PM', 'end_time' => '3:00 PM'],
            ['start_time' => '3:00 PM', 'end_time' => '4:00 PM'],
            ['start_time' => '4:00 PM', 'end_time' => '5:00 PM'],
        ];

        $created = 0;
        $skipped = 0;

        foreach ($lawyers as $lawyer) {
            foreach ($days as $day) {
                // Check if schedule already exists
                $existingSchedule = Schedule::where([
                    'lawyer_id' => $lawyer->id,
                    'day_id' => $day->id,
                ])->first();

                if (!$existingSchedule) {
                    // Create default schedules for this lawyer and day
                    foreach ($defaultSchedules as $scheduleData) {
                        Schedule::create([
                            'lawyer_id' => $lawyer->id,
                            'day_id' => $day->id,
                            'start_time' => $scheduleData['start_time'],
                            'end_time' => $scheduleData['end_time'],
                            'quantity' => 10,
                            'status' => 1,
                        ]);
                        $created++;
                    }
                    $this->info("Created schedules for lawyer {$lawyer->name} on {$day->slug}");
                } else {
                    $skipped++;
                }
            }
        }

        $this->info("\nTotal schedules created: {$created}");
        $this->info("Total schedules skipped (already exist): {$skipped}");
        $this->info("\nDone!");

        return 0;
    }
}
