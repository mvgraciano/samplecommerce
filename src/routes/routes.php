<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

use Source\Controllers\EcommerceController;
use Source\Controllers\ErrorController;

\Source\Core\Environment::load(__DIR__ . '/../../');

define("BASE_URL", "/" . getenv("APP_NAME"));

SimpleRouter::get('/', [EcommerceController::class, 'home']);

SimpleRouter::group(['prefix' => BASE_URL], function () {

    // Web routes
    SimpleRouter::get('/', [EcommerceController::class, 'home']);

    // Error routes
    SimpleRouter::get('/not-found', [ErrorController::class, 'notFound']);
    SimpleRouter::get('/forbidden', [ErrorController::class, 'notFound']);
});

// ERROR
SimpleRouter::error(function(Request $request, \Exception $exception) {

    switch($exception->getCode()) {
        // Page not found
        case 404:
            response()->redirect(BASE_URL . "/not-found");
        // Forbidden
        case 403:
            response()->redirect(BASE_URL . "/forbidden");
    }
    
});