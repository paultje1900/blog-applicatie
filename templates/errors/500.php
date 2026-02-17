<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0a0a0f;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #9ca3af;
        }
        .container { text-align: center; }
        h1 {
            font-size: 4rem;
            font-weight: bold;
            color: #6366f1;
            margin-bottom: 1rem;
        }
        .message {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #9ca3af;
        }
        .sub {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }
        a {
            color: #818cf8;
            text-decoration: none;
            transition: color 0.2s;
        }
        a:hover { color: #a5b4fc; }
    </style>
</head>
<body>
    <div class="container">
        <h1>500</h1>
        <p class="message">Er ging iets mis</p>
        <p class="sub">Er is een serverfout opgetreden. Probeer het later opnieuw.</p>
        <a href="/">← Terug naar home</a>
    </div>
</body>
</html>