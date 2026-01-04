<?php

namespace Modules\App\database\seeders;

use Illuminate\Database\Seeder;
use Modules\App\app\Models\OnBoardingScreen;

class AppDatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $data = [
            [
                'title'     => 'مرحباً بك في مكتب المحاماة السوري',
                'sub_title' => 'شريكك الموثوق للحصول على الخدمات القانونية في سوريا',
                'image'     => 'uploads/website-images/app/screen_1.png',
                'order'     => 1,
            ],
            [
                'title'     => 'حجز الاستشارات القانونية بسهولة',
                'sub_title' => 'ابحث عن المحامين واحجز استشارتك القانونية بضغطة زر',
                'image'     => 'uploads/website-images/app/screen_2.png',
                'order'     => 2,
            ],
            [
                'title'     => 'خدمات قانونية شاملة',
                'sub_title' => 'نوفر لك تمثيلاً قانونياً احترافياً في جميع المجالات',
                'image'     => 'uploads/website-images/app/screen_3.png',
                'order'     => 3,
            ],

        ];
        foreach ($data as $item) {
            OnBoardingScreen::create([
                'title'            => $item['title'],
                'sort_description' => $item['sub_title'],
                'image'            => $item['image'],
                'order'            => $item['order'],
            ]);
        }
    }
}
