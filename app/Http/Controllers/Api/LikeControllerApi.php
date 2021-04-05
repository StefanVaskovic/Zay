<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeControllerApi extends Controller
{
    public function store(Request $request)
    {
        try {
            $user_id = 0;
            if(session()->has('user'))
            {
                $user_id = session('user')->id;
            }
            else
            {
                return response()->json(['message'=>'You need to be logged in to be able to like comments']);
            }

            $comment_id = $request->comment_id;

            $likedComment = DB::table('liked_comments')->where([
                'user_id' => $user_id,
                'comment_id' => $comment_id
            ])->first();

            if($likedComment)
            {
                DB::table('liked_comments')->where([
                    'user_id' => $user_id,
                    'comment_id' => $comment_id
                ])->delete();
            }
            else
            {
                DB::table('liked_comments')->insert([
                    'user_id' => $user_id,
                    'comment_id' => $comment_id
                ]);
            }

            $product = Product::getProduct($request->product_id);
            return response()->json($product);
        }
        catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
