<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
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

        Response::macro('error', function (string $message, $status=400, $data = []) {
            return response()->json([
                'status' => 'ERROR',
                'success' => false,
                'message' => $message,
                'data' => $data
            ], $status);
        });


        Collection::macro('paginate', function($perPage, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage), // $items
                $this->count(),                  // $total
                $perPage,
                $page,
                [                                // $options
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
        JsonResource::withoutWrapping();
    }

}
