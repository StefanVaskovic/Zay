<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LikedComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $comment_id
 * @property int $liked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LikedComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LikedComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LikedComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|LikedComment whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikedComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikedComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikedComment whereLiked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikedComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikedComment whereUserId($value)
 * @mixin \Eloquent
 */
class LikedComment extends Model
{
    use HasFactory;

    protected $table = 'liked_comments';
}
