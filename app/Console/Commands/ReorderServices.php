<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Service\app\Models\Service;
use Modules\Service\app\Models\ServiceTranslation;

class ReorderServices extends Command
{
    protected $signature = 'app:reorder-services';
    protected $description = 'Reorder services: استخراج وثائق and خدمات العقارات first';

    public function handle()
    {
        // ترتيب الخدمات
        $order = [
            'استخراج وثائق حكوميه من الدوله' => '0-document-extraction',
            'خدمات العقارات القانونية' => '1-real-estate-legal-services',
            'قانون التأمين' => '2-insurance-law',
            'قانون الأسرة' => '3-family-law',
            'القانون البيئي' => '4-environmental-law',
            'القانون الجنائي' => '5-criminal-law',
            'القانون التجاري' => '6-commercial-law',
        ];

        foreach ($order as $title => $slug) {
            $translation = ServiceTranslation::where('title', 'like', '%' . $title . '%')
                ->orWhere('title', 'like', '%' . str_replace('حكوميه', 'حكومية', $title) . '%')
                ->first();
            
            if ($translation) {
                $service = Service::find($translation->service_id);
                if ($service) {
                    $service->slug = $slug;
                    $service->save();
                    $this->info("Updated: {$title} -> {$slug}");
                }
            }
        }

        $this->info('Services reordered successfully!');
    }
}

