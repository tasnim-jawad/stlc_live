<?php
namespace App\Modules\Management\AboutUsManagement\AboutUs\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\AboutUsManagement\AboutUs\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\AboutUsManagement\AboutUs\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(100),
                'description' => $faker->paragraph,
                'features' => json_encode([$faker->word, $faker->word]),
                'quotation' => $faker->sentence,
                'video_url' => $faker->sentence,
                'primary_image' => $faker->sentence,
                'secondery_image' => $faker->sentence,
                'page_type' => $faker->randomElement(array (
  0 => 'about_us',
  1 => 'our_mission',
  2 => 'our_vission',
  3 => 'none',
)),
            ]);
        }
    }
}