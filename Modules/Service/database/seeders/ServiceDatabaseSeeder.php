<?php

namespace Modules\Service\database\seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Service\app\Models\Service;
use Modules\Service\app\Models\ServiceFaq;
use Modules\Service\app\Models\ServiceImage;
use Modules\Service\app\Models\ServiceVideo;
use Modules\Service\app\Models\ServiceTranslation;
use Modules\Service\app\Models\ServiceFaqTranslation;

class ServiceDatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {

        $services = [
            [
                'icon'         => 'fas fa-building',
                'slug_prefix'  => '0-real-estate-legal-services',
                'translations' => [
                    [
                        'lang_code'        => 'en',
                        'title'            => 'Real Estate Legal Services',
                        'sort_description' => 'Professional legal services for real estate purchase and investment cases through specialized and experienced lawyers, completing the task in the fastest time',
                        'description'      => '<p>We provide comprehensive legal services for real estate transactions including property purchase, real estate investment, legal documentation, and dispute resolution. Our specialized lawyers ensure all legal procedures are completed efficiently and your rights are protected throughout the process.</p>',
                    ],
                    [
                        'lang_code'        => 'ar',
                        'title'            => 'خدمات العقارات القانونية',
                        'sort_description' => 'خدمات قانونية متخصصة لمعاملات شراء العقارات والاستثمار العقاري من خلال محامين متخصصين وذوي خبرة، إتمام المهمة في أسرع وقت',
                        'description'      => '<p>نقدم خدمات قانونية شاملة لمعاملات العقارات بما في ذلك شراء العقارات والاستثمار العقاري والوثائق القانونية وحل النزاعات. يضمن محامونا المتخصصون إتمام جميع الإجراءات القانونية بكفاءة وحماية حقوقك طوال العملية.</p>',
                    ],
                ],
            ],
            [
                'icon'         => 'fas fa-file-alt',
                'slug_prefix'  => '1-government-document-extraction',
                'translations' => [
                    [
                        'lang_code'        => 'en',
                        'title'            => 'Government Document Extraction',
                        'sort_description' => 'Professional assistance in extracting official government documents from state institutions',
                        'description'      => '<p>We provide expert services to help you obtain official government documents from various state institutions efficiently and legally.</p>',
                    ],
                    [
                        'lang_code'        => 'ar',
                        'title'            => 'استخراج وثائق حكوميه من الدوله',
                        'sort_description' => 'مساعدة مهنية في استخراج الوثائق الحكومية الرسمية من مؤسسات الدولة',
                        'description'      => '<p>نقدم خدمات متخصصة لمساعدتك في الحصول على الوثائق الحكومية الرسمية من مختلف مؤسسات الدولة بكفاءة ووفقاً للقانون.</p>',
                    ],
                ],
            ],
            [
                'icon'         => 'fab fa-fort-awesome',
                'translations' => [
                    [
                        'lang_code'        => 'en',
                        'title'            => 'Corporate Law',
                        'sort_description' => 'Legal support for corporate governance, & compliance',
                        'description'      => '<p>We provide expert legal services for corporations including governance structure, shareholder agreements, compliance, and mergers & acquisitions.</p>',
                    ],
                    [
                        'lang_code'        => 'ar',
                        'title'            => 'القانون التجاري',
                        'sort_description' => 'الدعم القانوني لحوكمة الشركات والاندماجات والامتثال',
                        'description'      => '<p>نقدم خدمات قانونية متخصصة للشركات، تشمل هيكلة الحوكمة، واتفاقيات المساهمين، والامتثال، والاندماجات والاستحواذات.</p>',
                    ],
                ],
            ],
            [
                'icon'         => 'fas fa-balance-scale',
                'translations' => [
                    [
                        'lang_code'        => 'en',
                        'title'            => 'Family Law',
                        'sort_description' => 'Legal services for marriage, divorce, child custody, and more',
                        'description'      => '<p>Our family law experts assist in resolving family disputes including marriage, divorce, custody, and inheritance issues.</p>',
                    ],
                    [
                        'lang_code'        => 'ar',
                        'title'            => 'قانون الأسرة',
                        'sort_description' => 'خدمات قانونية للزواج، والطلاق، وحضانة الأطفال، وغيرها',
                        'description'      => '<p>يقدم خبراؤنا في قانون الأسرة المساعدة في حل النزاعات الأسرية مثل الزواج والطلاق والحضانة وقضايا الميراث.</p>',
                    ],
                ],
            ],
            [
                'icon'         => 'fas fa-anchor',
                'translations' => [
                    [
                        'lang_code'        => 'en',
                        'title'            => 'Criminal Law',
                        'sort_description' => 'Defense against criminal charges and legal representation in court',
                        'description'      => '<p>We provide strong defense representation in criminal matters to protect your rights at every stage of the legal process.</p>',
                    ],
                    [
                        'lang_code'        => 'ar',
                        'title'            => 'القانون الجنائي',
                        'sort_description' => 'الدفاع ضد التهم الجنائية والتمثيل القانوني في المحكمة',
                        'description'      => '<p>نقدم تمثيلًا قانونيًا قويًا في القضايا الجنائية لحماية حقوقك في جميع مراحل الإجراءات القانونية.</p>',
                    ],
                ],
            ],
            [
                'icon'         => 'far fa-snowflake',
                'translations' => [
                    [
                        'lang_code'        => 'en',
                        'title'            => 'Insurance Law',
                        'sort_description' => 'Assistance with insurance claims, disputes, and legal coverage',
                        'description'      => '<p>Our attorneys support clients in navigating insurance issues, including claim denials and policy disputes.</p>',
                    ],
                    [
                        'lang_code'        => 'ar',
                        'title'            => 'قانون التأمين',
                        'sort_description' => 'المساعدة في مطالبات التأمين والنزاعات والتغطية القانونية',
                        'description'      => '<p>يدعم محامونا العملاء في التعامل مع قضايا التأمين، بما في ذلك رفض المطالبات والنزاعات المتعلقة بالسياسات.</p>',
                    ],
                ],
            ],
            [
                'icon'         => 'fab fa-envira',
                'translations' => [
                    [
                        'lang_code'        => 'en',
                        'title'            => 'Environmental Law',
                        'sort_description' => 'Legal solutions for environmental regulations and compliance',
                        'description'      => '<p>We advise on environmental laws, compliance, and litigation for businesses and individuals impacting the environment.</p>',
                    ],
                    [
                        'lang_code'        => 'ar',
                        'title'            => 'القانون البيئي',
                        'sort_description' => 'حلول قانونية للتشريعات البيئية والامتثال',
                        'description'      => '<p>نقدم المشورة بشأن القوانين البيئية والامتثال والتقاضي للشركات والأفراد الذين يتأثرون أو يؤثرون على البيئة.</p>',
                    ],
                ],
            ],
            [
                'icon'         => 'fas fa-shield-alt',
                'translations' => [
                    [
                        'lang_code'        => 'en',
                        'title'            => 'Compliance',
                        'sort_description' => 'Legal compliance services to ensure your business meets all regulatory requirements and standards',
                        'description'      => '<p>We provide comprehensive compliance services to help businesses and individuals meet all legal and regulatory requirements. Our experts ensure you stay compliant with local and international regulations, avoiding penalties and legal issues.</p>',
                    ],
                    [
                        'lang_code'        => 'ar',
                        'title'            => 'الامتثال',
                        'sort_description' => 'خدمات الامتثال القانوني لضمان استيفاء عملك لجميع المتطلبات والمعايير التنظيمية',
                        'description'      => '<p>نقدم خدمات الامتثال الشاملة لمساعدة الشركات والأفراد على الوفاء بجميع المتطلبات القانونية والتنظيمية. يضمن خبراؤنا بقاءك متوافقاً مع اللوائح المحلية والدولية، وتجنب الغرامات والمشاكل القانونية.</p>',
                    ],
                ],
            ],
        ];

