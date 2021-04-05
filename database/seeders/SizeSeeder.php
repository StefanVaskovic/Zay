<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['S','M','L','XL'];

        for ($i = 0; $i < count($sizes); $i++)
        {
            DB::table('sizes')->insert([
                'size' => $sizes[$i]
            ]);
        }
    }
}
