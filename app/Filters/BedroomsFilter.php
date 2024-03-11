<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class BedroomsFilter
{
    public static function apply(Builder $query, $value): Builder
    {
        return $query->where('bedrooms', $value);
    }
}
