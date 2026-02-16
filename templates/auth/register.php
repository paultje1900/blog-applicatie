<div class="auth-container">
    <h1>Registreren</h1>

    <?php if ($error = \App\Core\Session::getFlash('error')): ?>
        <div class="alert alert-error">
            <?= e($error) ?>
        </div>
    <?php endif; ?>

    <?php $errors = \App\Core\Session::getFlash('errors') ?? []; ?>

    <form method="POST" action="/register">
        <?= csrfField() ?>

        <div class="form-group">
            <label for="username">Gebruikersnaam</label>
            <input type="text"
                   id="username"
                   name="username"
                   value="<?= e(old('username')) ?>"
                   required>
            <?php if (isset($errors['username'])): ?>
                <span class="error"><?= e($errors['username'][0]) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Emailadres</label>
            <input type="email"
                   id="email"
                   name="email"
                   value="<?= e(old('email')) ?>"
                   required>
            <?php if (isset($errors['email'])): ?>
                <span class="error"><?= e($errors['email'][0]) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Wachtwoord</label>
            <input type="password"
                   id="password"
                   name="password"
                   required>
            <?php if (isset($errors['password'])): ?>
                <span class="error"><?= e($errors['password'][0]) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn">Registreren</button>
    </form>

    <p class="auth-link">
        Heb je al een account? <a href="/login">Log dan hier in</a>
    </p>
</div>