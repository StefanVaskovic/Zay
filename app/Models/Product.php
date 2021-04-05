<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $cover
 * @property string $name
 * @property string $old_price
 * @property string $discount_price
 * @property string $current_price
 * @property string $gender
 * @property string $description
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCurrentPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscountPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $color
 * @property int $brand_id
 * @property int|null $rate
 * @property-read Product $brand
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $ratingUsers
 * @property-read int|null $rating_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Size[] $sizes
 * @property-read int|null $sizes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRate($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orderDetails
 * @property-read int|null $order_details_count
 */
class Product extends Model
{
    use HasFactory;

    public static function uploadCoverImage($image)
    {
        $fileName = 'cover_'.uniqid().time().'.'.$image->extension();

        $image->storeAs('/public/products/cover',$fileName);
        return $fileName;
    }

    public static function deleteImage($image)
    {
        \Storage::disk('public')->delete('/products/images/'.$image);
    }

    public static function deleteCover($image)
    {
        \Storage::disk('public')->delete('/products/cover/'.$image);
    }

    public static function deleteAllImages($images)
    {
        foreach ($images as $i){
            \Storage::disk('public')->delete('/products/images/'.$i->image);
        }
    }

    public static function uploadImages($images)
    {
        $fileImages = [];
        foreach ($images as $image)
        {
            $fileName = 'image_'.uniqid().time().'.'.$image->extension();

            $image->storeAs('/public/products/images',$fileName);
            $fileImages[] = $fileName;
        }

        return $fileImages;
    }

    public static function getProduct($id)
    {
        //$likedComments = null;

       /* if(session()->has('user'))
        {
            $likedComments = DB::table('liked_comments')->join('comments as c','liked_comments.comment_id','=','c.id')->where('product_id',
            $id)->where('liked_comments.user_id',
            session('user')->id)->where('liked','=',true)->select('*','liked_comments.user_id as userWhoLiked')
            ->get();
        }*/
        return ['product' => self::with('category')->with('images')->with('sizes')->with('ratingUsers')->with('brand')
            ->with('comments')->find($id),'comments' => Comment::with('liked_comments')->where('product_id',$id)->get
        (),'users'=>User::with('comments')->join('comments as c', 'users.id','=','c.id')->where('product_id',$id)
            ->get(),'only_for_checking_if_user_liked_a_comment' => DB::table('liked_comments')->select('*','liked_comments.user_id as userWhoLiked')->join('comments as c',
            'liked_comments.comment_id','=','c.id')->where('product_id',$id)->get()];

    }

    public static function getProductsAndPagesAdmin(Request $request)
    {
        $query = self::with('category')->with('images')->with('sizes')->with('ratingUsers')->with('brand')->with('comments');
        $comments = Comment::with('user', 'product')->get();

        return ['products' => $query->paginate(9), 'comments' => $comments];
    }


    public static function getProductsAndPages(Request $request)
    {
        $query = self::with('category')->with('images')->with('sizes')->with('ratingUsers')->with('brand')->with('comments');

        if($request->has('catIds') && count($request->catIds) != 0)
        {
            $query = $query->whereIn('category_id', $request->catIds);
        }

        if($request->has('gender') && $request->gender != "All")
        {
            $query = $query->where('gender',$request->gender);
        }

        if ($request->has('search') && $request->search != "") {
            $search = $request->search;
            $query = $query->where('name','LIKE',"%$search%");
        }

        if ($request->has('sizes') && count($request->sizes) != 0) {
            $query = $query->whereHas('sizes', function ($query) use ($request) {
                $query->where('quantity', '!=', 0)->whereIn('size_id',$request->sizes);
            });
        }

        if ($request->has('sort') && $request->sort != '0') {

            if($request->sort == 'A-Z')
            {
                $query = $query->orderBy('name');
            }else{
                $query = $query->orderByDesc('name');
            }
        }

        $pages = ceil($query->get()->count()/6);
        $limit = 6;
        $offset = 0;

        if($request->has('page'))
        {
            if ($pages >= $request->page) {
                $offset = ($request->page - 1) * $limit;
            }
        }
        $query = $query->offset($offset)->limit($limit);



        return ["products" => $query->get(),"pages" => $pages];
    }


    public static function getProducts()
    {
        return self::with('category')->with('images')->with('sizes')->with('ratingUsers')->with('brand')->with('comments')->get();
    }

    public static function getTopNewestProducts($number)
    {
        return self::with('category')->with('images')->with('sizes')->with('ratingUsers')->with('brand')->with('comments')->orderByDesc('created_at')->get()->take($number);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class)->withPivot('quantity');
    }

    public function ratingUsers()
    {
        return $this->belongsToMany(User::class)->withPivot('grade');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function comments()
    {
        return $this->belongsToMany(User::class,'comments')->withPivot('id','user_id','product_id','text','date','parent_id','user_replied_id');
    }

    public function orderDetails()
    {
        return $this->belongsToMany(Order::class,'order_details')->withPivot('order_id','product_id','quantity','price','size');
    }
    /*public function comments()
    {
        return $this->belongsToMany(User::class,'comments')->withPivot('id','text','likes','parent_id');
    }*/

}
