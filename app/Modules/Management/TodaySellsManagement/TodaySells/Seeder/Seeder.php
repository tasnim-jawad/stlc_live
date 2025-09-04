<?php
namespace App\Modules\Management\TodaySellsManagement\TodaySells\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\TodaySellsManagement\TodaySells\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\TodaySellsManagement\TodaySells\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(100),
                'description' => $faker->paragraph,
                'features' => json_encode([$faker->word, $faker->word]),
                'key_features' => json_encode([$faker->word, $faker->word]),
                'video_url' => $faker->sentence,
                'image_gallery_left' => json_encode([$faker->word, $faker->word]),
                'image_gallery_right' => json_encode([$faker->word, $faker->word]),
            ]);
        }
    }
}