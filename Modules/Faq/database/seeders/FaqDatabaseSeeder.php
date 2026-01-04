<?php

namespace Modules\Faq\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Faq\app\Models\Faq;
use Modules\Faq\app\Models\FaqCategory;
use Modules\Faq\app\Models\FaqTranslation;
use Modules\Faq\app\Models\FaqCategoryTranslation;

class FaqDatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run() {
        $faqCategories = [
            [
                'slug'         => 'general-questions',
                'translations' => [
                    ['lang_code' => 'en', 'title' => 'General Legal Questions'],
                    ['lang_code' => 'ar', 'title' => 'أسئلة قانونية عامة'],
                ],
            ],
            [
                'slug'         => 'payment-related-questions',
                'translations' => [
                    ['lang_code' => 'en', 'title' => 'Fees and Payment Questions'],
                    ['lang_code' => 'ar', 'title' => 'أسئلة الأتعاب والدفع'],
                ],
            ],
            [
                'slug'         => 'appointment-related-questions',
                'translations' => [
                    ['lang_code' => 'en', 'title' => 'Consultation Appointment Questions'],
                    ['lang_code' => 'ar', 'title' => 'أسئلة المواعيد والاستشارات'],
                ],
            ],
        ];

        foreach ($faqCategories as $categoryData) {
            // Create the FAQ category
            $category = FaqCategory::create([
                'slug'   => $categoryData['slug'],
            ]);

            // Create translations
            foreach ($categoryData['translations'] as $translation) {
                FaqCategoryTranslation::create([
                    'faq_category_id' => $category->id,
                    'lang_code'       => $translation['lang_code'],
                    'title'           => $translation['title'],
                ]);
            }
        }

        $faqs = [
            [
                'faq_category_id' => 1,
                'translations'    => [
                    ['lang_code' => 'en', 'question' => 'What areas of law do you specialize in?', 'answer' => 'We specialize in civil law, commercial law, family law, criminal law, real estate law, labor law, and administrative law according to Syrian legislation.'],
                    ['lang_code' => 'ar', 'question' => 'ما هي مجالات القانون التي تتخصصون فيها؟', 'answer' => 'نتخصص في القانون المدني والتجاري وقانون الأسرة والقانون الجنائي وقانون العقارات وقانون العمل والقانون الإداري وفقاً للتشريعات السورية.'],
                ],
            ],
            [
                'faq_category_id' => 1,
                'translations'    => [
                    ['lang_code' => 'en', 'question' => 'How can I contact a lawyer at your firm?', 'answer' => 'You can contact us through our website, email, or phone. We are available from Saturday to Thursday from 9 AM to 5 PM.'],
                    ['lang_code' => 'ar', 'question' => 'كيف يمكنني التواصل مع محامي في مكتبكم؟', 'answer' => 'يمكنك التواصل معنا عبر موقعنا الإلكتروني أو البريد الإلكتروني أو الهاتف. نحن متاحون من السبت إلى الخميس من الساعة 9 صباحاً حتى 5 مساءً.'],
                ],
            ],
            [
                'faq_category_id' => 2,
                'translations'    => [
                    ['lang_code' => 'en', 'question' => 'How are legal fees calculated?', 'answer' => 'Legal fees vary depending on the complexity of the case and the type of legal service required. We provide a clear fee structure during the initial consultation.'],
                    ['lang_code' => 'ar', 'question' => 'كيف يتم احتساب أتعاب المحاماة؟', 'answer' => 'تختلف أتعاب المحاماة حسب تعقيد القضية ونوع الخدمة القانونية المطلوبة. نقدم هيكل أتعاب واضح خلال الاستشارة الأولية.'],
                ],
            ],
            [
                'faq_category_id' => 2,
                'translations'    => [
                    ['lang_code' => 'en', 'question' => 'What payment methods do you accept?', 'answer' => 'We accept cash payments, bank transfers, and checks. Payment terms will be discussed and agreed upon before starting work on your case.'],
                    ['lang_code' => 'ar', 'question' => 'ما هي طرق الدفع التي تقبلونها؟', 'answer' => 'نقبل الدفع النقدي والتحويلات البنكية والشيكات. سيتم مناقشة شروط الدفع والاتفاق عليها قبل البدء بالعمل على قضيتك.'],
                ],
            ],
            [
                'faq_category_id' => 3,
                'translations'    => [
                    ['lang_code' => 'en', 'question' => 'How do I schedule a legal consultation?', 'answer' => 'You can schedule a consultation by calling our office, sending an email, or filling out the contact form on our website. We will confirm your appointment within 24 hours.'],
                    ['lang_code' => 'ar', 'question' => 'كيف يمكنني تحديد موعد للاستشارة القانونية؟', 'answer' => 'يمكنك تحديد موعد للاستشارة عن طريق الاتصال بمكتبنا أو إرسال بريد إلكتروني أو تعبئة نموذج الاتصال على موقعنا. سنؤكد موعدك خلال 24 ساعة.'],
                ],
            ],
            [
                'faq_category_id' => 3,
                'translations'    => [
                    ['lang_code' => 'en', 'question' => 'Can I reschedule my consultation appointment?', 'answer' => 'Yes, you can reschedule your appointment by contacting our office at least 24 hours in advance. We will do our best to accommodate your schedule.'],
                    ['lang_code' => 'ar', 'question' => 'هل يمكنني إعادة جدولة موعد الاستشارة؟', 'answer' => 'نعم، يمكنك إعادة جدولة موعدك عن طريق الاتصال بمكتبنا قبل 24 ساعة على الأقل. سنبذل قصارى جهدنا لاستيعاب جدولك الزمني.'],
                ],
            ],
        ];

        foreach ($faqs as $faqData) {
            // Create the FAQ
            $faq = Faq::create([
                'faq_category_id' => $faqData['faq_category_id'],
            ]);

            // Create translations
            foreach ($faqData['translations'] as $translation) {
                FaqTranslation::create([
                    'faq_id'    => $faq->id,
                    'lang_code' => $translation['lang_code'],
                    'question'  => $translation['question'],
                    'answer'    => $translation['answer'],
                ]);
            }
        }
    }
}
