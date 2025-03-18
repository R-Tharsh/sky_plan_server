<?php

namespace App\Repositories;

use App\Models\Flight;

class FlightRepository implements FlightRepositoryInterface
{
    public function create(array $data)
    {
        return Flight::create($data);
    }

    public function update($id, array $data)
    {
        $flight = Flight::findOrFail($id);
        $flight->update($data);
        return $flight;
    }

    public function delete($id)
    {
        return Flight::destroy($id);
    }

    public function getAll()
    {
        return Flight::all();
    }

    public function getById($id)
    {
        return Flight::findOrFail($id);
    }
}
