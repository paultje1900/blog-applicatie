<div class="max-w-3xl mx-auto">
    <a href="/" class="text-gray-500 hover:text-gray-300 text-sm transition-colors duration-200 mb-6 inline-block">
        ← Terug naar overzicht
    </a>

    <div class="bg-dark-800 border border-dark-600 rounded-xl p-8">
        <h1 class="text-2xl font-bold text-white mb-6">Nieuwe post</h1>

        <?php $errors = \App\Core\Session::getFlash('errors') ?? []; ?>

        <form method="POST" action="/posts" class="space-y-5">
            <?= csrfField() ?>

            <?php component('input', [
                'name'        => 'title',
                'label'       => 'Titel',
                'placeholder' => 'Geef je post een titel...',
                'value'       => old('title'),
                'errors'      => $errors,
            ]) ?>

            <?php component('rich-editor', [
                'name'        => 'body',
                'label'       => 'Inhoud',
                'placeholder' => 'Schrijf je post...',
                'value'       => old('body'),
                'errors'      => $errors,
            ]) ?>

            <?php component('button', ['text' => 'Post publiceren']) ?>
        </form>
    </div>
</div>