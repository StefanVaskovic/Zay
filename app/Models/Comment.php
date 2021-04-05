<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_io
 * @property int $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereProductIo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @mixin \Eloquent
 * @property int $product_id
 * @property string $text
 * @property int $likes
 * @property string $date
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereText($value)
 * @property int $user_replied_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $liked_comments
 * @property-read int|null $liked_comments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserRepliedId($value)
 */
class Comment extends Model
{
    use HasFactory;


    /*public function users()
    {
        return $this->belongsToMany(User::class,'comments')->withPivot('id','user_replied_id','text','likes','date');
    }*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function liked_comments()
    {
        return $this->belongsToMany(User::class,'liked_comments');
    }
}
