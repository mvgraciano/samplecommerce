<?php
use Pecee\SimpleRouter\SimpleRouter;
use Source\Models\JueriClient;

require_once __DIR__ . "/vendor/autoload.php";

SimpleRouter::setDefaultNamespace('\Source\Controllers');
SimpleRouter::start();
