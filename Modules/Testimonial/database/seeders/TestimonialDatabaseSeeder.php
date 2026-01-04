<?php

namespace Modules\Testimonial\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Testimonial\app\Models\Testimonial;
use Modules\Testimonial\app\Models\TestimonialTranslation;

class TestimonialDatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run() {
        $testimonials = [
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'name'        => 'Khaled Al-Masri',
                        'designation' => 'Business Owner, Damascus',
                        'comment'     => 'The legal team provided exceptional support in handling my commercial contract dispute. Their deep knowledge of Syrian commercial law and professional approach made the entire process smooth and successful. I highly recommend their services.',
                    ],
                    [
                        'lang_code'   => 'ar',
                        'name'        => 'خالد المصري',
                        'designation' => 'صاحب شركة، دمشق',
                        'comment'     => 'قدم الفريق القانوني دعماً استثنائياً في معالجة نزاع العقد التجاري الخاص بي. معرفتهم العميقة بالقانون التجاري السوري ونهجهم المهني جعل العملية بأكملها سلسة وناجحة. أوصي بشدة بخدماتهم.',
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'name'        => 'Layla Ahmad',
                        'designation' => 'Teacher, Aleppo',
                        'comment'     => 'The lawyers helped me with my family law case with great sensitivity and professionalism. They explained every step clearly and supported me throughout the process. I am very grateful for their expertise in Syrian family law.',
                    ],
                    [
                        'lang_code'   => 'ar',
                        'name'        => 'ليلى أحمد',
                        'designation' => 'معلمة، حلب',
                        'comment'     => 'ساعدني المحامون في قضية الأحوال الشخصية بحساسية كبيرة واحترافية عالية. شرحوا كل خطوة بوضوح ودعموني طوال العملية. أنا ممتنة جداً لخبرتهم في قانون الأحوال الشخصية السوري.',
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'name'        => 'Omar Haddad',
                        'designation' => 'Engineer, Homs',
                        'comment'     => 'Excellent legal representation in my real estate dispute. The lawyers demonstrated comprehensive understanding of Syrian property laws and achieved a favorable outcome for my case. Truly professional service.',
                    ],
                    [
                        'lang_code'   => 'ar',
                        'name'        => 'عمر حداد',
                        'designation' => 'مهندس، حمص',
                        'comment'     => 'تمثيل قانوني ممتاز في نزاع الملكية العقارية. أظهر المحامون فهماً شاملاً لقوانين الملكية السورية وحققوا نتيجة مواتية لقضيتي. خدمة احترافية حقاً.',
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'name'        => 'Rania Kassem',
                        'designation' => 'Pharmacist, Latakia',
                        'comment'     => 'From the first consultation to the final resolution, the legal team was transparent, communicative, and dedicated. Their expertise in Syrian law made a difficult situation much easier to handle. I highly recommend them.',
                    ],
                    [
                        'lang_code'   => 'ar',
                        'name'        => 'رانيا قاسم',
                        'designation' => 'صيدلانية، اللاذقية',
                        'comment'     => 'من الاستشارة الأولى إلى الحل النهائي، كان الفريق القانوني شفافاً ومتواصلاً ومتفانياً. خبرتهم في القانون السوري جعلت الوضع الصعب أسهل بكثير للتعامل معه. أوصي بهم بشدة.',
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'name'        => 'Youssef Darwish',
                        'designation' => 'Restaurant Owner, Damascus',
                        'comment'     => 'I needed help with labor law issues for my business. The firm handled everything with precision and deep knowledge of Syrian labor regulations. Their team was responsive and professional throughout. Would definitely work with them again.',
                    ],
                    [
                        'lang_code'   => 'ar',
                        'name'        => 'يوسف درويش',
                        'designation' => 'صاحب مطعم، دمشق',
                        'comment'     => 'احتجت إلى مساعدة في قضايا قانون العمل لنشاطي التجاري. تعامل المكتب مع كل شيء بدقة ومعرفة عميقة بأنظمة العمل السورية. كان فريقهم سريع الاستجابة ومحترفاً طوال الوقت. بالتأكيد سأعمل معهم مرة أخرى.',
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'name'        => 'Nour Sharif',
                        'designation' => 'Architect, Tartus',
                        'comment'     => 'Outstanding service in handling my civil case. The lawyers demonstrated exceptional professionalism and dedication. Their expertise in Syrian civil law gave me confidence throughout the process. A firm I can truly trust.',
                    ],
                    [
                        'lang_code'   => 'ar',
                        'name'        => 'نور شريف',
                        'designation' => 'معماري، طرطوس',
                        'comment'     => 'خدمة متميزة في معالجة قضيتي المدنية. أظهر المحامون احترافية وتفاني استثنائيين. خبرتهم في القانون المدني السوري منحتني الثقة طوال العملية. مكتب يمكن الوثوق به حقاً.',
                    ],
                ],
            ],
        ];

        $counter = 1;
        foreach ($testimonials as $testimonialData) {
            // Create the testimonial
            $testimonial = Testimonial::create([
                'image'  => "uploads/website-images/dummy/testimonial-{$counter}.webp",
                'rating' => 5,
            ]);

            // Create translations
            foreach ($testimonialData['translations'] as $translation) {
                TestimonialTranslation::create([
                    'testimonial_id' => $testimonial->id,
                    'lang_code'      => $translation['lang_code'],
                    'name'           => $translation['name'],
                    'designation'    => $translation['designation'],
                    'comment'        => $translation['comment'],
                ]);
            }

            $counter++;
        }
    }
}
