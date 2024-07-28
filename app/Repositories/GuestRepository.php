<?php

namespace App\Repositories;

use App\Interfaces\GuestRepositoryInterface;
use App\Models\Guest;

class GuestRepository implements GuestRepositoryInterface
{
    public function index(): object
    {
        return Guest::all();
    }

    public function getById(int $id): object
    {
        return Guest::findOrFail($id);
    }

    public function store(array $guest): void
    {
        Guest::create($guest);
    }

    public function update(int $id, array $guest): void
    {
        Guest::updateOrCreate([
            'id' => $id,
        ], $guest);
    }

    public function destroy($id): void
    {
        Guest::destroy($id);
    }
}
