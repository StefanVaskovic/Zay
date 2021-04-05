<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Profile', 'Orders', 'Products', 'Contact', 'Register', 'Login', 'Logout'];
        $routes = ['home', 'about', 'products', 'contact.index', 'register.create', 'login.create', 'logout'];

        for ($i = 0; $i < count($names); $i++) {
            DB::table('menus')->insert([
                'name' => $names[$i],
                'route' => $routes[$i],
                'order' => $i + 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
