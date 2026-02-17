<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog applicatie - Lemone</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="bg-dark-900 text-gray-300 min-h-screen flex flex-col antialiased">

    <?php include __DIR__ . '/../components/navbar.php'; ?>

    <?php include __DIR__ . '/../components/flash-messages.php'; ?>

    <main class="flex-grow container mx-auto px-6 py-10">
        <?= $content ?>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>

</body>
</html>