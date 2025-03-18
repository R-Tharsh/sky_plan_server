<?php

namespace App\Repositories;

use App\Models\AirportDetail;

class AirportDetailRepository implements AirportDetailRepositoryInterface
{
    public function getAll($perPage)
    {
        return AirportDetail::paginate($perPage);
    }

    public function getById($id)
    {
        return AirportDetail::findOrFail($id);
    }

    public function create(array $data)
    {
        return AirportDetail::create($data);
    }

    public function update($id, array $data)
    {
        $airport = AirportDetail::findOrFail($id);
        $airport->update($data);
        return $airport;
    }

    public function delete($id)
    {
        $airport = AirportDetail::findOrFail($id);
        $airport->delete();
    }

    public function bulkInsert(array $data)
    {
        return AirportDetail::insertOrIgnore($data);
    }
}