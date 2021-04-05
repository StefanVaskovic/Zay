<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Login', 'Logout', 'Cart', 'Order'];

        for ($i = 0; $i < count($names); $i++) {
            DB::table('activities')->insert([
                'name' => $names[$i],
            ]);
        }
    }
}
