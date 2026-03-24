<?php

namespace audunru\EagerLoadPivotRelations\Tests\Database\Factories;

use audunru\EagerLoadPivotRelations\Tests\Models\Brand;
use audunru\EagerLoadPivotRelations\Tests\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'model' => $this->faker->words(rand(2, 4), true),
            'brand_id' => function () {
                return Brand::factory()->create()->id;
            },
        ];
    }
}
