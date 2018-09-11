<?php

declare(strict_types = 1);

namespace App\Providers;

use App\Repositories\UserMetasRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     *
     */
    private function registerRepositories(): void
    {
        $this->app->singleton(UserRepository::class);
        $this->app->singleton(UserMetasRepository::class);

        $this->app->singleton(ProductRepository::class);
        $this->app->singleton(CategoryRepository::class);
    }

    /**
     *
     */
    private function registerServices(): void
    {
    }
}
