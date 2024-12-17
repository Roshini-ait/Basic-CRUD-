<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\StudentRepository;
use App\Models\Student;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StudentRepository::class, function ($app) {
            return new StudentRepository(new Student());
        });
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
