<?php
namespace App\Modules\Management\BannerManagement\Banner\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\BannerManagement\Banner\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\BannerManagement\Banner\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'short_title' => $faker->text(100),
                'short_description' => $faker->paragraph,
                'video_url' => $faker->sentence,
            ]);
        }
    }
}