# eager-load-pivot-relations

Extends Eloquent's `BelongsToMany` to support eager-loading relations that belong to the pivot model itself, using `with('relation.pivot.nestedRelation')` syntax.

## Public API

No facades or service provider. Consumers use one trait:

- `EagerLoadPivotTrait` — add to any Eloquent model that has `belongsToMany` relationships. Overrides `newBelongsToMany()` to return `EagerLoadPivotBelongsToMany` instead of the standard Laravel class.

Usage pattern (from tests):

```php
// Default pivot accessor
User::with(['cars', 'cars.pivot.color'])->find($id);

// Custom pivot accessor (defined via ->as('car_user') on the relation)
Car::with(['users', 'users.car_user.color'])->find($id);
```

The pivot model itself (e.g. `CarUser`) is a standard `Illuminate\Database\Eloquent\Relations\Pivot` subclass — no special trait needed on it.

## Dependencies

- Internal: none
- External: `illuminate/database ^13.0`, `illuminate/support ^13.0`

## Testing

```
composer test
```

Fixtures: `tests/Models/` contains `User`, `Car`, `CarUser` (pivot), `Color`, `Tire`, `Brand`. Migrations are in `tests/Database/Migrations/`. Tests cover `with()`, `load()`, and `loadMissing()` for both default (`pivot`) and custom pivot accessors, plus pagination and count edge cases.

## Conventions / Gotchas

- There is **no service provider**. Nothing is auto-registered; the trait must be added manually to each model that needs the feature.
- The trait only affects `belongsToMany` — other relation types are unaffected.
- Pivot eager loads are stripped from the main builder's eager-load list before `eagerLoadRelations()` runs, so they never hit standard Eloquent's unknown-relation path. See `src/EagerLoadPivotBelongsToMany.php::getPivotEagerLoads()`.
- The pivot model must use `->using(PivotClass::class)` and the pivot class must define the nested relations for them to be loadable.
