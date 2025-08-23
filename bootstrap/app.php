<?php

use App\Http\Middleware\AdminApprovalMiddleware;
use App\Http\Middleware\AdminBinagramMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AdminSistemMiddleware;
use App\Http\Middleware\NoCache;
use App\Http\Middleware\NoCacheMiddleware;
use App\Http\Middleware\OperatorMiddleware;
use App\Http\Middleware\PimpinanMiddleware;
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
        $middleware->alias([
            'pimpinan' => PimpinanMiddleware::class,
            'adminsistem' => AdminSistemMiddleware::class,
            'adminbinagram' => AdminBinagramMiddleware::class,
            'adminapproval' => AdminApprovalMiddleware::class,
            'operator' => OperatorMiddleware::class,
            'no-cache' => NoCacheMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
