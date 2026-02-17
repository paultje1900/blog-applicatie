<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-white">Blog Posts</h1>
        <?php if ($user): ?>
            <a href="/posts/create" title="Nieuwe post" class="text-gray-500 hover:text-white transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>
        <?php endif; ?>
    </div>

    <?php if (empty($posts)): ?>
        <div class="p-12 text-center">
            <p class="text-gray-400 text-lg mb-2">Nog geen posts</p>
            <p class="text-gray-500 text-sm">Wees de eerste die een post schrijft!</p>
        </div>
    <?php else: ?>
        <div class="space-y-6">
            <?php foreach ($posts as $post): ?>
                <?php component('post-card', ['post' => $post]) ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>