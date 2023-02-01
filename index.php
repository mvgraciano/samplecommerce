<?php
use Pecee\SimpleRouter\SimpleRouter;
use Source\Models\JueriClient;

require_once __DIR__ . "/vendor/autoload.php";

require_once __DIR__ . "/routes.php";

SimpleRouter::setDefaultNamespace('\Source\Controllers');
SimpleRouter::start();

var_dump((new JueriClient)->listProducts());
exit;