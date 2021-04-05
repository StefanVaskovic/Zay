<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderDetail
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $size
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereSize($value)
 */
class OrderDetail extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
