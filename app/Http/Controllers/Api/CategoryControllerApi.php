<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryControllerApi extends Controller
{
    public function index()
    {
        $categoires = Category::all();
        return response()->json($categoires);
    }
}
