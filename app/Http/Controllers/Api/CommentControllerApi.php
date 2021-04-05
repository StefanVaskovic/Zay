<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentControllerApi extends Controller
{
    public function show($id)
    {
        $product = Product::getProduct($id);
        return response()->json($product);
    }

    public function store(StoreCommentRequest $request)
    {
        try {
            /*if($request->parent_id == null && $request->product_id == null)
            {
                DB::table('comments')->insert([
                    'user_id' => session('user')->id,
                    'product_id' => $request->product_id,
                    'text' => $request->text,
                    'date' => date('Y-m-d')
                ]);
            }
            else
            {*/
                DB::table('comments')->insert([
                    'user_id' => session('user')->id,
                    'user_replied_id' => $request->user_replied_id,
                    'parent_id' => $request->comment_id,
                    'product_id' => $request->product_id,
                    'text' => $request->text,
                    'date' => date('Y-m-d')
                ]);
           /* }*/
        }
        catch (\PDOException $e)
        {
            return response()->json(['message' => $e->getMessage()]);
        }

        $product = Product::getProduct($request->product_id);
        return response()->json($product);
    }
}
