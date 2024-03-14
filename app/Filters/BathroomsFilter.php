<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class BathroomsFilter
{
    public static function apply(Builder $query, $value): Builder
    {
        return $query->where('bathrooms', $value);
    }
}
