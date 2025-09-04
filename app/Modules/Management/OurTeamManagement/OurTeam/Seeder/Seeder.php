<?php
namespace App\Modules\Management\OurTeamManagement\OurTeam\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\OurTeamManagement\OurTeam\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\OurTeamManagement\OurTeam\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'name' => $faker->text(100),
                'image' => $faker->sentence,
                'social_link' => json_encode([$faker->word, $faker->word]),
            ]);
        }
    }
}