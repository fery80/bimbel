<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Middleware global
    ];

    protected $middlewareGroups = [
        'web' => [
            // Middleware web
        ],
        'api' => [
            // Middleware API
        ],
    ];
    protected $routeMiddleware = [
        // Middleware lainnya
        'ensureUserIsSiswa' => \App\Http\Middleware\EnsureUserIsSiswa::class,
    ];
    
}
