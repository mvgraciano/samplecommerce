<?php

namespace Source\Controllers;

class ErrorController {

    
    public function __construct()
    {
    }

    public function notFound() {
        var_dump("ERRO!");
        exit;
    }
}