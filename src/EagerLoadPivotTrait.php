<?php

namespace audunru\EagerLoadPivotRelations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait EagerLoadPivotTrait
{
    /**
     * Instantiate a new BelongsToMany relationship.
     *
     * @param string|class-string<Model> $table
     * @param string                     $foreignPivotKey
     * @param string                     $relatedPivotKey
     * @param string                     $parentKey
     * @param string                     $relatedKey
     * @param string|null                $relationName
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function newBelongsToMany(
        Builder $query,
        Model $parent,
        $table,
        $foreignPivotKey,
        $relatedPivotKey,
        $parentKey,
        $relatedKey,
        $relationName = null,
    ) {
        return new EagerLoadPivotBelongsToMany($query, $parent, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relationName);
    }
}
