<?php
namespace App\Providers;

use App\Interfaces\GuestRepositoryInterface;
use App\Repositories\GuestRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            GuestRepositoryInterface::class,
            GuestRepository::class
        );
    }
}
