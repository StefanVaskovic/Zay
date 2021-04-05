<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeControllerApi extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return response()->json($sizes);
    }
}
