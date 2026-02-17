<?php
/**
 * @param array $post
 */
?>

<article class="group">
    <a href="/posts/<?= $post['id'] ?>" class="block py-6 border-b border-dark-600 transition-colors duration-200">
        <h2 class="text-xl font-bold text-white mb-2 group-hover:text-accent-400 transition-colors duration-200">
            <?= e($post['title']) ?>
        </h2>
        <div class="flex items-center justify-between text-sm text-gray-500">
            <span>Door <span class="text-gray-300"><?= e($post['username']) ?></span></span>
            <time datetime="<?= $post['created_at'] ?>">
                <?= date('j M Y', strtotime($post['created_at'])) ?>
            </time>
        </div>
    </a>
</article>