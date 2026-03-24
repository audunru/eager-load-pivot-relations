<?php

namespace audunru\EagerLoadPivotRelations\Tests\Models;

use audunru\EagerLoadPivotRelations\EagerLoadPivotTrait;
use audunru\EagerLoadPivotRelations\Tests\Database\Factories\CarFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $model
 * @property string $make
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User[]|null $users
 *
 * @method static \audunru\EagerLoadPivotRelations\Tests\Database\Factories\CarFactory factory(...$parameters)
 * @method static Builder|Car newModelQuery()
 * @method static Builder|Car newQuery()
 * @method static Builder|Car query()
 *
 * @mixin \Eloquent
 */
class Car extends Model
{
    use EagerLoadPivotTrait;
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'model',
        'brand_id',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('color_id')
            ->using(CarUser::class)
            ->as('car_user');
    }

    protected static function newFactory()
    {
        return CarFactory::new();
    }
}
