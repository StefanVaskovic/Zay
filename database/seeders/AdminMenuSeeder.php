<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['User Profile','Menu','Products','Sizes','Orders', 'Users','Brand', 'Categories','Contact','Activities'];
        $routes = ['profile.edit','menus.index', 'products.index','sizes.index','orders.index','users.index','brands.index', 'categories.index','contacts.index','activities.index'];

        for ($i = 0; $i < count($names); $i++) {
            DB::table('admin_menus')->insert([
                'name' => $names[$i],
                'route' => $routes[$i],
                'order' => $i + 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