        $videos = [
            [
                'link' => 'https://www.youtube.com/watch?v=6_aWI8JgRCs',
                'code' => '6_aWI8JgRCs',
            ],
            [
                'link' => 'https://www.youtube.com/watch?v=SzXbRCVy4r0',
                'code' => 'SzXbRCVy4r0',
            ]
        ];
        $faqs = [
            [
                'translations' => [
                    [
                        'lang_code' => 'en',
                        'question'  => 'What types of government documents can you help extract?',
                        'answer'    => '<p>We assist in extracting various types of official government documents including birth certificates, identity cards, passports, marriage certificates, divorce certificates, death certificates, property deeds, commercial licenses, tax documents, and other official documents from state institutions.</p>',
                    ],
                    [
                        'lang_code' => 'ar',
                        'question'  => 'ما هي أنواع الوثائق الحكومية التي يمكنكم مساعدتي في استخراجها؟',
                        'answer'    => '<p>نساعد في استخراج أنواع مختلفة من الوثائق الحكومية الرسمية بما في ذلك شهادات الميلاد، وبطاقات الهوية، وجوازات السفر، وشهادات الزواج، وشهادات الطلاق، وشهادات الوفاة، وسندات الملكية، والتراخيص التجارية، والوثائق الضريبية، وغيرها من الوثائق الرسمية من مؤسسات الدولة.</p>',
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code' => 'en',
                        'question'  => 'How long does it take to extract government documents?',
                        'answer'    => '<p>The time required to extract government documents varies depending on the type of document and the issuing authority. Generally, simple documents may take 3-7 working days, while more complex documents may require 2-4 weeks. We will provide you with an estimated timeline after reviewing your specific case.</p>',
                    ],
                    [
                        'lang_code' => 'ar',
                        'question'  => 'كم يستغرق استخراج الوثائق الحكومية من الوقت؟',
                        'answer'    => '<p>يختلف الوقت المطلوب لاستخراج الوثائق الحكومية حسب نوع الوثيقة والجهة المصدرة. بشكل عام، قد تستغرق الوثائق البسيطة من 3-7 أيام عمل، بينما قد تتطلب الوثائق الأكثر تعقيداً من أسبوعين إلى 4 أسابيع. سنزودك بجدول زمني تقديري بعد مراجعة حالتك الخاصة.</p>',
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code' => 'en',
                        'question'  => 'What documents do I need to provide to start the extraction process?',
                        'answer'    => '<p>To begin the document extraction process, you will typically need to provide: a copy of your identity card or passport, proof of residence, any existing related documents, and a completed application form. Our team will guide you through the specific requirements based on the type of document you need.</p>',
                    ],
                    [
                        'lang_code' => 'ar',
                        'question'  => 'ما هي الوثائق التي أحتاج لتقديمها لبدء عملية الاستخراج؟',
                        'answer'    => '<p>لبدء عملية استخراج الوثائق، ستحتاج عادةً إلى تقديم: نسخة من بطاقة الهوية أو جواز السفر، وإثبات السكن، وأي وثائق ذات صلة موجودة، ونموذج طلب مكتمل. سيرشدك فريقنا حول المتطلبات المحددة بناءً على نوع الوثيقة التي تحتاجها.</p>',
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code' => 'en',
                        'question'  => 'Do you handle document extraction for individuals living outside the country?',
                        'answer'    => '<p>Yes, we provide services for Syrian citizens living abroad. We can assist with power of attorney arrangements and coordinate with local authorities to extract documents on your behalf. Please contact us to discuss your specific situation and the available options.</p>',
                    ],
                    [
                        'lang_code' => 'ar',
                        'question'  => 'هل تتعاملون مع استخراج الوثائق للأشخاص المقيمين خارج البلاد؟',
                        'answer'    => '<p>نعم، نقدم خدمات للمواطنين السوريين المقيمين في الخارج. يمكننا المساعدة في ترتيبات التوكيل والتنسيق مع السلطات المحلية لاستخراج الوثائق نيابة عنك. يرجى الاتصال بنا لمناقشة وضعك الخاص والخيارات المتاحة.</p>',
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code' => 'en',
                        'question'  => 'What are the fees for document extraction services?',
                        'answer'    => '<p>Our fees vary depending on the type of document, complexity of the case, and the required procedures. We provide transparent pricing with no hidden costs. Contact us for a detailed quote based on your specific needs. We offer competitive rates and flexible payment options.</p>',
                    ],
                    [
                        'lang_code' => 'ar',
                        'question'  => 'ما هي رسوم خدمات استخراج الوثائق؟',
                        'answer'    => '<p>تختلف رسومنا حسب نوع الوثيقة وتعقيد الحالة والإجراءات المطلوبة. نقدم تسعيراً شفافاً بدون تكاليف خفية. اتصل بنا للحصول على عرض أسعار مفصل بناءً على احتياجاتك الخاصة. نقدم أسعاراً تنافسية وخيارات دفع مرنة.</p>',
                    ],
                ],
            ],
        ];

        
        $images = [
            [
                'small_image' => 'uploads/website-images/dummy/department-small-1.webp',
                'large_image' => 'uploads/website-images/dummy/department-large-1.webp',
            ],
            [
                'small_image' => 'uploads/website-images/dummy/department-small-2.webp',
                'large_image' => 'uploads/website-images/dummy/department-large-2.webp',
            ],
            [
                'small_image' => 'uploads/website-images/dummy/department-small-3.webp',
                'large_image' => 'uploads/website-images/dummy/department-large-3.webp',
            ],
            [
                'small_image' => 'uploads/website-images/dummy/department-small-4.webp',
                'large_image' => 'uploads/website-images/dummy/department-large-4.webp',
            ],
        ];

