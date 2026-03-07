<?php

namespace App\Providers;

use Domain\Contact\Repositoreis\ContactRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Database\Contact\Repositories\EloquentContactRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ContactRepositoryInterface::class, EloquentContactRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
