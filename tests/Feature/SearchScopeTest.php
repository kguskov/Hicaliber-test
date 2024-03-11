<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchScopeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function test_filters_properties_by_name()
    {
        $propertyName = 'Test Property';
        Property::factory()->create(['name' => $propertyName]);

        $response = $this->getJson('/properties?name=Test');

        // Adjust the assertion to match the actual JSON structure
        $response->assertJsonFragment(['name' => $propertyName]);
    }

    /** @test */
    public function test_filters_properties_by_bedrooms()
    {
        Property::factory()->create(['bedrooms' => 3]);
        $response = $this->getJson('/properties?bedrooms=3');

        // Checking if the response contains an array with at least one property with 3 bedrooms
        $response->assertJsonFragment(['bedrooms' => 3]);
    }

    /** @test */
    public function test_filters_properties_by_price_range()
    {
        Property::factory()->create(['price' => 500000]);

        $response = $this->getJson('/properties?min_price=400000&max_price=600000');

        // Checking if the response contains an array with at least one property in the given price range
        $response->assertJsonFragment(['price' => 500000]);
    }

    /** @test */
    public function test_filters_properties_by_bathrooms()
    {
        Property::factory()->create(['bathrooms' => 2]);

        $response = $this->getJson('/properties?bathrooms=2');

        $response->assertJsonFragment(['bathrooms' => 2]);
    }

    /** @test */
    public function test_filters_properties_by_storeys()
    {
        Property::factory()->create(['storeys' => 2]);

        $response = $this->getJson('/properties?storeys=2');

        $response->assertJsonFragment(['storeys' => 2]);
    }

    /** @test */
    public function test_filters_properties_by_garages()
    {
        Property::factory()->create(['garages' => 1]);

        $response = $this->getJson('/properties?garages=1');

        $response->assertJsonFragment(['garages' => 1]);
    }

    /** @test */
    public function test_filters_properties_combining_multiple_parameters()
    {
        Property::factory()->create([
            'bedrooms' => 3,
            'bathrooms' => 2,
            'storeys' => 2,
            'garages' => 1,
            'price' => 300000
        ]);

        $response = $this->getJson('/properties?bedrooms=3&bathrooms=2&storeys=2&garages=1&min_price=250000&max_price=350000');

        $response->assertJsonFragment([
            'bedrooms' => 3,
            'bathrooms' => 2,
            'storeys' => 2,
            'garages' => 1,
            'price' => 300000
        ]);
    }

    /** @test */
    public function test_does_not_return_properties_with_different_bedroom_count()
    {
        Property::factory()->create(['bedrooms' => 3]);

        $response = $this->getJson('/properties?bedrooms=2');

        $response->assertJsonMissing(['bedrooms' => 3]);
    }

    /** @test */
    public function test_does_not_return_properties_with_different_bathroom_count()
    {
        Property::factory()->create(['bathrooms' => 2]);

        $response = $this->getJson('/properties?bathrooms=1');

        $response->assertJsonMissing(['bathrooms' => 2]);
    }

    /** @test */
    public function test_does_not_return_properties_with_different_storey_count()
    {
        Property::factory()->create(['storeys' => 2]);

        $response = $this->getJson('/properties?storeys=1');

        $response->assertJsonMissing(['storeys' => 2]);
    }

    /** @test */
    public function test_does_not_return_properties_with_different_garage_count()
    {
        Property::factory()->create(['garages' => 1]);

        $response = $this->getJson('/properties?garages=2');

        $response->assertJsonMissing(['garages' => 1]);
    }

    /** @test */
    public function test_does_not_return_properties_outside_of_price_range()
    {
        Property::factory()->create(['price' => 500000]);

        $response = $this->getJson('/properties?min_price=300000&max_price=400000');

        $response->assertJsonMissing(['price' => 500000]);
    }

    /** @test */
    public function test_handles_invalid_query_parameters_gracefully()
    {
        Property::factory()->create(['bedrooms' => 3]);

        $response = $this->getJson('/properties?bedrooms=invalid');

        $response->assertStatus(422);
    }
}
