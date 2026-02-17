<?php
/**
 * @param string $text
 * @param string $variant
 * @param string $type
 */
$variant = $variant ?? 'primary';
$type    = $type ?? 'submit';

$classes = match ($variant) {
    'primary'   => 'bg-accent-500 hover:bg-accent-600 text-white',
    'secondary' => 'bg-dark-600 hover:bg-dark-500 text-gray-300',
    'danger'    => 'bg-red-500/20 hover:bg-red-500/30 text-red-400 border border-red-500/30',
};
?>

<button type="<?= $type ?>"
        class="w-full <?= $classes ?> font-medium py-2.5 rounded-lg transition-colors duration-200">
    <?= e($text) ?>
</button>