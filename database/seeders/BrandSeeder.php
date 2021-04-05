<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Polo Ralph Lauren','ASOS DESIGN','Reebok','The North Face','Lyle & Scott'];

        for ($i = 0; $i < count($brands); $i++)
        {
            DB::table('brands')->insert([
                'name' => $brands[$i]
            ]);
        }

    }
}
