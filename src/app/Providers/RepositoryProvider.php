<?php

namespace App\Providers;

use App\Http\Repositories\Catrgories\CategoryRepository;
use App\Http\Repositories\Catrgories\CategoryRepositoryInterface;
use App\Http\Repositories\Users\UserRepository;
use App\Http\Repositories\Users\UserRepositoryInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, function() {
            return new CategoryRepository();
        });
        $this->app->bind(UserRepositoryInterface::class, function() {
            return new UserRepository();
        });
    }

    public function boot(): void
    {
        //
    }

    public function provides(): array
    {
        return [CategoryRepositoryInterface::class, UserRepositoryInterface::class];
    }
}
