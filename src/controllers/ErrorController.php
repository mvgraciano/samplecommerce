<?php

namespace Source\Controllers;

class ErrorController {

    private $appName;
    public function __construct()
    {
        \Source\Core\Environment::load(__DIR__ . '/../../');
        $this->appName = getenv("APP_NAME");
    }

    public function notFound() {
        var_dump("ERRO!");
        exit;
    }
}