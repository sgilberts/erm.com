<?php

use App\Http\Middleware\Admin\MyARMAdminsMisddleware;
use App\Http\Middleware\FinanceMiddleware;
use App\Http\Middleware\MemberMiddleware;
use App\Http\Middleware\VorMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admins' => MyARMAdminsMisddleware::class,
            'finance' => FinanceMiddleware::class,
            'vor' => VorMiddleware::class,
            'member' => MemberMiddleware::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
