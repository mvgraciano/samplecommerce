<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

use Source\Controllers\EcommerceController;
use Source\Controllers\ErrorController;

SimpleRouter::get('/', [EcommerceController::class, 'home']);

SimpleRouter::group(['prefix' => CONF_URL_BASE], function () {

    // Web routes
    SimpleRouter::get('/',          [EcommerceController::class, 'home']);
    SimpleRouter::get('/products',  [EcommerceController::class, 'getProducts']);
    SimpleRouter::get('/caixinha',  [EcommerceController::class, 'checkoutPage']);
    SimpleRouter::post('/checkout', [EcommerceController::class, 'checkout']);

    // Error routes
    SimpleRouter::get('/not-found', [ErrorController::class, 'notFound']);
    SimpleRouter::get('/forbidden', [ErrorController::class, 'notFound']);
});

// ERROR
SimpleRouter::error(function(Request $request, \Exception $exception) {

    switch($exception->getCode()) {
        // Page not found
        case 404:
            response()->redirect(CONF_URL_BASE . "/not-found");
        // Forbidden
        case 403:
            response()->redirect(CONF_URL_BASE . "/forbidden");
    }
    
});