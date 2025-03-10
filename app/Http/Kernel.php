<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // ... autres middlewares globaux
    ];
    // protected $routeMiddleware = [
    //     'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    //     'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
    // ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // ... autres middlewares web
        ],
        'api' => [
            // ... autres middlewares api
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        //'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        //'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'isAdmin' => \App\Http\Middleware\CheckIfAdmin::class,
    ];
} 