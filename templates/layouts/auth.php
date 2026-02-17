<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - applicatie</title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="bg-dark-900 min-h-screen flex items-center justify-center antialiased">

    <div class="w-full max-w-md px-6">
        <div class="text-center mb-8">
            <a href="/" class="text-2xl font-bold text-white tracking-tight">
                Blog<span class="text-accent-400">.</span>
            </a>
        </div>

        <div class="bg-dark-800 border border-dark-600 rounded-xl p-8">
            <?= $content ?>
        </div>
    </div>

    <script src="/assets/js/password-toggle.js"></script>
</body>
</html>