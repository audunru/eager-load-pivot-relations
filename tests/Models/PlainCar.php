<?php

namespace audunru\EagerLoadPivotRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Car model without EagerLoadPivotTrait. Used to show that the related model does not need the trait.
 *
 * @property int $id
 * @property string $model
 */
class PlainCar extends Model
{
    protected $table = 'cars';
}
