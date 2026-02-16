<?php

namespace App\Core;

class App
{
    private Router $router;

    public static function boot(): self
    {
        $app = new self();
        $app->loadEnvironment();
        $app->registerErrorHandler();
        $app->startSession();
        $app->loadRoutes();

        return $app;
    }

    private function loadEnvironment(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }

    private function registerErrorHandler(): void
    {
        ErrorHandler::register();
    }

    private function startSession(): void
    {
        Session::start();
    }

    private function loadRoutes(): void
    {
        $this->router = new Router();

        // $router beschikbaar maken in web.php
        $router = $this->router;
        require __DIR__ . '/../../routes/web.php';
    }

    public function run(): void
    {
        $this->router->dispatch();
    }
}