<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::group(['prefix' => '/juecommerce'], function () {
    SimpleRouter::get('/', function () {
        return 'Olá, mundo';
    }
    );
});