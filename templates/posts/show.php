<div class="max-w-3xl mx-auto">
    <a href="/" class="text-gray-500 hover:text-gray-300 text-sm transition-colors duration-200 mb-8 inline-block">
        ← Terug naar overzicht
    </a>

    <article>
        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-white leading-tight tracking-tight mb-4"><?= e($post['title']) ?></h1>
            <div class="flex items-center justify-between text-sm text-gray-500">
                <div class="flex items-center gap-4">
                    <span>Door <span class="text-gray-300 font-medium"><?= e($post['username']) ?></span></span>
                    <span>·</span>
                    <time datetime="<?= $post['created_at'] ?>">
                        <?= date('j M Y \o\m H:i', strtotime($post['created_at'])) ?>
                    </time>
                </div>

                <?php if ($user && $user['id'] === $post['user_id']): ?>
                    <div class="flex items-center gap-2">
                        <a href="/posts/<?= $post['id'] ?>/edit" title="Bewerken" class="text-gray-500 hover:text-white transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                            </svg>
                        </a>
                        <form method="POST" action="/posts/<?= $post['id'] ?>/delete"
                              onsubmit="return confirm('Weet je zeker dat je deze post wilt verwijderen?')">
                            <?= csrfField() ?>
                            <button type="submit" title="Verwijderen" class="text-gray-500 hover:text-red-400 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </header>

        <hr class="border-dark-600 mb-8">

        <!-- Body -->
        <div class="prose prose-invert max-w-none prose-headings:text-white prose-a:text-accent-400 prose-blockquote:border-accent-500 prose-strong:text-white leading-relaxed">
            <?= $post['body'] ?>
        </div>
    </article>
</div>