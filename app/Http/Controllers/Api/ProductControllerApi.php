<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductControllerApi extends Controller
{
    public function index(Request $request)
    {
        $data = Product::getProductsAndPages($request);
        $products = $data['products'];
        $pages = $data['pages'];
        $page = isset($request->page) ? $request->page : "1";
        if($pages < $page)
        {
            $page = "1";
        }
        return response()->json(['products' => $products, 'pages' => $pages, 'page' => $page]);
    }

    public function show($id)
    {
        $data = Product::getProduct($id);
        return response()->json($data);
    }

}
