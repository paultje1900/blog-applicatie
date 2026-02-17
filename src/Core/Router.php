<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, array $action, array $middleware = []): void
    {
        $this->addRoute('GET', $uri, $action, $middleware);
    }

    public function post(string $uri, array $action, array $middleware = []): void
    {
        $this->addRoute('POST', $uri, $action, $middleware);
    }

    public function put(string $uri, array $action, array $middleware = []): void
    {
        $this->addRoute('PUT', $uri, $action, $middleware);
    }

    public function delete(string $uri, array $action, array $middleware = []): void
    {
        $this->addRoute('DELETE', $uri, $action, $middleware);
    }

    private function addRoute(string $method, string $uri, array $action, array $middleware): void
    {
        $this->routes[$method][] = [
            'pattern'    => $uri,
            'action'     => $action,
            'middleware'  => $middleware,
        ];
    }

    public function dispatch(): void
    {
        $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
        $method = strtoupper($method);

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }

        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $route) {
            $params = $this->match($route['pattern'], $uri);

            if ($params !== false) {
                $this->runMiddleware($route['middleware']);
                $this->runAction($route['action'], $params);
                return;
            }
        }

        $this->notFound();
    }

    private function match(string $pattern, string $uri): array|false
    {
        preg_match_all('/{(\w+)}/', $pattern, $paramNames);
        $paramNames = $paramNames[1];

        $regex = '#^' . preg_replace('/{(\w+)}/', '([^/]+)', $pattern) . '$#';

        if (preg_match($regex, $uri, $matches)) {
            array_shift($matches);

            $params = [];
            foreach ($paramNames as $index => $name) {
                $params[$name] = $matches[$index];
            }

            return $params;
        }

        return false;
    }

    private function runMiddleware(array $middleware): void
    {
        foreach ($middleware as $name) {
            $class = match ($name) {
                'auth'  => \App\Middleware\AuthMiddleware::class,
                'guest' => \App\Middleware\GuestMiddleware::class,
                default => throw new \InvalidArgumentException("Onbekende middleware: {$name}")
            };

            (new $class())->handle();
        }
    }

    private function runAction(array $action, array $params): void
    {
        [$controllerClass, $method] = $action;

        $controller = new $controllerClass();

        call_user_func_array([$controller, $method], $params);
    }

    private function notFound(): void
    {
        http_response_code(404);
        render('errors/404');
        exit;
    }
}