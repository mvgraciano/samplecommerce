<?php
use Source\Models\JueriClient;

require_once __DIR__ . "/vendor/autoload.php";


var_dump((new JueriClient)->listProducts());
exit;