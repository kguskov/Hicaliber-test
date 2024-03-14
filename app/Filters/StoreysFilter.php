<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class StoreysFilter
{
    public static function apply(Builder $query, $value): Builder
    {
        return $query->where('storeys', $value);
    }
}
