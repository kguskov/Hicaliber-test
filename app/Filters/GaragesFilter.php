<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class GaragesFilter
{
    public static function apply(Builder $query, $value): Builder
    {
        return $query->where('garages', $value);
    }
}
