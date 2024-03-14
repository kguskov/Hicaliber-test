<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @controller */
    public function test_returns_a_successful_json_response_with_all_properties_when_no_search_criteria_is_provided()
    {
        Property::factory()->count(3)->create();

        // Send a request to the controller endpoint without any search parameters
        $response = $this->getJson('api/properties');

        // Assert: The response is successful and returns all properties
        $response->assertOk();
        $response->assertJsonStructure([
            'properties' => [
                '*' => [
                    'name',
                    'bedrooms',
                    'bathrooms',
                    'storeys',
                    'garages',
                    'price',
                ],
            ],
        ]);
        $response->assertJsonCount(3, 'properties'); // Expecting 3 properties as created above
    }

    /** @controller */
    public function test_responds_with_422_when_invalid_search_criteria_is_provided()
    {
        // Arrange: (Nothing specific here since we're testing handling of invalid parameters)

        // Act: Make a request with an invalid search parameter
        $response = $this->getJson('api/properties?bedrooms=invalid'); // Using 'bedrooms' as an example

        // Assert: The response should indicate a validation error with a 422 status code
        $response->assertStatus(422);
    }
}