        foreach ($services as $item) {
            $slug = isset($item['slug_prefix']) ? $item['slug_prefix'] : Str::slug($item['translations'][0]['title']);
            $service = Service::firstOrCreate(
                ['slug' => $slug],
                [
                    'icon' => $item['icon'],
                    'show_homepage' => 1,
                    'status' => 1,
                ]
            );
            
            // Update existing services to ensure they are active and shown on homepage
            $service->update([
                'show_homepage' => 1,
                'status' => 1,
            ]);

            foreach ($item['translations'] as $translation) {
                ServiceTranslation::firstOrCreate(
                    [
                        'service_id' => $service->id,
                        'lang_code'  => $translation['lang_code'],
                    ],
                    [
                        'title'            => $translation['title'],
                        'description'      => $translation['description'],
                        'sort_description' => $translation['sort_description'],
                        'seo_title'        => $translation['title'],
                        'seo_description'  => $translation['sort_description'],
                    ]
                );
            }
            foreach ($videos as $video) {
                ServiceVideo::firstOrCreate(
                    [
                        'service_id' => $service->id,
                        'code'       => $video['code'],
                    ],
                    [
                        'link' => $video['link'],
                    ]
                );
            }

            foreach ($images as $image) {
                ServiceImage::firstOrCreate(
                    [
                        'service_id'  => $service->id,
                        'small_image' => $image['small_image'],
                    ],
                    [
                        'large_image' => $image['large_image'],
                    ]
                );
            }
            
            // Add FAQs only for the document extraction service
            if ($slug === '1-government-document-extraction') {
                // Delete existing FAQs for this service to avoid duplicates
                $service->service_faq()->delete();
                
                foreach ($faqs as $faq) {
                    $serviceFaq = ServiceFaq::create([
                        'service_id' => $service->id,
                        'status'      => 1, // Active
                    ]);
                    foreach ($faq['translations'] as $value) {
                        ServiceFaqTranslation::create([
                            'service_faq_id' => $serviceFaq->id,
                            'lang_code'      => $value['lang_code'],
                            'question'       => $value['question'],
                            'answer'         => $value['answer'],
                        ]);
                    }
                }
            }
        }
    }
}
