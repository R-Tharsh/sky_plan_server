<?php

namespace App\Services;

use App\Repositories\FlightRepositoryInterface;

class FlightService implements FlightServiceInterface
{
    protected $flightRepository;

    public function __construct(FlightRepositoryInterface $flightRepository)
    {
        $this->flightRepository = $flightRepository;
    }

    public function createFlight(array $data)
    {
        return $this->flightRepository->create($data);
    }

    public function updateFlight($id, array $data)
    {
        return $this->flightRepository->update($id, $data);
    }

    public function deleteFlight($id)
    {
        return $this->flightRepository->delete($id);
    }

    public function getAllFlights()
    {
        return $this->flightRepository->getAll();
    }

    public function getFlightById($id)
    {
        return $this->flightRepository->getById($id);
    }
}
