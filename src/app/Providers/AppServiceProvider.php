<?php

namespace App\Providers;

use App\Http\Repositories\Users\UserRepositoryInterface;
use App\Services\UploadFile;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UploadFile::class, function($app) {
            return new UploadFile($app->make(UserRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
