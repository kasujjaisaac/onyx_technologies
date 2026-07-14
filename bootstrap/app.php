<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

require_once dirname(__DIR__) . '/app/Support/onyx_helpers.php';

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $legacyPages = function_exists('onyx_legacy_pages') ? onyx_legacy_pages() : [];
        $legacyCsrfExceptions = [];

        foreach ($legacyPages as $page) {
            $legacyCsrfExceptions[] = $page;
            $legacyCsrfExceptions[] = $page . '.php';
        }

        $middleware->validateCsrfTokens(except: $legacyCsrfExceptions);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
