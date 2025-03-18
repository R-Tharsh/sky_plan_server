<?php

namespace App\Services;

use App\Repositories\AirportDetailRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirportDetailService
{
    protected $repository;

    public function __construct(AirportDetailRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function listAirports($perPage)
    {
        return $this->repository->getAll($perPage);
    }

    public function getAirportById($id)
    {
        return $this->repository->getById($id);
    }

    public function createAirport(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateAirport($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteAirport($id)
    {
        $this->repository->delete($id);
    }

    public function importCSV(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();
        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data); // Get header row

        // Disable query log for better performance
        DB::connection()->disableQueryLog();

        // Process data in chunks
        $batchSize = 500;
        $batchData = [];

        foreach ($data as $row) {
            $airportData = array_combine($header, $row);

            $airportData['latitude_deg'] = is_numeric($airportData['latitude_deg']) ? (float) $airportData['latitude_deg'] : null;
            $airportData['longitude_deg'] = is_numeric($airportData['longitude_deg']) ? (float) $airportData['longitude_deg'] :
                null;
            $airportData['elevation_ft'] = is_numeric($airportData['elevation_ft']) ? (int) $airportData['elevation_ft'] : null;
            $airportData['score'] = is_numeric($airportData['score']) ? (int) $airportData['score'] : null;
            $airportData['scheduled_service'] = filter_var($airportData['scheduled_service'] ?? false, FILTER_VALIDATE_BOOLEAN);
            $airportData['last_updated'] = date('Y-m-d H:i:s', strtotime($airportData['last_updated'] ?? 'now'));

            $batchData[] = $airportData;

            if (count($batchData) >= $batchSize) {
                $this->repository->bulkInsert($batchData);
                $batchData = [];
            }
        }

        if (!empty($batchData)) {
            $this->repository->bulkInsert($batchData);
        }

        return ['message' => 'CSV data imported successfully, duplicates skipped'];
    }
}