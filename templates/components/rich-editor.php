<?php
/**
 * @param string $name
 * @param string $label
 * @param string $value
 * @param string $placeholder
 * @param array  $errors
 */
$value       = $value ?? '';
$placeholder = $placeholder ?? '';
$errors      = $errors ?? [];
$editorId    = 'editor-' . $name;
?>

<div>
    <label class="block text-sm text-gray-400 mb-1.5"><?= e($label) ?></label>

    <div class="flex flex-wrap gap-1 bg-dark-900 border border-dark-600 border-b-0 rounded-t-lg px-3 py-2">
        <button type="button" data-cmd="bold" data-editor="<?= $editorId ?>" title="Vet" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 font-bold">B</button>
        <button type="button" data-cmd="italic" data-editor="<?= $editorId ?>" title="Cursief" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 italic">I</button>
        <button type="button" data-cmd="underline" data-editor="<?= $editorId ?>" title="Onderstrepen" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 underline">U</button>
        <button type="button" data-cmd="strikeThrough" data-editor="<?= $editorId ?>" title="Doorstrepen" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 line-through">S</button>
        <span class="w-px bg-dark-600 mx-1"></span>
        <button type="button" data-cmd="formatBlock" data-value="h2" data-editor="<?= $editorId ?>" title="Kop 2" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 text-xs">H2</button>
        <button type="button" data-cmd="formatBlock" data-value="h3" data-editor="<?= $editorId ?>" title="Kop 3" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 text-xs">H3</button>
        <button type="button" data-cmd="formatBlock" data-value="p" data-editor="<?= $editorId ?>" title="Paragraaf" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 text-xs">P</button>
        <span class="w-px bg-dark-600 mx-1"></span>
        <button type="button" data-cmd="insertUnorderedList" data-editor="<?= $editorId ?>" title="Ongeordende lijst" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 text-xs">• Lijst</button>
        <button type="button" data-cmd="insertOrderedList" data-editor="<?= $editorId ?>" title="Geordende lijst" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 text-xs">1. Lijst</button>
        <span class="w-px bg-dark-600 mx-1"></span>
        <button type="button" data-cmd="formatBlock" data-value="blockquote" data-editor="<?= $editorId ?>" title="Citaat" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 text-xs">&ldquo; Quote</button>
        <button type="button" data-cmd="removeFormat" data-editor="<?= $editorId ?>" title="Opmaak verwijderen" class="text-gray-400 px-2 py-1 rounded-md bg-transparent border-none cursor-pointer hover:bg-white/10 hover:text-white transition-colors duration-150 text-xs">&#10005; Clear</button>
    </div>

    <div id="<?= $editorId ?>"
         contenteditable="true"
         data-placeholder="<?= e($placeholder) ?>"
         class="rte-editor w-full bg-dark-900 border border-dark-600 text-white rounded-b-lg px-4 py-2.5 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors duration-200 min-h-[300px] overflow-y-auto prose prose-invert max-w-none prose-headings:font-bold prose-h2:text-2xl prose-h3:text-xl prose-blockquote:border-l-[3px] prose-blockquote:border-indigo-500 prose-blockquote:pl-4 prose-blockquote:text-gray-400 prose-a:text-indigo-400 prose-a:underline prose-ul:list-disc prose-ul:pl-6 prose-ol:list-decimal prose-ol:pl-6 empty:before:content-[attr(data-placeholder)] empty:before:text-gray-500 empty:before:pointer-events-none"
    ><?= $value ?></div>

    <input type="hidden" id="<?= $name ?>" name="<?= $name ?>" value="<?= e($value) ?>">

    <?php if (isset($errors[$name])): ?>
        <p class="text-red-400 text-sm mt-1.5"><?= e($errors[$name][0]) ?></p>
    <?php endif; ?>

</div>

<script src="/assets/js/rich-editor.js"></script>
