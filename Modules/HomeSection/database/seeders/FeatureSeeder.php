<?php

namespace Modules\HomeSection\database\seeders;

use Illuminate\Database\Seeder;
use Modules\HomeSection\app\Models\Feature;
use Modules\HomeSection\app\Models\FeatureTranslation;

class FeatureSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $dummyFeatures = [
            [
                'image'        => 'uploads/website-images/dummy/featur-1.webp',
                'icon'         => 'fas fa-balance-scale',
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'title'       => 'Expert Legal Counsel',
                        'description' => 'Our experienced Syrian lawyers provide expert legal guidance in all areas of law.',
                    ],
                    [
                        'lang_code'   => 'ar',
                        'title'       => 'استشارة قانونية متخصصة',
                        'description' => 'يقدم محامونا السوريون ذوو الخبرة إرشادات قانونية متخصصة في جميع مجالات القانون.',
                    ],
                ],
            ],
            [
                'image'        => 'uploads/website-images/dummy/featur-2.webp',
                'icon'         => 'fas fa-user-shield',
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'title'       => 'Client Rights Protection',
                        'description' => 'We are committed to protecting your legal rights throughout the entire legal process.',
                    ],
                    [
                        'lang_code'   => 'ar',
                        'title'       => 'حماية حقوق الموكلين',
                        'description' => 'نلتزم بحماية حقوقك القانونية طوال العملية القانونية بأكملها.',
                    ],
                ],
            ],
            [
                'image'        => 'uploads/website-images/dummy/featur-3.webp',
                'icon'         => 'fas fa-gavel',
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'title'       => 'Professional Representation',
                        'description' => 'Professional legal representation in Syrian courts with proven track record of success.',
                    ],
                    [
                        'lang_code'   => 'ar',
                        'title'       => 'تمثيل قانوني احترافي',
                        'description' => 'تمثيل قانوني احترافي في المحاكم السورية مع سجل حافل بالنجاحات.',
                    ],
                ],
            ],
        ];

        foreach ($dummyFeatures as $item) {
            // Insert feature
            $feature = Feature::create([
                'image' => $item['image'],
                'icon'  => $item['icon'],
            ]);

            // Insert feature translations
            foreach ($item['translations'] as $translation) {
                FeatureTranslation::create([
                    'feature_id'  => $feature->id,
                    'lang_code'   => $translation['lang_code'],
                    'title'       => $translation['title'],
                    'description' => $translation['description'],
                ]);
            }
        }
    }
}
