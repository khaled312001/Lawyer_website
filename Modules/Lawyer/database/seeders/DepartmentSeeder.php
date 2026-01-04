<?php

namespace Modules\Lawyer\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Lawyer\app\Models\Department;
use Modules\Lawyer\app\Models\DepartmentFaq;
use Modules\Lawyer\app\Models\DepartmentFaqTranslation;
use Modules\Lawyer\app\Models\DepartmentImage;
use Modules\Lawyer\app\Models\DepartmentTranslation;
use Modules\Lawyer\app\Models\DepartmentVideo;

class DepartmentSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $departments = [
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'title'       => 'Civil and Commercial Law',
                        'description' => "<p>We provide comprehensive legal services in civil and commercial matters including contracts, property rights, and business transactions under Syrian law.</p>",
                    ],
                    [
                        'lang_code'   => 'ar',
                        'title'       => 'القانون المدني والتجاري',
                        'description' => "<p>نقدم خدمات قانونية شاملة في القضايا المدنية والتجارية بما في ذلك العقود وحقوق الملكية والمعاملات التجارية وفقاً للقانون السوري.</p>",
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'title'       => 'Family and Personal Status Law',
                        'description' => "<p>Specialized legal representation in family law matters including marriage, divorce, custody, inheritance, and personal status issues according to Syrian legislation.</p>",
                    ],
                    [
                        'lang_code'   => 'ar',
                        'title'       => 'قانون الأحوال الشخصية والأسرة',
                        'description' => "<p>تمثيل قانوني متخصص في قضايا الأحوال الشخصية بما في ذلك الزواج والطلاق والحضانة والميراث وفقاً للتشريعات السورية.</p>",
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'title'       => 'Criminal Law',
                        'description' => "<p>Expert defense in criminal cases with comprehensive understanding of Syrian criminal code and procedures, protecting your rights throughout the legal process.</p>",
                    ],
                    [
                        'lang_code'   => 'ar',
                        'title'       => 'القانون الجنائي',
                        'description' => "<p>دفاع متخصص في القضايا الجنائية مع فهم شامل لقانون العقوبات السوري والإجراءات الجزائية، لحماية حقوقك في جميع مراحل العملية القانونية.</p>",
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'title'       => 'Real Estate and Property Law',
                        'description' => "<p>Comprehensive legal services for real estate transactions, property disputes, and land registration matters in accordance with Syrian property laws.</p>",
                    ],
                    [
                        'lang_code'   => 'ar',
                        'title'       => 'قانون العقارات والملكية',
                        'description' => "<p>خدمات قانونية شاملة للمعاملات العقارية ونزاعات الملكية وقضايا تسجيل الأراضي وفقاً لقوانين الملكية السورية.</p>",
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'title'       => 'Labor and Employment Law',
                        'description' => "<p>Legal consultation and representation in labor disputes, employment contracts, and workplace rights under Syrian labor law.</p>",
                    ],
                    [
                        'lang_code'   => 'ar',
                        'title'       => 'قانون العمل والتوظيف',
                        'description' => "<p>استشارات قانونية وتمثيل في نزاعات العمل وعقود التوظيف وحقوق العمال وفقاً لقانون العمل السوري.</p>",
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code'   => 'en',
                        'title'       => 'Administrative Law',
                        'description' => "<p>Expert legal services in administrative law matters including government contracts, licensing, and administrative disputes before Syrian courts.</p>",
                    ],
                    [
                        'lang_code'   => 'ar',
                        'title'       => 'القانون الإداري',
                        'description' => "<p>خدمات قانونية متخصصة في القانون الإداري بما في ذلك العقود الحكومية والتراخيص والنزاعات الإدارية أمام المحاكم السورية.</p>",
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
        $description = [
            'en'=> "<p>Per ne quot sale, in mei brute novum putant. Delectus reprimique cu cum, pri et decore vocent dolorem, usu in legere tibique denique. In impedit feugait accusata mei, ne ius feugait vituperata neglegentur, an vel nostrum appareat percipit. Nullam legendos quaestio ius ad, vis et quodsi prompta adipiscing. Eos et brute incorrupte, audire placerat mel ex.</p><p>Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola, est ut clita dolorem, ei est mazim fuisset scribentur. Mel ut decore salutandi intellegam. Labitur epicurei vis cu, in mei rationibus consequuntur. Duo eu modus periculis, inermis detracto expetendis ius eu. Mel ludus viderer noluisse cu, te virtute constituam vix, et eos justo mucius salutatus. Nam illum dicant laudem no.</p><p>Laudem cetero principes at eam. Ne sit latine appetere erroribus, choro altera oporteat ut vel, eum omnium utroque nominavi et. Malis necessitatibus mea ex, putant disputando at vix. Vix tota semper verear id, cum dicunt perpetua concludaturque cu. At prima fastidii eum, vix paulo primis ut. Qui adhuc docendi deseruisse ea, veri mandamus vituperata et sit.</p><p>Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola, est ut clita dolorem, ei est mazim fuisset scribentur. Mel ut decore salutandi intellegam. Labitur epicurei vis cu, in mei rationibus consequuntur. Duo eu modus periculis, inermis detracto expetendis ius eu. Mel ludus viderer noluisse cu, te virtute constituam vix, et eos justo mucius salutatus. Nam illum dicant laudem no.</p><p>Per ne quot sale, in mei brute novum putant. Delectus reprimique cu cum, pri et decore vocent dolorem, usu in legere tibique denique. In impedit feugait accusata mei, ne ius feugait vituperata neglegentur, an vel nostrum appareat percipit. Nullam legendos quaestio ius ad, vis et quodsi prompta adipiscing. Eos et brute incorrupte, audire placerat mel ex.</p>",

            'ar'=> "<p>أنا متورط في قضايا معقدة، حيث أواجه أفكارًا جديدة وجريئة. أتعامل مع التحديات بصبر، وأفكر بعمق في الحلول، وأسعى دومًا لاكتساب المعرفة وتوسيع مداركي. أواجه العقبات الفكرية بشجاعة، وأسعى دائمًا لفهم أعمق وأكثر وضوحًا.</p> <p>لوريم إيبسوم دولور سيت أميت، أبحث عن طرق جديدة لفهم الأمور المعقدة. أعمل على تطوير مهاراتي من خلال التفكير النقدي والتحليل العميق. أؤمن أن الفهم الحقيقي لا يأتي إلا من خلال التجربة والتأمل. أنا ملتزم بتحقيق التميز في كل ما أقوم به.</p> <p>أؤمن بأهمية المبادئ الواضحة، وأسعى دومًا لتحقيق التوازن في حياتي. أواجه التحديات الفكرية بروح منفتحة، وأتعامل مع وجهات النظر المختلفة باحترام. أؤمن أن المعرفة تنمو من خلال الحوار، وأن التعاون أساس النجاح.</p> <p>لوريم إيبسوم دولور سيت أميت، أبحث عن طرق جديدة لفهم الأمور المعقدة. أعمل على تطوير مهاراتي من خلال التفكير النقدي والتحليل العميق. أؤمن أن الفهم الحقيقي لا يأتي إلا من خلال التجربة والتأمل. أنا ملتزم بتحقيق التميز في كل ما أقوم به.</p> <p>أنا متورط في قضايا معقدة، حيث أواجه أفكارًا جديدة وجريئة. أتعامل مع التحديات بصبر، وأفكر بعمق في الحلول، وأسعى دومًا لاكتساب المعرفة وتوسيع مداركي. أواجه العقبات الفكرية بشجاعة، وأسعى دائمًا لفهم أعمق وأكثر وضوحًا.</p>"
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
        $faqs = [
            [
                'translations' => [
                    [
                        'lang_code' => 'en',
                        'question'  => 'Lorem ipsum dolor sit amet per mollis?',
                        'answer'    => 'Lorem ipsum dolor sit amet, per mollis aeterno nostrud in, nam timeam fastidii eu. Commodo nonumes vim eu. Quo indoctum voluptatibus delicatissimi no. Eu cum dico melius. Cum impetus scribentur ad.',
                    ],
                    [
                        'lang_code' => 'ar',
                        'question'  => 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟',
                        'answer'    => 'لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟لوريم إيبسوم دولور الجلوس أميت لكل موليس؟',
                    ],
                ],
            ],
            [
                'translations' => [
                    [
                        'lang_code' => 'en',
                        'question'  => 'Ut alterum dissentiunt eam nobis audire?',
                        'answer'    => 'Ut alterum dissentiunt eam, nobis audire verterem ut vel. Vidisse persius mea no. Melius imperdiet his at. Ex has zril convenire, cu eos eros dolor, omittam adversarium suscipiantur mea ea.',
                    ],
                    [
                        'lang_code' => 'ar',
                        'question'  => 'هل من الممكن أن أختلف مع أي شخص آخر؟',
                        'answer'    => 'هل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخرهل من الممكن أن أختلف مع أي شخص آخر',
                    ],
                ],

            ],
        ];

        foreach ($departments as $key => $item) {
            $index = ++$key;
            $department = Department::create([
                'slug'            => Str::slug($item['translations'][0]['title']),
                'thumbnail_image' => "uploads/website-images/dummy/department-thumbnail-{$index}.webp",
            ]);

            foreach ($item['translations'] as $value) {
                DepartmentTranslation::create([
                    'department_id'   => $department->id,
                    'lang_code'       => $value['lang_code'],
                    'name'            => $value['title'],
                    'description'     => $description[$value['lang_code']],
                    'seo_title'       => $value['title'],
                    'seo_description' => $value['title'],
                ]);
            }
            foreach ($videos as $video) {
                DepartmentVideo::create([
                    'department_id' => $department->id,
                    'link'          => $video['link'],
                    'code'          => $video['code'],
                ]);
            }
            foreach ($faqs as $faq) {
                $departmentFaq = DepartmentFaq::create(['department_id' => $department->id]);
                foreach ($faq['translations'] as $value) {
                    DepartmentFaqTranslation::create([
                        'department_faq_id' => $departmentFaq->id,
                        'lang_code'         => $value['lang_code'],
                        'question'          => $value['question'],
                        'answer'            => $value['answer'],
                    ]);
                }
            }
            foreach ($images as $image) {
                DepartmentImage::create([
                    'department_id' => $department->id,
                    'small_image'   => $image['small_image'],
                    'large_image'   => $image['large_image'],
                ]);
            }
        }
    }
}
