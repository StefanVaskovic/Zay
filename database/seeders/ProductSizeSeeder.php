<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                DB::table('product_size')->insert([
                    'product_id' => $i,
                    'size_id' => $j,
                    'quantity' => rand(0, 1)
                ]);
            }
        }
    }
}
