<?php

function e (?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $url, int $statuscode = 302): never
{
    header("Location: {$url}", true, $statuscode);
    exit;
}

function render(string $template, array $data = [], string $layout = 'main'): void
{
    extract($data, EXTR_SKIP);

    ob_start();
    require __DIR__ . "/../../templates/{$template}.php";
    $content = ob_get_clean();

    require __DIR__ . "/../../templates/layouts/{$layout}.php";
}

function component(string $name, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require __DIR__ . "/../../templates/components/{$name}.php";
}