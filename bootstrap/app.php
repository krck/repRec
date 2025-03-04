<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\SecurityHeaderMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(SecurityHeaderMiddleware::class); // MUST be last
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Create a custom context for the exceptions
        // Extract: Exception Type (name), File + Line and user id
        $exceptions->context(function ($e) {
            $user = Auth::user();
            return [
                'type' => $e instanceof Throwable ? get_class($e) : null,
                'file' => $e instanceof Throwable ? $e->getFile() : null,
                'line' => $e instanceof Throwable ? strval($e->getLine()) : null,
                'user' => $user != null ? $user->id : null
            ];
        });

        // Automatic De-duplication, in case the same exception object is reported multiple times
        $exceptions->dontReportDuplicates();
    })->create();
