# eager-load-pivot-relations

Lets Eloquent eager load relations of a `BelongsToMany` pivot model with the `pivot` keyword, e.g. `Plan::with('items.pivot.unit')`. Fork of `ajcastro/eager-load-pivot-relations`.

## Public API

- **`EagerLoadPivotTrait`** (`src/EagerLoadPivotTrait.php`) — add to the model that **defines** the `belongsToMany()` relation (e.g. `Plan` for `Plan::items()`), because Laravel calls `newBelongsToMany()` on that model. The trait overrides `newBelongsToMany()` to return `EagerLoadPivotBelongsToMany`. Other relation types are not affected

Usage (from tests):

```php
// Default pivot accessor
User::with(['cars', 'cars.pivot.color'])->find($id);

// Custom pivot accessor (defined with ->as('car_user') on the relation)
Car::with(['users', 'users.car_user.color'])->find($id);
```

- **`EagerLoadPivotBelongsToMany`** (`src/EagerLoadPivotBelongsToMany.php`) — extends `BelongsToMany` and overrides `get()`:
  1. hydrates the pivot models as usual
  2. takes the eager loads that start with `<accessor>.` (default accessor `pivot`, or the name given with `->as()`) out of the builder
  3. eager loads them on the pivot models with the pivot model's own query, then eager loads the remaining relations

## Service Provider

None. This package has no service provider, no config and no `spatie/laravel-package-tools` dependency. It only requires `illuminate/database` and `illuminate/support`.

## Testing

`tests/TestCase.php` runs the migrations in `tests/Database/Migrations/` in `getEnvironmentSetUp()` (no package providers). Fixtures in `tests/Models/`: `Car` and `User` use the trait and are linked through the custom pivot `CarUser` (`belongsTo` `Color`, `hasMany` `Tire`); `Car::users()` uses `->as('car_user')` to test a custom accessor. Factories are in `tests/Database/Factories/`. Tests in `tests/Unit/`: `PivotTest` (`with`, `load`, `loadMissing`), `PaginateTest`, `CountTest`.

## Conventions / Gotchas

- The pivot must use a custom pivot model (`->using(PivotModel::class)`) that defines the relations, and the foreign keys must be selected with `->withPivot(...)`.
- `get()` copies a large part of Laravel's `BelongsToMany::get()`. When Laravel changes that method, check that this override still matches it.
- The pivot eager loads are removed from the main builder before `eagerLoadRelations()` runs, so Eloquent never sees `pivot.*` as an unknown relation (see `getPivotEagerLoads()`).
- The README example puts the trait on the related model (`Item`). That does not agree with the code: the trait must be on the model that defines the relation.
- Each pivot relation is loaded from `head($pivots)->query()`, so all pivots of one query must be the same pivot class.
