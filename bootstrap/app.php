<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckAbility;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Apply CORS to all API routes
        $middleware->api(prepend: [
            \Illuminate\Http\Middleware\HandleCors::class,
        ]);

        // Keep Sanctum for protected routes
        $middleware->alias([
            'auth' => Authenticate::class,
            'ability' => CheckAbility::class, // أضف هذا السطر أو عدّله
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
