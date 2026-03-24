<?php

namespace audunru\EagerLoadPivotRelations\Tests\Database\Factories;

use audunru\EagerLoadPivotRelations\Tests\Models\CarUser;
use audunru\EagerLoadPivotRelations\Tests\Models\Tire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tire>
 */
class TireFactory extends Factory
{
    protected $model = Tire::class;

    public function definition()
    {
        return [
            'brand' => $this->faker->word,
            'profile_depth' => $this->faker->randomNumber(2),
            'car_user_id' => function () {
                return CarUser::factory()->create()->id;
            },
        ];
    }
}
