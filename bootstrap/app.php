<?php

use Illuminate\Http\Request;
use App\Http\Middleware\UserBanned;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CompleteProfile;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/login');
        // Using a closure...
        // $middleware->redirectGuestsTo(fn (Request $request) => route('login'));

        $middleware->alias([
            'throttle' => ThrottleRequests::class,
            'UserBanned' => UserBanned::class,
            'auth' => Authenticate::class,
            'verified' => VerifyCsrfToken::class,
            'CompleteProfile' => CompleteProfile::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'pay/callback*',
            'fedapay/callback*',
            'fedapay/webhook'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
$app->register(\Barryvdh\DomPDF\ServiceProvider::class);
