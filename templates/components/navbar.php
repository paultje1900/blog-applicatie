<nav class="bg-dark-800 border-b border-dark-600">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <a href="/" class="text-xl font-bold text-white tracking-tight">
            Blog<span class="text-accent-400">.</span>
        </a>

        <div class="flex items-center gap-5">
            <?php if (\App\Core\Auth::check()): ?>
                <span class="text-gray-400 text-sm">
                    <?= e(\App\Core\Auth::user()['username']) ?>
                </span>
                <form method="POST" action="/logout">
                    <?= csrfField() ?>
                    <button type="submit" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">
                        Uitloggen
                    </button>
                </form>
            <?php else: ?>
                <a href="/login" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">
                    Inloggen
                </a>
                <a href="/register" class="text-sm bg-accent-500 hover:bg-accent-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                    Registreren
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>