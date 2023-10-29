<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait WithRelationship
{
    public function scopeWithRelationships(Builder $query, array|string $with): Builder
    {
        $relationships = ['videos'];

        return $query->with(array_intersect(Arr::wrap($with), static::$relationships ?? []));
    }
}
