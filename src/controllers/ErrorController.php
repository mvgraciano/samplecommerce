<?php

namespace Source\Controllers;

class ErrorController {

    
    public function __construct()
    {
    }

    public function notFound() {
        return '<h1>OPS! Página não encontrada!</h1>';
    }
}