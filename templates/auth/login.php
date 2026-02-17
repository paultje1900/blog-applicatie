<h2 class="text-xl font-bold text-white mb-6 text-center">Inloggen</h2>

<?php if ($error = \App\Core\Session::getFlash('error')): ?>
    <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg mb-6 text-sm">
        <?= e($error) ?>
    </div>
<?php endif; ?>

<?php $errors = \App\Core\Session::getFlash('errors') ?? []; ?>

<form method="POST" action="/login" class="space-y-5">
    <?= csrfField() ?>

    <div>
        <label for="email" class="block text-sm text-gray-400 mb-1.5">Emailadres</label>
        <input type="email"
               id="email"
               name="email"
               value="<?= e(old('email')) ?>"
               required
               class="w-full bg-dark-900 border border-dark-600 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors duration-200 placeholder-gray-500"
               placeholder="naam@voorbeeld.nl">
        <?php if (isset($errors['email'])): ?>
            <p class="text-red-400 text-sm mt-1.5"><?= e($errors['email'][0]) ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label for="password" class="block text-sm text-gray-400 mb-1.5">Wachtwoord</label>
        <div class="relative">
            <input type="password"
                   id="password"
                   name="password"
                   required
                   class="w-full bg-dark-900 border border-dark-600 text-white rounded-lg px-4 py-2.5 pr-11 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors duration-200"
                   placeholder="wachtwoord">
            <button type="button"
                    data-toggle-password="password"
                    aria-label="Wachtwoord tonen"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition-colors duration-200">
                <svg class="eye-open w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <svg class="eye-closed w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>
            </button>
        </div>
        <?php if (isset($errors['password'])): ?>
            <p class="text-red-400 text-sm mt-1.5"><?= e($errors['password'][0]) ?></p>
        <?php endif; ?>
    </div>

    <button type="submit"
            class="w-full bg-accent-500 hover:bg-accent-600 text-white font-medium py-2.5 rounded-lg transition-colors duration-200">
        Inloggen
    </button>
</form>

<p class="text-center text-sm text-gray-500 mt-6">
    Nog geen account? <a href="/register" class="text-accent-400 hover:text-accent-300 transition-colors duration-200">Registreer</a>
</p>