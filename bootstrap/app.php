<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 🛡️ MENGECUALIKAN LOGIN DARI CSRF PROTEKSI (Bebas Error 419 di Banyak Device)
        $middleware->validateCsrfTokens(except: [
            '/login',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();