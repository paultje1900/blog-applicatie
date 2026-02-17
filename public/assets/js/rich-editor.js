document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('mousedown', (e) => {
        if (e.target.closest('[data-cmd]')) {
            e.preventDefault();
        }
    });

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-cmd]');
        if (!btn) return;

        const cmd = btn.dataset.cmd;
        const value = btn.dataset.value || null;

        if (cmd === 'removeFormat') {
            document.execCommand('removeFormat', false, null);
            document.execCommand('unlink', false, null);
            document.execCommand('formatBlock', false, '<p>');
        } else if (cmd === 'formatBlock' && value) {
            document.execCommand('formatBlock', false, '<' + value + '>');
        } else {
            document.execCommand(cmd, false, value);
        }
    });

    document.addEventListener('submit', (e) => {
        e.target.querySelectorAll('.rte-editor').forEach((editor) => {
            const id = editor.id.replace('editor-', '');
            const hidden = document.getElementById(id);
            if (hidden) {
                hidden.value = editor.innerHTML;
            }
        });
    });
});