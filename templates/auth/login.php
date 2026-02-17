<h2 class="text-xl font-bold text-white mb-6 text-center">Inloggen</h2>

<?php if ($error = \App\Core\Session::getFlash('error')): ?>
    <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg mb-6 text-sm">
        <?= e($error) ?>
    </div>
<?php endif; ?>

<?php $errors = \App\Core\Session::getFlash('errors') ?? []; ?>

<form method="POST" action="/login" class="space-y-5">
    <?= csrfField() ?>

    <?php component('input', [
        'name'        => 'email',
        'label'       => 'Emailadres',
        'type'        => 'email',
        'placeholder' => 'naam@voorbeeld.nl',
        'value'       => old('email'),
        'errors'      => $errors,
    ]) ?>

    <?php component('input', [
        'name'        => 'password',
        'label'       => 'Wachtwoord',
        'type'        => 'password',
        'placeholder' => 'wachtwoord',
        'password'    => true,
        'errors'      => $errors,
    ]) ?>

    <?php component('button', ['text' => 'Inloggen']) ?>
</form>

<p class="text-center text-sm text-gray-500 mt-6">
    Nog geen account? <a href="/register" class="text-accent-400 hover:text-accent-300 transition-colors duration-200">Registreer</a>
</p>