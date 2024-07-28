<?php

namespace App\Interfaces;

interface GuestRepositoryInterface
{
    /**
     * @return object
     */
    public function index(): object;

    /**
     * @param int $id
     * @return object
     */
    public function getById(int $id): object;

    /**
     * @param array $guest
     * @return void
     */
    public function store(array $guest): void;

    /**
     * @param array $guest
     * @return void
     */
    public function update(int $id, array $guest): void;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;
}
