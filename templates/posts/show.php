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

     <section class="mt-10" id="comments">
        <h2 class="text-2xl font-bold text-white mb-6">
            Reacties (<?= count($comments) ?>)
        </h2>

        <!-- Bestaande reacties -->
        <?php if (empty($comments)): ?>
            <p class="text-gray-500 italic">Nog geen reacties. Wees de eerste!</p>
        <?php else: ?>
            <div id="comments-list" class="space-y-6">
                <?php foreach ($comments as $comment): ?>
                    <div class="py-4 border-b border-dark-600">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-gray-300 font-bold"><?= e($comment['username']) ?></span>
                            <time class="text-sm text-gray-500" datetime="<?= $comment['created_at'] ?>">
                                <?= date('j M Y \o\m H:i', strtotime($comment['created_at'])) ?>
                            </time>
                        </div>
                        <p class="text-gray-300 leading-relaxed"><?= nl2br(e($comment['body'])) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($user): ?>
            <div class="mt-8" id="comment-form-wrapper">
                <h3 class="text-lg font-medium text-white mb-4">Plaats een reactie</h3>

                <div id="comment-errors" class="hidden mb-4 border-l-4 px-4 py-3 rounded-lg bg-red-500/10 border-red-500/30 text-red-400"></div>

                <form id="comment-form" method="POST" action="/posts/<?= $post['id'] ?>/comments">
                    <?= csrfField() ?>
                    <div class="mb-4">
                        <textarea
                            name="body"
                            id="comment-body"
                            rows="4"
                            placeholder="Schrijf je reactie..."
                            class="w-full bg-dark-800 border border-dark-600 rounded-lg px-4 py-3 text-gray-300 placeholder-gray-500 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors duration-200"
                            required
                        ><?= e(old('body')) ?></textarea>
                    </div>
                    <button type="submit"
                            class="bg-accent-500 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-accent-600 transition-colors duration-200">
                        Reageer
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="mt-8 p-6 text-center">
                <p class="text-gray-400">
                    <a href="/login" class="text-accent-400 hover:text-white transition-colors duration-200">Log in</a>
                    om een reactie te plaatsen.
                </p>
            </div>
        <?php endif; ?>
    </section>
</div>

<script src="/assets/js/comments.js"></script>