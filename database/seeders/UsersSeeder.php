<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();


        for ($i = 0; $i < 10; $i++)
        {
            DB::table('users')->insert([
                'name' => $faker->name,
                'address' => $faker->address,
                'city' => $faker->city,
                'postal_code' => $faker->postcode,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'password' => $faker->password,
                'role_id' => 2,
                'image' => $faker->imageUrl()
            ]);
        }
    }
}
