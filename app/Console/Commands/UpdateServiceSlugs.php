<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Service\app\Models\Service;
use Modules\Service\app\Models\ServiceTranslation;

class UpdateServiceSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'services:update-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update service slugs to reorder them (Real Estate first, Document Extraction second)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating service slugs...');

        // Update Real Estate service slug
        $realEstateService = Service::whereHas('translation', function ($query) {
            $query->where('title', 'خدمات العقارات القانونية')
                  ->orWhere('title', 'Real Estate Legal Services');
        })->first();

        if ($realEstateService) {
            $realEstateService->slug = '0-real-estate-legal-services';
            $realEstateService->save();
            $this->info('✓ Updated Real Estate service slug to: 0-real-estate-legal-services');
        } else {
            $this->warn('Real Estate service not found');
        }

        // Update Document Extraction service slug
        $docExtractionService = Service::whereHas('translation', function ($query) {
            $query->where('title', 'استخراج وثائق حكوميه من الدوله')
                  ->orWhere('title', 'Government Document Extraction');
        })->first();

        if ($docExtractionService) {
            $docExtractionService->slug = '1-government-document-extraction';
            $docExtractionService->save();
            $this->info('✓ Updated Document Extraction service slug to: 1-government-document-extraction');
        } else {
            $this->warn('Document Extraction service not found');
        }

        // Remove duplicate Commercial Law service (Business Law)
        $businessLawService = Service::whereHas('translation', function ($query) {
            $query->where('title', 'القانون التجاري')
                  ->where('sort_description', 'إرشاد قانوني لتأسيس الشركات والعقود والامتثال');
        })->first();

        if ($businessLawService) {
            // Check if there's another Corporate Law service
            $corporateLawService = Service::whereHas('translation', function ($query) {
                $query->where('title', 'القانون التجاري')
                      ->where('sort_description', 'الدعم القانوني لحوكمة الشركات والاندماجات والامتثال');
            })->where('id', '!=', $businessLawService->id)->first();

            if ($corporateLawService) {
                // Delete the duplicate Business Law service
                $businessLawService->delete();
                $this->info('✓ Removed duplicate Business Law service');
            }
        }

        $this->info('Service slugs updated successfully!');
        return 0;
    }
}

