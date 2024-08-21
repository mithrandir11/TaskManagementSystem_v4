<?php

namespace App\Providers;

use App\Repositories\Interfaces\ITaskRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ITaskRepository::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('success', function($message, $data) {
            return response()->json([
                'status' => 1,
                'message' => $message,
                'data' => $data,
            ]);
        });

        Response::macro('error', function($message, $data, $code = 500) {
            return response()->json([
                'status' => 0,
                'error' => $message,
                'data' => $data,
            ], $code);
        });
    }
}
