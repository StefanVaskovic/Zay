<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Submenu
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $route
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereUpdatedAt($value)
 */
class Submenu extends Model
{
    use HasFactory;
}
