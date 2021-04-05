<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @property string $address
 * @property string $city
 * @property string $postal_code
 * @property string $phone
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $liked_comments
 * @property-read int|null $liked_comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePostalCode($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDetail[] $orderDetails
 * @property-read int|null $order_details_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $ratings
 * @property-read int|null $ratings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 */
class User extends Model
{
    use HasFactory;

    /*public static function uploadImage($image)
    {
        $fileName = 'user_image_'.time().'.'.$image->extension();

        $image->storeAs('/public/user/images',$fileName);
        return $fileName;
    }*/

    public function comments()
    {
        return $this->belongsToMany(Product::class,'comments')->withPivot('id','user_id','product_id','text','date','parent_id','user_replied_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function orderDetails()
    {
        return $this->hasManyThrough(OrderDetail::class, Order::class);
    }

    public function liked_comments()
    {
        return $this->belongsToMany(Comment::class,'liked_comments');
    }
    /*public function comments()
    {
        return $this->belongsToMany(Comment::class,'comment_details')->withPivot('id','user_replied_id','text','likes','date');
    }*/

    public function activities()
    {
        return $this->belongsToMany(Activity::class)->withPivot('date');
    }

    public function ratings()
    {
        return $this->belongsToMany(Product::class,'product_user')->withPivot('product_id','grade');
    }

}
