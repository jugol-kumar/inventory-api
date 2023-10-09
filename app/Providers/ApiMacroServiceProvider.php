<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ApiMacroServiceProvider extends ServiceProvider
{
    /**
     * @param bool $is_success
     * @param string $description
     * @param int|int $code
     * @param null $data
     * @param string|null $message
     */
    public function boot()
    {
        Response::macro('api', function (bool $status, string $description, int $code = 400, $data = null, string $message = null){
            return response()->json([
                'status' => $status,
                'message' => $message,
                'description' => $description,
                'data' => $data
            ], $code);
        });
    }
}
