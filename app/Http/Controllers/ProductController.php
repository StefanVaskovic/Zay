<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends HomeProductController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index()
    {
        return view('pages.products',$this->data);
    }

    public function show($id)
    {
        $data = Product::getProduct($id);
        $this->data['product'] = $data['product'];
        $this->data['comments'] = $data['comments'];
        $this->data['users'] = $data['users'];
        //$this->data['user_replied'] = $data['user_replied'];
        //$this->data['product'] = $data;
        return view('pages.shop-single',$this->data);
    }
}
