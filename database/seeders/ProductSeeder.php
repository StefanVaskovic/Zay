<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $genders = ["Male","Female"];
        $colors = ['Red','Blue','Green','Brown','Black'];

        for ($i = 0; $i < 50; $i++) {
            DB::table('products')->insert([
                'name' => $faker->text('15'),
                'cover' => $faker->imageUrl(),
                'discount_price' => $faker->randomNumber(4),
                'current_price' => $faker->randomNumber(4),
                'gender' => $genders[rand(0,1)],
                'category_id' => rand(1,5),
                'description' => $faker->paragraph,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'color' => $colors[rand(0,4)],
                'brand_id'=>rand(1,5)
            ]);
        }
    }
}
