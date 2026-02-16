<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Niet toegestaan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #333;
        }

        .error-page {
            text-align: center;
            padding: 40px;
        }

        .error-code {
            font-size: 6em;
            font-weight: bold;
            color: #e74c3c;
            line-height: 1;
        }

        .error-title {
            font-size: 1.5em;
            margin: 20px 0 10px;
            color: #333;
        }

        .error-message {
            color: #777;
            margin-bottom: 30px;
            max-width: 400px;
        }

        .error-link {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 12px 30px;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .error-link:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="error-page">
        <div class="error-code">403</div>
        <h1 class="error-title">Niet toegestaan</h1>
        <p class="error-message">
            Je hebt geen toestemming voor deze actie.
            Ververs de pagina en probeer het opnieuw.
        </p>
        <a href="/" class="error-link">Terug naar home</a>
    </div>
</body>
</html>