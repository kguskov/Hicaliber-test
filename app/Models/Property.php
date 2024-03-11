<?php

namespace App\Models;


use App\Http\Requests\PropertyRequest;
use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static search(PropertyRequest $request)
 */
class Property extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages'];

    public function toArray(): array
    {
        $array = parent::toArray();
        unset($array['created_at'], $array['updated_at']);
        return $array;
    }
    public function scopeSearch($query, PropertyRequest $request): Builder
    {
        return (new SearchScope)->apply($query, $request);
    }
}
