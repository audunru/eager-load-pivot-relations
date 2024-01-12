<?php

namespace audunru\EagerLoadPivotRelations\Tests\Unit;

use audunru\EagerLoadPivotRelations\Tests\Models\CarUser;
use audunru\EagerLoadPivotRelations\Tests\Models\Tire;
use audunru\EagerLoadPivotRelations\Tests\Models\User;
use audunru\EagerLoadPivotRelations\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanUseWithCountPivotRelations()
    {
        $this->markTestSkipped('This could be a new feature, see #6');

        $user = User::factory()->create();
        $pivots = CarUser::factory(['user_id' => $user->id])->count(2)->create();
        $tires = rand(4, 8);

        foreach ($pivots as $pivot) {
            Tire::factory(['car_user_id' => $pivot->id])
                ->count($tires)
                ->create();
        }

        $user = User::with([
            'cars',
            'cars.pivot.color',
            'cars.pivot' => function ($query) {
                return $query->withCount('tires');
            },
        ])
            ->find($user->id);

        $this->assertSame($tires, $user->cars[0]->pivot->tires_count);
    }

    public function testItCanUseLoadCountPivotRelations()
    {
        $this->markTestSkipped('This could be a new feature, see #6');

        $user = User::factory()->create();
        $pivots = CarUser::factory(['user_id' => $user->id])->count(2)->create();
        $tires = rand(4, 8);

        foreach ($pivots as $pivot) {
            Tire::factory(['car_user_id' => $pivot->id])
                ->count($tires)
                ->create();
        }

        $user = User::find($user->id);
        $user->load([
            'cars',
            'cars.pivot.color',
            'cars.pivot' => function ($query) {
                return $query->withCount('tires');
            }]);

        $this->assertSame($tires, $user->cars[0]->pivot->tires_count);
    }
}
