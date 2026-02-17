<?php

use App\Controllers\AuthController;
use App\Controllers\PostController;

$router->get('/login',     [AuthController::class, 'loginForm'], ['guest']);
$router->post('/login',    [AuthController::class, 'login'], ['guest']);
$router->get('/register',  [AuthController::class, 'registerForm'], ['guest']);
$router->post('/register', [AuthController::class, 'register'], ['guest']);
$router->post('/logout',   [AuthController::class, 'logout'], ['auth']);

$router->get('/',                    [PostController::class, 'index']);
$router->get('/posts/create',        [PostController::class, 'create'],  ['auth']);
$router->post('/posts',              [PostController::class, 'store'],   ['auth']);
$router->get('/posts/{id}',          [PostController::class, 'show']);
$router->get('/posts/{id}/edit',     [PostController::class, 'edit'],    ['auth']);
$router->post('/posts/{id}',         [PostController::class, 'update'],  ['auth']);
$router->post('/posts/{id}/delete',  [PostController::class, 'destroy'], ['auth']);