<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|nullable|string',
            'bedrooms' => 'sometimes|nullable|integer|min:0',
            'bathrooms' => 'sometimes|nullable|integer|min:0',
            'storeys' => 'sometimes|nullable|integer|min:0',
            'garages' => 'sometimes|nullable|integer|min:0',
            'min_price' => 'sometimes|nullable|numeric|min:0',
            'max_price' => 'sometimes|nullable|numeric|min:0|gte:min_price',
        ];
    }
}
