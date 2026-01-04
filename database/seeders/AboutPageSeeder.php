<?php

namespace Database\Seeders;

use App\Models\AboutUsPage;
use App\Models\AboutUsPageTranslation;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // Data for 'about_us_pages' table
        $aboutUsPageData = [
            'about_image'      => 'uploads/website-images/dummy/about_image.webp',
            'background_image' => 'uploads/website-images/dummy/background_image.webp',
            'mission_image'    => 'uploads/website-images/dummy/mission_image.webp',
            'vision_image'     => 'uploads/website-images/dummy/vision_image.webp',
        ];

        $aboutUsPage = AboutUsPage::create($aboutUsPageData);

        $translations = [
            [
                'lang_code'           => 'en',
                'about_description'   => "<h1>Experienced Syrian Lawyers Committed to Justice</h1><p>We are a leading Syrian law firm providing expert legal services with integrity, professionalism, and a client-first approach. Our team of skilled attorneys specializes in Syrian law and is dedicated to helping individuals and businesses navigate complex legal challenges in Syria effectively.</p><p>Whether you need assistance in civil litigation, commercial law, family matters, criminal defense, real estate, or administrative law, we offer personalized legal strategies tailored to your unique situation under Syrian legislation. With a reputation for excellence and a focus on results, we are your trusted partner in all legal matters throughout Syria.</p>",
                'mission_description' => "<h1><strong>Our Mission</strong></h1><p>To uphold justice and provide reliable legal solutions that protect the rights and interests of our clients under Syrian law.</p><p>We are committed to serving our Syrian clients with integrity, transparency, and diligence. Our mission is to simplify the legal process within the Syrian legal system, ensuring that every client receives clear advice and strong representation. We aim to build long-term relationships based on trust and positive outcomes across Damascus, Aleppo, Homs, Latakia, and all Syrian cities.</p>",
                'vision_description'  => "<h1>Our Vision</h1><p>To be the leading Syrian law firm recognized for legal excellence, client satisfaction, and expertise in Syrian legislation.</p><p>We aspire to set the standard for innovative and effective legal representation in Syria. By combining deep expertise in Syrian law with a profound understanding of our clients' needs, we strive to make legal services accessible and empowering. Our vision is to be the first choice for individuals and organizations throughout Syria seeking dependable legal guidance.</p>",
            ],
            [
                'lang_code'           => 'ar',
                'about_description'   => "<h1>محامون سوريون ذو خبرة ملتزمون بتحقيق العدالة</h1><p>نحن مكتب محاماة سوري رائد نقدم خدمات قانونية احترافية تعتمد على النزاهة والمهنية ونهج يركز على العميل. يتخصص فريقنا من المحامين المهرة في القانون السوري ويكرس جهوده لمساعدة الأفراد والشركات على تجاوز التحديات القانونية المعقدة في سوريا بفعالية.</p><p>سواء كنت بحاجة إلى المساعدة في القضايا المدنية، أو القانون التجاري، أو قضايا الأحوال الشخصية، أو الدفاع الجنائي، أو قانون العقارات، أو القانون الإداري، فإننا نقدم استراتيجيات قانونية مخصصة تناسب وضعك الفريد وفقاً للتشريعات السورية. بفضل سمعتنا في التميز وتركيزنا على النتائج، نحن شريكك الموثوق في جميع الأمور القانونية في كافة أنحاء سوريا.</p>",
                'mission_description' => "<h1><strong>مهمتنا</strong></h1><p>الدفاع عن العدالة وتقديم حلول قانونية موثوقة تحمي حقوق ومصالح عملائنا وفقاً للقانون السوري.</p><p>نحن ملتزمون بخدمة عملائنا السوريين بنزاهة وشفافية واجتهاد. مهمتنا هي تبسيط الإجراءات القانونية ضمن النظام القانوني السوري، لضمان حصول كل عميل على نصائح واضحة وتمثيل قوي. نسعى لبناء علاقات طويلة الأمد تقوم على الثقة والنتائج الإيجابية في دمشق وحلب وحمص واللاذقية وجميع المدن السورية.</p>",
                'vision_description'  => "<h1>رؤيتنا</h1><p>أن نكون مكتب المحاماة السوري الرائد المعترف به بالتميز القانوني ورضا العملاء والخبرة في التشريعات السورية.</p><p>نطمح إلى وضع معايير جديدة في التمثيل القانوني المبتكر والفعال في سوريا. من خلال الجمع بين الخبرة العميقة في القانون السوري والفهم العميق لاحتياجات عملائنا، نسعى لجعل الخدمات القانونية سهلة الوصول وذات تأثير إيجابي. رؤيتنا أن نكون الخيار الأول للأفراد والمؤسسات في كافة أنحاء سوريا الباحثين عن إرشاد قانوني موثوق.</p>",
            ],
        ];

        foreach ($translations as $translation) {
            AboutUsPageTranslation::create([
                'about_us_page_id'    => $aboutUsPage->id,
                'lang_code'           => $translation['lang_code'],
                'about_description'   => $translation['about_description'],
                'mission_description' => $translation['mission_description'],
                'vision_description'  => $translation['vision_description'],
            ]);
        }
    }
}
