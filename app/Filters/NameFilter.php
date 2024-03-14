<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class NameFilter
{
    public static function apply(Builder $query, $value): Builder
    {
        return $query->where('name', 'like', '%' . $value . '%');
    }
}
