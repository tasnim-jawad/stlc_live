<?php
namespace App\Modules\Management\PropertyManagement\Property\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\PropertyManagement\Property\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\PropertyManagement\Property\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'banner_image' => json_encode([$faker->word, $faker->word]),
                'property_group_id' => null,
                'property_category_id' => null,
                'property_status' => $faker->randomElement(array (
  0 => 'rent',
  1 => 'sale',
)),
                'date' => $faker->dateTime,
                'property_name' => $faker->text(100),
                'property_address' => $faker->sentence,
                'property_description' => $faker->paragraph,
                'property_detail' => $faker->sentence,
                'facts_and_features' => json_encode([$faker->word, $faker->word]),
                'gallery' => json_encode([$faker->word, $faker->word]),
                'amenities' => json_encode([$faker->word, $faker->word]),
                'floor_plan' => json_encode([$faker->word, $faker->word]),
                'property_video_url' => $faker->sentence,
                'map_location_url' => $faker->sentence,
            ]);
        }
    }
}