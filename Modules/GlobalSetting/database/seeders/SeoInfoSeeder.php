<?php

namespace Modules\GlobalSetting\database\seeders;

use Illuminate\Database\Seeder;
use Modules\GlobalSetting\app\Models\SeoSetting;

class SeoInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item1 = new SeoSetting();
        $item1->page_name = 'Home';
        $item1->seo_title = 'الرئيسية || مكتب المحاماة السوري';
        $item1->seo_description = 'مكتب محاماة متخصص في سوريا - خدمات قانونية احترافية';
        $item1->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'About';
        $item2->seo_title = 'من نحن || مكتب المحاماة السوري';
        $item2->seo_description = 'تعرف على مكتبنا وخدماتنا القانونية في سوريا';
        $item2->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'Contact';
        $item2->seo_title = 'اتصل بنا || مكتب المحاماة السوري';
        $item2->seo_description = 'تواصل معنا للحصول على استشارة قانونية';
        $item2->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'Blog';
        $item2->seo_title = 'المدونة || مكتب المحاماة السوري';
        $item2->seo_description = 'أحدث المقالات القانونية والأخبار';
        $item2->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'Lawyers';
        $item2->seo_title = 'المحامون || مكتب المحاماة السوري';
        $item2->seo_description = 'تعرف على فريق المحامين المتخصصين لدينا';
        $item2->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'Department';
        $item2->seo_title = 'الأقسام || مكتب المحاماة السوري';
        $item2->seo_description = 'تخصصاتنا القانونية المتنوعة';
        $item2->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'Service';
        $item2->seo_title = 'الخدمات || مكتب المحاماة السوري';
        $item2->seo_description = 'خدماتنا القانونية الشاملة';
        $item2->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'Testimonial';
        $item2->seo_title = 'آراء العملاء || مكتب المحاماة السوري';
        $item2->seo_description = 'ماذا يقول عملاؤنا عنا';
        $item2->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'FaQ';
        $item2->seo_title = 'الأسئلة الشائعة || مكتب المحاماة السوري';
        $item2->seo_description = 'أجوبة على الأسئلة الأكثر شيوعاً';
        $item2->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'Privacy Policy';
        $item2->seo_title = 'سياسة الخصوصية || مكتب المحاماة السوري';
        $item2->seo_description = 'سياسة الخصوصية وحماية البيانات';
        $item2->save();

        $item2 = new SeoSetting();
        $item2->page_name = 'Terms Condition';
        $item2->seo_title = 'الشروط والأحكام || مكتب المحاماة السوري';
        $item2->seo_description = 'الشروط والأحكام الخاصة بخدماتنا';
        $item2->save();
    }
}
