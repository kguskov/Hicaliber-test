<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CsvImportTest extends TestCase
{
    use RefreshDatabase;
    /** @csv*/
    public function test_successfully_imports_data_from_csv()
    {
        // Arrange: Set up the environment
        $filePath = database_path('seeders/csv/property-data.csv'); // Adjust path as necessary
        $model = new \App\Models\Property();
        $service = new \App\Services\CsvImportService($filePath, $model);
        $service->setColumnMapping([
            'name' => 'Name',
            'price' => 'Price',
            'bedrooms' => 'Bedrooms',
            'bathrooms' => 'Bathrooms',
            'storeys' => 'Storeys',
            'garages' => 'Garages',
        ]);

        // Act: Perform the import
        $service->import();

        // Assert: Check the database to ensure data was imported
        $this->assertDatabaseHas('properties', [
            'name' => 'The Victoria', // Actual expected values from your CSV
        ]);
    }

    /** @csv */
    public function test_throws_an_exception_when_csv_file_is_not_found()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(__('messages.csv_file_not_available'));

        // Use a non-existing file path
        $filePath = 'non_existing_file.csv';
        $model = new \App\Models\Property();
        $service = new \App\Services\CsvImportService($filePath, $model);

        // Attempt to import
        $service->import();
    }
}
