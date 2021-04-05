<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Faker\Factory as Faker;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    protected $data = [];
    protected $faker;

    public function __construct()
    {
        $this->faker =  Faker::create();
        $this->data['menu'] = Menu::orderBy('order')->get();
        $this->data['categories'] = Category::all();

        $this->data['contact'] = [
            "address" => "18093 Tess Hollow Apt. 288
North Rafaela, DE 28186-1742",
            "phone" => "043183141",
            "email" => "test@gmail.com"
        ];
    }
}
