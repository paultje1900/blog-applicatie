<?php

namespace App\Core;

use ErrorException;
use Throwable;

class ErrorHandler
{
    public static function register (): void
    {
        set_error_handler(function (int $severity, string $message, string $file, int $line): bool {
            if (!(error_reporting() & $severity)) {
                return false;
            }

            throw new ErrorException($message, 0, $severity, $file, $line);
        });

        set_exception_handler(function (Throwable $exception): void {
            self::handleException($exception);
        });
        
        register_shutdown_function(function (): void {
            $error = error_get_last();

            if ($error !== null && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE])) {
                self::handleException(
                    new ErrorException(
                        $error['message'],
                        0,
                        $error['type'],
                        $error['file'],
                        $error['line']
                    )
                );
            }
        });
    }

    private static function handleException(Throwable $exception): void
    {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        http_response_code(500);

        self::logError($exception);

        $debug = ($_ENV['APP_DEBUG'] ?? 'false') === 'true';

        if ($debug) {
            self::renderDebugPage($exception);
        } else {
            self::renderProductionPage();
        }

        exit(1);
    }

    private static function logError(Throwable $exception): void
    {
        $message = sprintf(
            "[%s] %s: %s in %s:%d\nStack trace:\n%s\n",
            date('Y-m-d H:i:s'),
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $exception->getTraceAsString()
        );

        error_log($message);
    }

    private static function renderDebugPage(Throwable $exception): void
    {
        $templatePath = __DIR__ . '/../../templates/errors/debug.php';

        if (file_exists($templatePath)) {
            $class = get_class($exception);
            $message = $exception->getMessage();
            $file = $exception->getFile();
            $line = $exception->getLine();
            $trace = $exception->getTraceAsString();
            $method = $_SERVER['REQUEST_METHOD'] ?? 'CLI';
            $uri = $_SERVER['REQUEST_URI'] ?? 'unknown';

            require $templatePath;
        } else {
            echo '<h1>Error</h1>';
            echo '<p><strong>' . htmlspecialchars(get_class($exception)) . '</strong></p>';
            echo '<p>' . htmlspecialchars($exception->getMessage()) . '</p>';
            echo '<p>In ' . htmlspecialchars($exception->getFile()) . ':' . $exception->getLine() . '</p>';
            echo '<h3>Stack Trace</h3>';
            echo '<pre>' . htmlspecialchars($exception->getTraceAsString()) . '</pre>';
        }
    }

    private static function renderProductionPage(): void
    {
        $templatePath = __DIR__ . '/../../templates/errors/500.php';

        if (file_exists($templatePath)) {
            require $templatePath;
        } else {
            echo '<h1>500 - Server Error</h1>';
            echo '<p>Er is iets misgegaan. Probeer het later opnieuw.</p>';
        }
    }
}