<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreMainCommentRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCommentControllerApi extends Controller
{
    public function store(StoreMainCommentRequest $request)
    {
        try {
            DB::table('comments')->insert([
                'user_id' => session('user')->id,
                'product_id' => $request->product_id,
                'text' => $request->text,
                'date' => date('Y-m-d')
            ]);
        }
        catch (\PDOException $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }

        $product = Product::getProduct($request->product_id);
        return response()->json($product);
    }
}
