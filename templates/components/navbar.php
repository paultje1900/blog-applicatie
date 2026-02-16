<nav>
    <a href="/">Home</a>

    <?php if (\App\Core\Auth::check()): ?>
        <span>Welkom, <?= htmlspecialchars(\App\Core\Auth::user()['username']) ?>!</span>
        <form method="POST" action="/logout" style="display:inline;">
            <?= csrfField() ?>
            <button type="submit">Uitloggen</button>
        </form>
    <?php else: ?>
        <a href="/login">Inloggen</a>
        <a href="/register">Registreren</a>
    <?php endif; ?>
</nav>