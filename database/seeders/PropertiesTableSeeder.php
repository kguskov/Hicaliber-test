<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Services\CsvImportService;
use Exception;
use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        $path = database_path('seeders/csv/property-data.csv');

        $csvService = new CsvImportService($path, new Property());

        // Setup column mappings - CSV column names to model attribute names
        $columnMapping = [
            'name' => 'Name', // Model attribute => CSV header name
            'price' => 'Price',
            'bedrooms' => 'Bedrooms',
            'bathrooms' => 'Bathrooms',
            'storeys' => 'Storeys',
            'garages' => 'Garages',
        ];

        // Apply the mappings
        $csvService->setColumnMapping($columnMapping);
        // Import the data
        $csvService->import();
    }
}
