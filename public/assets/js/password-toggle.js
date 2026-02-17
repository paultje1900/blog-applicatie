document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-toggle-password]').forEach(button => {
        button.addEventListener('click', () => {
            const input = button.closest('.relative').querySelector('input');
            if (!input) return;

            const isHidden = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';
            button.setAttribute('aria-label', isHidden ? 'Wachtwoord verbergen' : 'Wachtwoord tonen');
            button.querySelector('.eye-open').classList.toggle('hidden', isHidden);
            button.querySelector('.eye-closed').classList.toggle('hidden', !isHidden);
        });
    });
});