<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AirportDetailService;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class AirportDetailController extends Controller
{
    use ApiResponse;

    protected $service;

    public function __construct(AirportDetailService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $airports = $this->service->listAirports($perPage);
        return $this->successResponse($airports, "Airports fetched successfully");
    }

    public function show($id)
    {
        $airport = $this->service->getAirportById($id);
        return $this->successResponse($airport, "Airport details fetched successfully");
    }

    public function store(Request $request)
    {
        $request->validate([
            'ident' => 'required|string',
            'type' => 'required|string',
            'name' => 'required|string',
            'latitude_deg' => 'required|numeric',
            'longitude_deg' => 'required|numeric',
            'elevation_ft' => 'required|integer',
            'continent' => 'required|string',
            'country_name' => 'required|string',
            'iso_country' => 'required|string',
            'region_name' => 'required|string',
            'iso_region' => 'required|string',
            'local_region' => 'required|string',
            'municipality' => 'required|string',
            'scheduled_service' => 'required|boolean',
            'gps_code' => 'required|string',
            'icao_code' => 'required|string',
            'iata_code' => 'required|string',
            'local_code' => 'required|string',
            'home_link' => 'nullable|url',
            'wikipedia_link' => 'nullable|url',
            'keywords' => 'nullable|string',
            'score' => 'required|integer',
            'last_updated' => 'required|date',
        ]);

        $airport = $this->service->createAirport($request->all());
        return $this->successResponse($airport, "Airport created successfully");
    }

    public function update(Request $request, $id)
    {
        $airport = $this->service->updateAirport($id, $request->all());
        return $this->successResponse($airport, "Airport updated successfully");
    }

    public function destroy($id)
    {
        $this->service->deleteAirport($id);
        return $this->successResponse(null, "Airport deleted successfully");
    }

    public function importCSV(Request $request)
    {
        $message = $this->service->importCSV($request);
        return $this->successResponse(null, $message['message']);
    }

    public function searchByIdentFirstLetter($letter)
    {
        $airports = $this->service->getAirportsByIdentFirstLetter($letter);
        return $this->successResponse($airports, "Matching airports fetched successfully");
    }
}
