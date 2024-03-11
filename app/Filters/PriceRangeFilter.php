<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PriceRangeFilter
{
    public static function apply(Builder $query, $minPrice, $maxPrice): Builder
    {
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query;
    }
}
