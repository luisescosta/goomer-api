<?php

namespace App\Providers;

use App\Repositories\Interfaces\{IRestaurantRepository, IProductRepository};
use App\Repositories\{RestaurantRepository, ProductRepository};
use App\Services\Interfaces\{IRestaurantService, IProductService};
use App\Services\{RestaurantService, ProductService};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Restaurant
        $this->app->bind(IRestaurantService::class, RestaurantService::class);
        $this->app->bind(IRestaurantRepository::class, RestaurantRepository::class);

        // Product
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
