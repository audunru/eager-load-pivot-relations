<?php

namespace audunru\EagerLoadPivotRelations\Tests\Models;

use audunru\EagerLoadPivotRelations\Tests\Database\Factories\TireFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $brand
 * @property int $profile_depth
 * @property int $car_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \audunru\EagerLoadPivotRelations\Tests\Database\Factories\TireFactory factory(...$parameters)
 * @method static Builder|Tire newModelQuery()
 * @method static Builder|Tire newQuery()
 * @method static Builder|Tire query()
 *
 * @mixin \Eloquent
 */
class Tire extends Model
{
    use HasFactory;

    protected $table = 'tires';

    protected $fillable = [
        'brand',
        'profile_depth',
        'car_user_id',
    ];

    protected static function newFactory()
    {
        return TireFactory::new();
    }
}
