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
        return $query
            ->when($request->input('name'), [NameFilter::class, 'apply'])
            ->when($request->input('bedrooms'), [BedroomsFilter::class, 'apply'])
            ->when($request->input('bathrooms'), [BathroomsFilter::class, 'apply'])
            ->when($request->input('storeys'), [StoreysFilter::class, 'apply'])
            ->when($request->input('garages'), [GaragesFilter::class, 'apply'])
            ->when($request->filled(['min_price', 'max_price']), function ($query) use ($request) {
                return PriceRangeFilter::apply($query, $request->input('min_price'), $request->input('max_price'));
            });
    }
}
