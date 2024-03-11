<?php

namespace App\Scopes;

use App\Filters\BathroomsFilter;
use App\Filters\BedroomsFilter;
use App\Filters\GaragesFilter;
use App\Filters\NameFilter;
use App\Filters\PriceRangeFilter;
use App\Filters\StoreysFilter;
use App\Http\Requests\PropertyRequest;
use Illuminate\Database\Eloquent\Builder;

class SearchScope
{
    public function apply(Builder $query, PropertyRequest $request): Builder
    {

    }
}
