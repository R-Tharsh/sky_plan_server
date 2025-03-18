<?php

namespace App\Services;

interface FlightServiceInterface
{
    public function createFlight(array $data);
    public function updateFlight($id, array $data);
    public function deleteFlight($id);
    public function getAllFlights();
    public function getFlightById($id);
}
