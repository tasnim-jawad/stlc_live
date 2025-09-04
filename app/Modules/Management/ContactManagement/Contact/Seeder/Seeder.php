<?php
namespace App\Modules\Management\ContactManagement\Contact\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\ContactManagement\Contact\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\ContactManagement\Contact\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'name' => $faker->text(100),
                'email' => $faker->text(50),
                'service_types' => $faker->sentence,
                'phone_number' => $faker->sentence,
                'message' => $faker->paragraph,
            ]);
        }
    }
}