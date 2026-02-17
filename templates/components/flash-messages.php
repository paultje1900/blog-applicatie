<?php
$types = [
    'success' => 'bg-green-500/10 border-green-500/30 text-green-400',
    'error'   => 'bg-red-500/10 border-red-500/30 text-red-400',
    'warning' => 'bg-yellow-500/10 border-yellow-500/30 text-yellow-400',
];

foreach ($types as $type => $classes):
    $message = \App\Core\Session::get($type);
    if ($message):
        \App\Core\Session::delete($type);
?>
    <div class="container mx-auto px-6 mt-4">
        <div class="border-l-4 px-4 py-3 rounded-lg <?= $classes ?>">
            <?= e($message) ?>
        </div>
    </div>
<?php
    endif;
endforeach;
?>