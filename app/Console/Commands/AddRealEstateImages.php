<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\RealEstate\app\Models\RealEstate;
use Illuminate\Support\Facades\File;

class AddRealEstateImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-real-estate-images {--force : Force update even if images already exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add real estate images to all properties from Google/public sources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to update real estate images...');

        $force = $this->option('force');

        // Real estate image URLs from Unsplash (free stock photos)
        // These are high-quality, real property images suitable for real estate listings
        $propertyImages = [
            'apartment' => [
                'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1507089947368-19c1da9775ae?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1536376072261-38c75010e6c9?w=1200&h=800&fit=crop&q=80',
            ],
            'villa' => [
                'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1600607687644-c7171b42498b?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1600585152915-d208bec867a1?w=1200&h=800&fit=crop&q=80',
            ],
            'office' => [
                'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1553877522-43269d4ea984?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1497215842964-222b430dc094?w=1200&h=800&fit=crop&q=80',
            ],
            'land' => [
                'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1472214103451-9374bd1c798e?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1200&h=800&fit=crop&q=80',
            ],
            'shop' => [
                'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&h=800&fit=crop&q=80',
            ],
            'warehouse' => [
                'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=1200&h=800&fit=crop&q=80',
                'https://images.unsplash.com/photo-1565814329452-e1efa11c5b89?w=1200&h=800&fit=crop&q=80',
            ],
        ];

        $query = RealEstate::query();

        if (!$force) {
            $query->where(function($q) {
                $q->whereNull('images')
                  ->orWhere('images', '[]')
                  ->orWhere('images', '');
            });
        }

        $properties = $query->get();

        if ($properties->isEmpty()) {
            $this->info('No properties found that need images.');
            return;
        }

        $this->info("Found {$properties->count()} properties to update.");

        $progressBar = $this->output->createProgressBar($properties->count());
        $progressBar->start();

        foreach ($properties as $property) {
            $propertyType = $property->property_type ?? 'apartment';
            $availableImages = $propertyImages[$propertyType] ?? $propertyImages['apartment'];

            // Select 3-5 random images for this property
            $numImages = rand(3, 5);
            $selectedIndices = array_rand($availableImages, min($numImages, count($availableImages)));
            if (!is_array($selectedIndices)) {
                $selectedIndices = [$selectedIndices];
            }

            $imagePaths = [];
            foreach ($selectedIndices as $index) {
                $imageUrl = $availableImages[$index];
                $filename = 'property_' . $property->id . '_' . time() . '_' . ($index + 1) . '.jpg';

                $path = $this->downloadImage($imageUrl, $filename);

                if ($path) {
                    $imagePaths[] = $path;
                }
            }

            if (!empty($imagePaths)) {
                // Update the property with the images
                $property->update([
                    'images' => $imagePaths,
                    'featured_image' => $imagePaths[0], // Set first image as featured
                ]);
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);
        $this->info('Finished updating real estate images!');
    }

    private function downloadImage($url, $filename)
    {
        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            $imageData = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            if ($imageData && $httpCode == 200 && strlen($imageData) > 1000) {
                // Use Laravel Storage instead of public_path
                $storagePath = storage_path('app/public/real-estate');
                
                if (!File::exists($storagePath)) {
                    File::makeDirectory($storagePath, 0755, true);
                }

                $filePath = $storagePath . '/' . $filename;
                
                if (file_put_contents($filePath, $imageData)) {
                    // Return relative path for database storage
                    return 'real-estate/' . $filename;
                }
            } else {
                $this->warn("Failed to download image from {$url}. HTTP Code: {$httpCode}, Error: {$error}");
            }
        } catch (\Exception $e) {
            $this->warn("Exception downloading image: " . $e->getMessage());
        }

        return null;
    }
}
