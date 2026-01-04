<?php

namespace Modules\HomeSection\database\seeders;

use Illuminate\Database\Seeder;
use Modules\HomeSection\app\Models\WorkSection;
use Modules\HomeSection\app\Models\WorkSectionFaq;
use Modules\HomeSection\app\Models\WorkSectionFaqTranslation;
use Modules\HomeSection\app\Models\WorkSectionTranslation;

class WorkSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed work sections
        $dummyWorkSections = [
            [
                'image' => 'uploads/website-images/dummy/work-background.webp',
                'video' => 'https://www.youtube.com/watch?v=G07V0aOmWTI',
                'translations' => [
                    [
                        'lang_code' => 'en',
                        'title' => 'Ensure Justice with Our Trusted Legal Support',
                    ],
                    [
                        'lang_code' => 'ar',
                        'title' => 'ضمان العدالة مع دعمنا القانوني الموثوق',
                    ],
                ],
            ],
        ];

        foreach ($dummyWorkSections as $item) {
            // Insert work section
            $workSection = WorkSection::create([
                'image' => $item['image'],
                'video' => $item['video'],
            ]);

            // Insert work section translations
            foreach ($item['translations'] as $translation) {
                WorkSectionTranslation::create([
                    'work_section_id' => $workSection->id,
                    'lang_code' => $translation['lang_code'],
                    'title' => $translation['title'],
                ]);
            }
        }

        // Seed work section FAQs
        $dummyWorkSectionFaqs = [
    [
        'status' => 1,
        'faqs' => [
            [
                'lang_code' => 'en',
                'question' => 'What legal services do you provide?',
                'answer' => 'We provide comprehensive legal services in Syria including civil, commercial, family, criminal, real estate, labor, and administrative law.',
            ],
            [
                'lang_code' => 'ar',
                'question' => 'ما هي الخدمات القانونية التي تقدمونها؟',
                'answer' => 'نقدم خدمات قانونية شاملة في سوريا تشمل القانون المدني والتجاري والأسري والجنائي والعقاري وقانون العمل والقانون الإداري.',
            ],
        ],
    ],
    [
        'status' => 1,
        'faqs' => [
            [
                'lang_code' => 'en',
                'question' => 'When are lawyers available for consultation?',
                'answer' => 'Our lawyers are available Saturday to Thursday, from 9:00 AM to 5:00 PM. Emergency consultations can be arranged upon request.',
            ],
            [
                'lang_code' => 'ar',
                'question' => 'متى يتوفر المحامون للاستشارة؟',
                'answer' => 'يتوفر محامونا من السبت إلى الخميس، من الساعة 9:00 صباحًا حتى 5:00 مساءً. يمكن ترتيب استشارات طارئة عند الطلب.',
            ],
        ],
    ],
    [
        'status' => 1,
        'faqs' => [
            [
                'lang_code' => 'en',
                'question' => 'How do I register for legal services?',
                'answer' => 'You can register by filling out the online form on our website, calling our office, or visiting us in person at our Damascus location.',
            ],
            [
                'lang_code' => 'ar',
                'question' => 'كيف يمكنني التسجيل للحصول على الخدمات القانونية؟',
                'answer' => 'يمكنك التسجيل من خلال تعبئة النموذج الإلكتروني على موقعنا، أو الاتصال بمكتبنا، أو زيارتنا شخصياً في موقعنا في دمشق.',
            ],
        ],
    ],
];


        foreach ($dummyWorkSectionFaqs as $item) {
            $workSectionFaqs = WorkSectionFaq::create([
                'work_section_id' => WorkSection::first()->id,
                'status' => $item['status'],
            ]);

            // Insert work section FAQ translations
            foreach ($item['faqs'] as $faq) {
                WorkSectionFaqTranslation::create([
                    'work_section_faq_id' => $workSectionFaqs->id,
                    'lang_code' => $faq['lang_code'],
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                ]);
            }
        }
    }
}
