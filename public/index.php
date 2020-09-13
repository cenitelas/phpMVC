<?php

use App\Kernel;

require_once __DIR__ . "/../vendor/autoload.php";

$app = new Kernel();
$app->dispatch();
