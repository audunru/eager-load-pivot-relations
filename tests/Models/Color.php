<?php

namespace audunru\EagerLoadPivotRelations\Tests\Models;

use audunru\EagerLoadPivotRelations\Tests\Database\Factories\ColorFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \audunru\EagerLoadPivotRelations\Tests\Database\Factories\ColorFactory factory(...$parameters)
 * @method static Builder|Color newModelQuery()
 * @method static Builder|Color newQuery()
 * @method static Builder|Color query()
 *
 * @mixin \Eloquent
 */
class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    protected $fillable = [
        'name',
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected static function newFactory()
    {
        return ColorFactory::new();
    }
}
