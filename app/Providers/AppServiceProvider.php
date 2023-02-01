<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Response;

class  AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function($data, $status=200, string $message= "") {
            return response()->json([
                'status' => 'OK',
                'success' => true,
                'message' => $message,
                'data' => $data
            ], $status);
        });

        Response::macro('error', function (string $message, int $status=400, $data = []) {
            return response()->json([
                'status' => 'ERROR',
                'success' => false,
                'message' => $message,
                'data' => $data
            ], $status);
        });
        JsonResource::withoutWrapping();
    }
}
