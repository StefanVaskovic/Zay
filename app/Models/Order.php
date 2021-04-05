<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 * @property string $sumPrice
 * @property string $date
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSumPrice($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $orderDetails
 * @property-read int|null $order_details_count
 * @property-read \App\Models\User $user
 */
class Order extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->belongsToMany(Product::class,'order_details')->withPivot('order_id','product_id','quantity','price','size');
    }
}
