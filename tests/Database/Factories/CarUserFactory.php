<?php

namespace audunru\EagerLoadPivotRelations\Tests\Database\Factories;

use audunru\EagerLoadPivotRelations\Tests\Models\Car;
use audunru\EagerLoadPivotRelations\Tests\Models\CarUser;
use audunru\EagerLoadPivotRelations\Tests\Models\Color;
use audunru\EagerLoadPivotRelations\Tests\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CarUser>
 */
class CarUserFactory extends Factory
{
    protected $model = CarUser::class;

    public function definition()
    {
        return [
            'car_id' => function () {
                return Car::factory()->create()->id;
            },
            'color_id' => function () {
                return Color::factory()->create()->id;
            },
            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
