<?php

function e (?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function old(string $key, string $default = ''): string
{
    return \App\Core\Session::getOld($key, $default);
}

function csrfField(): string
{
    return '<input type="hidden" name="_token" value="' . \App\Core\Csrf::token() . '">';
}

function redirect(string $url, int $statuscode = 302): never
{
    header("Location: {$url}", true, $statuscode);
    exit;
}

function render(string $template, array $data = [], string $layout = 'app'): void
{
    extract($data, EXTR_SKIP);

    ob_start();
    require __DIR__ . "/../../templates/{$template}.php";
    $content = ob_get_clean();

    require __DIR__ . "/../../templates/layouts/{$layout}.php";
}

function component(string $name, array $data = []): void
{
    $render = static function (string $__file, array $__data): void {
        extract($__data, EXTR_SKIP);
        require $__file;
    };

    $render(__DIR__ . "/../../templates/components/{$name}.php", $data);
}