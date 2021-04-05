<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeProductController extends ParentController
{
    public function __construct(Request $request)
    {
        parent::__construct();

        $this->data['products'] = Product::getProductsAndPages($request)['products'];
        $this->data['pages'] = Product::getProductsAndPages($request)['pages'];
    }
}
