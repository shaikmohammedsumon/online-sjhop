<?php

use App\Http\Middleware\AdminRoleCheckMiddleware;
use App\Http\Middleware\DashboardRoleCheckMiddleware;
use App\Http\Middleware\GestAuthUserPermissionMiddleware;
use App\Http\Middleware\GestUserPermissionMiddleware;
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
            'gestuserpermission' => GestUserPermissionMiddleware::class,
            'gestauthuserpermission' =>GestAuthUserPermissionMiddleware::class,
            'dashboardRoleCheckMiddleware' =>DashboardRoleCheckMiddleware::class,
            'adminRoleCheckMiddleware' => AdminRoleCheckMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
