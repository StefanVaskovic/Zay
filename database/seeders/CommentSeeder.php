<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = [null,2];

        for ($i = 0; $i < 5; $i++) {
            DB::table('comments')->insert([
                'user_id' => rand(1,3),
                'product_id' => 1,
                'text' => $faker->text,
                'likes' => rand(0,3),
                'date' => $faker->date(),
                'parent_id' => rand(1,3),
                'user_replied_id' => rand(1,3)
            ]);
        }
    }
}
