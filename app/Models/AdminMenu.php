<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminMenu
 *
 * @property int $id
 * @property string $name
 * @property string $route
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdminMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminMenu whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminMenu whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminMenu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminMenu extends Model
{
    use HasFactory;
}
