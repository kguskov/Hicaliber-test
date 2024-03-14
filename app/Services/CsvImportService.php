<?php

namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CsvImportService
{
    protected string $filePath;
    protected Model $model;
    protected array $columnMapping = [];

    public function __construct(string $filePath, Model $model)
    {
        $this->filePath = $filePath;
        $this->model = $model;
    }

    /**
     * @throws Exception
     */

    public function import(): void
    {
        try {
            $path = $this->filePath;

            if (!file_exists($path) || !is_readable($path)) {
                throw new Exception(__('messages.csv_file_not_available'));
            }

            $file = fopen($path, 'r');
            $header = fgetcsv($file); // First row contains headers

            $rowNumber = 1; // Start from 1 assuming the first row contains headers
            while (($data = fgetcsv($file)) !== FALSE) {
                $rowNumber++; // Increment row number at the beginning since headers are skipped
                $mappedData = $this->mapDataToModel($header, $data);
                if ($this->validateRowData($mappedData, $rowNumber)) {
                    $this->model::create($mappedData);
                } else {
                    Log::error(__('messages.csv_import_failed'), ['row' => $mappedData]);
                }
            }

            fclose($file);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function setColumnMapping(array $columnMapping): void
    {
        $this->columnMapping = $columnMapping;
    }

    protected function mapDataToModel(array $header, array $data): array
    {
        $mappedData = [];
        $headerToIndex = array_flip($header); // Get indices of headers

        foreach ($this->columnMapping as $modelAttribute => $csvColumnName) {
            if (isset($headerToIndex[$csvColumnName])) {
                $mappedData[$modelAttribute] = $data[$headerToIndex[$csvColumnName]] ?? null;
            }
        }

        return $mappedData;
    }

    protected function validateRowData(array $rowData, int $rowNumber): bool
    {
        $isValid = true;
        $errors = [];

        // Required fields
        $requiredFields = [
            'name',
            'price',
            'bedrooms',
            'bathrooms',
            'storeys',
            'garages',
        ];

        foreach ($requiredFields as $field) {
            // Check if field is not empty
            if (empty($rowData[$field])) {
                $errors[] = __("messages.csv_{$field}_required_error");
                $isValid = false;
            }

            // Additional specific validations per field can be added here
            // e.g., numeric validation for 'price'
            if ($field === 'price' && !is_numeric($rowData[$field])) {
                $errors[] = __("messages.csv_{$field}_numeric_error");
                $isValid = false;
            }
        }

        if (!$isValid) {
            Log::error('Validation errors in CSV import', [
                'rowNumber' => $rowNumber,
                'errors' => $errors,
                'rowData' => $rowData,
            ]);
        }

        return $isValid;
    }
}
