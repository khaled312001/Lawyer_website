<?php

namespace Modules\ContactMessage\database\seeders;

use Illuminate\Database\Seeder;
use Modules\ContactMessage\app\Models\ContactInfo;
use Modules\ContactMessage\app\Models\ContactInfoTranslation;

class ContactInfoSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $requestOne = (object) [
            'top_bar_email'  => 'info@syrianlaw.com',
            'top_bar_phone'  => '+963-11-123-4567',
            'email'          => 'contact@syrianlaw.com',
            'phone'          => '+963-11-234-5678',
            'address'        => 'شارع المحاكم، دمشق، سوريا',
            'map_embed_code' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52784.90498072531!2d36.26685!3d33.51020!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518e6dc413cc6a7%3A0x6b9f66ebd1e394f2!2sDamascus%2C%20Syria!5e0!3m2!1sen!2s!4v1626145586281!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
        ];

        $translations = [
            [
                'lang_code'   => 'en',
                'header'      => 'Contact Us',
                'description' => 'Please fill in the following form to contact us quickly.',
                'about'       => 'We provide expert legal services in Syria with professional legal representation and consultation. Our experienced legal team specializes in all areas of Syrian law and ensures personalized, dedicated representation for your legal matters. Book your consultation today for trusted legal support.',
                'copyright'   => "Copyright 2025, Syrian Law Firm. All Rights Reserved.",
            ],
            [
                'lang_code'   => 'ar',
                'header'      => 'اتصل بنا',
                'description' => 'يرجى ملء النموذج التالي للتواصل معنا بسرعة.',
                'about'       => 'نقدم خدمات قانونية متخصصة في سوريا مع تمثيل واستشارات قانونية احترافية. فريقنا القانوني المتمرس متخصص في جميع مجالات القانون السوري ويضمن لك التمثيل القانوني المخصص والمتفاني لجميع قضاياك القانونية. احجز استشارتك اليوم للحصول على دعم قانوني موثوق.',
                'copyright'   => 'حقوق النشر 2025، مكتب المحاماة السوري. جميع الحقوق محفوظة.',
            ],
        ];

        $contactPage = new ContactInfo();
        $contactPage->fill((array) $requestOne);
        $contactPage->save();

        foreach ($translations as $translation) {
            $translationModel = new ContactInfoTranslation();
            $translationModel->lang_code = $translation['lang_code'];
            $translationModel->contact_info_id = $contactPage->id;
            $translationModel->header = $translation['header'];
            $translationModel->description = $translation['description'];
            $translationModel->about = $translation['about'];
            $translationModel->copyright = $translation['copyright'];
            $translationModel->save();
        }
    }
}
