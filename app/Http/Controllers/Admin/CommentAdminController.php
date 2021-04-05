<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentAdminController extends Controller
{
    public function deleteComment($id)
    {
        try {
            $comment = Comment::find($id);
            if($comment->parent_id == null && $comment->user_replied_id == null)
            {
                Comment::where('parent_id',$id)->delete();
            }

            Comment::destroy([$id]);
            return redirect()->back()->with('successDelete','You have successfully deleted comment!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorDelete','There was an error deleting comment!');
        }
    }
}
