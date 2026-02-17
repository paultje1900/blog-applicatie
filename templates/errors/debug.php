<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #0a0a0f;
            color: #e0e0e0;
            line-height: 1.6;
        }

        .error-container {
            max-width: 960px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .error-header {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 12px 12px 0 0;
            padding: 30px;
        }

        .error-header h1 {
            font-size: 1.4em;
            color: #fff;
            margin-bottom: 10px;
        }

        .error-class {
            font-size: 0.9em;
            color: rgba(255, 255, 255, 0.7);
            font-family: monospace;
        }

        .error-section {
            background: #111119;
            padding: 25px 30px;
            border-bottom: 1px solid #1e1e2e;
        }

        .error-section:last-child {
            border-radius: 0 0 12px 12px;
        }

        .error-section h2 {
            font-size: 0.85em;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6366f1;
            margin-bottom: 15px;
        }

        .file-info {
            font-family: 'Fira Code', 'Consolas', monospace;
            font-size: 0.95em;
            color: #818cf8;
        }

        .file-info .line-number {
            color: #ef4444;
            font-weight: bold;
        }

        .stack-trace {
            font-family: 'Fira Code', 'Consolas', monospace;
            font-size: 0.8em;
            background: #08080d;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-word;
            color: #9ca3af;
            line-height: 1.8;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 140px 1fr;
            gap: 8px 20px;
        }

        .info-label {
            color: #6b7280;
            font-size: 0.85em;
        }

        .info-value {
            font-family: monospace;
            color: #818cf8;
            font-size: 0.9em;
        }

        .error-tip {
            background: #0a0a0f;
            padding: 15px 30px;
            font-size: 0.8em;
            color: #4b5563;
            border-radius: 0 0 12px 12px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-header">
            <span class="error-class"><?= e($class) ?></span>
            <h1><?= e($message) ?></h1>
        </div>

        <div class="error-section">
            <h2>Locatie</h2>
            <p class="file-info">
                <?= e($file) ?>:<span class="line-number"><?= $line ?></span>
            </p>
        </div>

        <div class="error-section">
            <h2>Request</h2>
            <div class="info-grid">
                <span class="info-label">Method</span>
                <span class="info-value"><?= e($method) ?></span>

                <span class="info-label">URI</span>
                <span class="info-value"><?= e($uri) ?></span>

                <span class="info-label">Tijd</span>
                <span class="info-value"><?= date('Y-m-d H:i:s') ?></span>

                <span class="info-label">PHP versie</span>
                <span class="info-value"><?= PHP_VERSION ?></span>
            </div>
        </div>

        <div class="error-section">
            <h2>Stack Trace</h2>
            <div class="stack-trace"><?= e($trace) ?></div>
        </div>

        <div class="error-tip">
            Deze pagina is alleen zichtbaar in development modus.
        </div>
    </div>
</body>
</html>