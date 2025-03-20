<?php

namespace App\Repositories;

interface AirportDetailRepositoryInterface
{
    public function getAll($perPage);
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function bulkInsert(array $data);
    public function getByIdentFirstLetter($letter);  // Add this method

}
