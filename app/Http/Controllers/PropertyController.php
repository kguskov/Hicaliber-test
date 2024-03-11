<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Property;
use Illuminate\Http\JsonResponse;

class PropertyController extends Controller
{
    public function __invoke(PropertyRequest $request): JsonResponse
    {
        // List of all query parameters that SearchScope uses
        $searchCriteria = ['name', 'bedrooms', 'bathrooms', 'storeys', 'garages', 'min_price', 'max_price'];

        // Check if the request has any of these parameters
        if ($request->hasAny($searchCriteria)) {

            $properties = Property::search($request)
                ->paginate();
        } else {
            // If not, paginate all properties
            $properties = Property::paginate();
        }

        return response()->json(['properties' => $properties]);
    }
}
