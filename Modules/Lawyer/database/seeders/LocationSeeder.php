<?php

namespace Modules\Lawyer\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Lawyer\app\Models\Location;
use Modules\Lawyer\app\Models\LocationTranslation;

class LocationSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run() {
        $locations = [
            [
                'translations' => [
                    ['lang_code' => 'en', 'name' => 'Damascus'],
                    ['lang_code' => 'ar', 'name' => 'دمشق'],
                ],
            ],
            [
                'translations' => [
                    ['lang_code' => 'en', 'name' => 'Aleppo'],
                    ['lang_code' => 'ar', 'name' => 'حلب'],
                ],
            ],
            [
                'translations' => [
                    ['lang_code' => 'en', 'name' => 'Homs'],
                    ['lang_code' => 'ar', 'name' => 'حمص'],
                ],
            ],
            [
                'translations' => [
                    ['lang_code' => 'en', 'name' => 'Latakia'],
                    ['lang_code' => 'ar', 'name' => 'اللاذقية'],
                ],
            ],
            [
                'translations' => [
                    ['lang_code' => 'en', 'name' => 'Hama'],
                    ['lang_code' => 'ar', 'name' => 'حماة'],
                ],
            ],
            [
                'translations' => [
                    ['lang_code' => 'en', 'name' => 'Tartus'],
                    ['lang_code' => 'ar', 'name' => 'طرطوس'],
                ],
            ],
        ];

        foreach ($locations as $locationData) {
            $location = Location::create();

            foreach ($locationData['translations'] as $translation) {
                LocationTranslation::create([
                    'location_id' => $location->id,
                    'lang_code'   => $translation['lang_code'],
                    'name'        => $translation['name'],
                ]);
            }
        }
    }
}
