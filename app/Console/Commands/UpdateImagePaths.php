<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\RealEstate\app\Models\RealEstate;

class UpdateImagePaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-image-paths {--from=real-estate : Source directory} {--to=properties : Target directory}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update image paths in real estate properties from one directory to another';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fromDir = $this->option('from');
        $toDir = $this->option('to');

        $this->info("Updating image paths from '{$fromDir}' to '{$toDir}'...");

        $properties = RealEstate::whereNotNull('images')
            ->orWhereNotNull('featured_image')
            ->get();

        $updatedCount = 0;

        foreach ($properties as $property) {
            $updated = false;

            // Update images array
            if ($property->images && is_array($property->images)) {
                $property->images = array_map(function ($image) use ($fromDir, $toDir) {
                    if (str_starts_with($image, $fromDir . '/')) {
                        return str_replace($fromDir . '/', $toDir . '/', $image);
                    }
                    return $image;
                }, $property->images);
                $updated = true;
            }

            // Update featured image
            if ($property->featured_image && str_starts_with($property->featured_image, $fromDir . '/')) {
                $property->featured_image = str_replace($fromDir . '/', $toDir . '/', $property->featured_image);
                $updated = true;
            }

            if ($updated) {
                $property->save();
                $updatedCount++;
            }
        }

        $this->info("Updated {$updatedCount} properties with new image paths.");
    }
}
