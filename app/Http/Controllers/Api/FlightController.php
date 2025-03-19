<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FlightServiceInterface;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    protected $flightService;

    public function __construct(FlightServiceInterface $flightService)
    {
        $this->flightService = $flightService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_no' => 'sometimes|string',
            'origin' => 'sometimes|string',
            'destination' => 'sometimes|string',
            'time' => 'sometimes|string',
        ]);

        $flight = $this->flightService->createFlight($validated);

        return response()->json($flight, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'flight_no' => 'required|string',
            'origin' => 'required|string',
            'destination' => 'required|string',
            'time' => 'required|time',
        ]);

        $flight = $this->flightService->updateFlight($id, $request->all());

        return response()->json([
            'data' => $flight,
        ]);
    }

    public function destroy($id)
    {
        $this->flightService->deleteFlight($id);

        return response()->json([], 204);
    }
}

