<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++)
        {
            DB::table('product_user')->insert([
                'user_id' => rand(1,10),
                'product_id' => rand(1,3),
                'grade' => rand(1,5)
            ]);
        }
    }
}
