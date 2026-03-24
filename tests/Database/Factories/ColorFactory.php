<?php

namespace audunru\EagerLoadPivotRelations\Tests\Database\Factories;

use audunru\EagerLoadPivotRelations\Tests\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Color>
 */
class ColorFactory extends Factory
{
    protected $model = Color::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
