<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RealEstate;
use Illuminate\Support\Str;

class RealEstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'title' => 'شقة فاخرة في قلب المدينة',
                'description' => 'شقة فاخرة مؤلفة من 3 غرف نوم وصالة كبيرة، مطبخ مجهز بالكامل، 2 حمام، موقف سيارة. المبنى حديث مع جميع المرافق. قريب من المدارس والمستشفيات.',
                'property_type' => 'apartment',
                'listing_type' => 'sale',
                'city' => 'دمشق',
                'district' => 'المزرعة',
                'neighborhood' => 'شارع بغداد',
                'address' => 'شارع بغداد، المزرعة، دمشق',
                'latitude' => 33.5138,
                'longitude' => 36.2765,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 150,
                'floor' => 5,
                'total_floors' => 8,
                'year_built' => 2020,
                'price' => 150000,
                'currency' => 'USD',
                'features' => ['parking', 'elevator', 'security', 'generator'],
                'amenities' => ['furnished', 'balcony', 'air_conditioning'],
                'images' => [
                    'properties/apartment-1-main.jpg'
                ],
                'featured_image' => 'properties/apartment-1-main.jpg',
                'featured' => true,
                'contact_name' => 'أحمد محمد',
                'contact_phone' => '+963 11 1234567',
                'contact_email' => 'ahmed@example.com',
            ],
            [
                'title' => 'فيلا راقية مع حديقة خاصة',
                'description' => 'فيلا راقية مؤلفة من 4 غرف نوم، 3 حمامات، صالة كبيرة، مطبخ، غرفة خادمة، حديقة واسعة، موقف سيارات متعدد. موقع هادئ وآمن.',
                'property_type' => 'villa',
                'listing_type' => 'sale',
                'city' => 'دمشق',
                'district' => 'المزة',
                'neighborhood' => 'شارع فلسطين',
                'address' => 'شارع فلسطين، المزة، دمشق',
                'latitude' => 33.5167,
                'longitude' => 36.2833,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 350,
                'floor' => 1,
                'total_floors' => 2,
                'year_built' => 2018,
                'price' => 350000,
                'currency' => 'USD',
                'features' => ['garden', 'parking', 'pool', 'security'],
                'amenities' => ['furnished', 'balcony', 'garden', 'pool'],
                'images' => [
                    'properties/villa-1-main.jpg'
                ],
                'featured_image' => 'properties/villa-1-main.jpg',
                'featured' => true,
                'contact_name' => 'فاطمة أحمد',
                'contact_phone' => '+963 11 2345678',
                'contact_email' => 'fatima@example.com',
            ],
            [
                'title' => 'مكتب تجاري في منطقة الأعمال',
                'description' => 'مكتب تجاري فاخر مساحة 80 متر مربع، موقعه ممتاز في منطقة الأعمال، قريب من المصارف والشركات. مناسب للمحامين والاستشاريين.',
                'property_type' => 'office',
                'listing_type' => 'rent',
                'city' => 'دمشق',
                'district' => 'الصالحية',
                'neighborhood' => 'شارع الثورة',
                'address' => 'شارع الثورة، الصالحية، دمشق',
                'latitude' => 33.5094,
                'longitude' => 36.3078,
                'bedrooms' => null,
                'bathrooms' => 1,
                'area' => 80,
                'floor' => 3,
                'total_floors' => 5,
                'year_built' => 2019,
                'price' => 800,
                'currency' => 'USD',
                'features' => ['elevator', 'security', 'parking', 'internet'],
                'amenities' => ['furnished', 'air_conditioning'],
                'images' => [
                    'properties/office-1-main.jpg'
                ],
                'featured_image' => 'properties/office-1-main.jpg',
                'featured' => false,
                'contact_name' => 'محمد علي',
                'contact_phone' => '+963 11 3456789',
                'contact_email' => 'mohammed@example.com',
            ],
            [
                'title' => 'شقة للإيجار شهرياً',
                'description' => 'شقة مريحة مؤلفة من غرفتي نوم، صالة، مطبخ، حمام. مفروشة بالكامل، قريبة من وسائل النقل العام والأسواق.',
                'property_type' => 'apartment',
                'listing_type' => 'rent',
                'city' => 'دمشق',
                'district' => 'القدم',
                'neighborhood' => 'شارع 29 أيار',
                'address' => 'شارع 29 أيار، القدم، دمشق',
                'latitude' => 33.5000,
                'longitude' => 36.2833,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'area' => 85,
                'floor' => 2,
                'total_floors' => 4,
                'year_built' => 2015,
                'price' => 250,
                'currency' => 'USD',
                'features' => ['elevator', 'parking'],
                'amenities' => ['furnished', 'air_conditioning'],
                'images' => [
                    'properties/apartment-2-main.jpg'
                ],
                'featured_image' => 'properties/apartment-2-main.jpg',
                'featured' => false,
                'contact_name' => 'لينا حسن',
                'contact_phone' => '+963 11 4567890',
                'contact_email' => 'lina@example.com',
            ],
            [
                'title' => 'أرض سكنية للبيع',
                'description' => 'أرض سكنية مساحة 500 متر مربع في منطقة هادئة، مناسبة لبناء فيلا أو عمارة. قريبة من الخدمات والمدارس.',
                'property_type' => 'land',
                'listing_type' => 'sale',
                'city' => 'دمشق',
                'district' => 'يعفور',
                'neighborhood' => 'منطقة سكنية',
                'address' => 'يعفور، دمشق',
                'latitude' => 33.4833,
                'longitude' => 36.2833,
                'bedrooms' => null,
                'bathrooms' => null,
                'area' => 500,
                'floor' => null,
                'total_floors' => null,
                'year_built' => null,
                'price' => 75000,
                'currency' => 'USD',
                'features' => ['services', 'schools'],
                'amenities' => [],
                'images' => [
                    'properties/land-1-main.jpg'
                ],
                'featured_image' => 'properties/land-1-main.jpg',
                'featured' => false,
                'contact_name' => 'علي محمود',
                'contact_phone' => '+963 11 5678901',
                'contact_email' => 'ali@example.com',
            ],
            [
                'title' => 'محل تجاري في السوق الرئيسي',
                'description' => 'محل تجاري مميز مساحة 60 متر مربع في السوق الرئيسي، موقع ممتاز مع حركة مرور عالية. مناسب للأعمال التجارية المختلفة.',
                'property_type' => 'shop',
                'listing_type' => 'rent',
                'city' => 'دمشق',
                'district' => 'الحميدية',
                'neighborhood' => 'السوق الرئيسي',
                'address' => 'السوق الرئيسي، الحميدية، دمشق',
                'latitude' => 33.5111,
                'longitude' => 36.2894,
                'bedrooms' => null,
                'bathrooms' => 1,
                'area' => 60,
                'floor' => 0,
                'total_floors' => 1,
                'year_built' => 2010,
                'price' => 1200,
                'currency' => 'USD',
                'features' => ['high_traffic', 'security', 'storage'],
                'amenities' => ['air_conditioning'],
                'images' => [
                    'properties/shop-1-main.jpg'
                ],
                'featured_image' => 'properties/shop-1-main.jpg',
                'featured' => false,
                'contact_name' => 'سارة خالد',
                'contact_phone' => '+963 11 6789012',
                'contact_email' => 'sara@example.com',
            ],
        ];

        foreach ($properties as $property) {
            $property['slug'] = Str::slug($property['title']);
            $property['seo_title'] = $property['title'] . ' - ' . __('Real Estate in') . ' ' . $property['city'];
            $property['seo_description'] = Str::limit($property['description'], 155);
            $property['seo_keywords'] = [$property['property_type'], $property['listing_type'], $property['city']];

            RealEstate::create($property);
        }
    }
}
