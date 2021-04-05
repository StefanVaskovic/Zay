<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminMenu;
use App\Models\Category;
use Faker\Factory as Faker;

class ParentAdminController extends Controller
{
    protected $data = [];
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
        $this->data['menu'] = AdminMenu::orderBy('order')->get();
        $this->data['categories'] = Category::all();

        $this->data['contact'] = [
            'address' => 'Adresa',
            'phone' => '043183141',
            'email' => 'test@gmail.com'
        ];
    }
}
