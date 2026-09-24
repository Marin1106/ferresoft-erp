<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/*
|--------------------------------------------------------------------------
| MIDDLEWARES PERSONALIZADOS
|--------------------------------------------------------------------------
*/

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(
    basePath: dirname(__DIR__)
)

    /*
    |--------------------------------------------------------------------------
    | RUTAS
    |--------------------------------------------------------------------------
    */

    ->withRouting(

        web: __DIR__.'/../routes/web.php',

        commands: __DIR__.'/../routes/console.php',

        health: '/up',

    )

    /*
    |--------------------------------------------------------------------------
    | MIDDLEWARE
    |--------------------------------------------------------------------------
    */

    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | ALIAS PERSONALIZADOS
        |--------------------------------------------------------------------------
        */

        $middleware->alias([

            /*
            |--------------------------------------------------------------------------
            | ADMIN
            |--------------------------------------------------------------------------
            */

            'admin' => AdminMiddleware::class,

            /*
            |--------------------------------------------------------------------------
            | ROLES DINÁMICOS
            |--------------------------------------------------------------------------
            */

            'role' => RoleMiddleware::class,

        ]);

    })

    /*
    |--------------------------------------------------------------------------
    | EXCEPCIONES
    |--------------------------------------------------------------------------
    */

    ->withExceptions(function (Exceptions $exceptions): void {

        //
        
    })

    ->create();