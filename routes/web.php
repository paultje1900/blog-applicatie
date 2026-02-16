<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;

$router->get('/', [HomeController::class, 'index'], ['auth']);

$router->get('/login',     [AuthController::class, 'loginForm'], ['guest']);
$router->post('/login',    [AuthController::class, 'login'], ['guest']);
$router->get('/register',  [AuthController::class, 'registerForm'], ['guest']);
$router->post('/register', [AuthController::class, 'register'], ['guest']);
$router->post('/logout',   [AuthController::class, 'logout'], ['auth']);