<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

\App\Core\ErrorHandler::register();
\App\Core\Session::start();

// Maak de router aan
$router = new \App\Core\Router();

// Laad alle routes
require __DIR__ . '/../routes/web.php';

// Dispatch — zoek de juiste route en voer uit
$router->dispatch();