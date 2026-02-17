document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('comment-form');
    if (!form) return;

    const commentsList = document.getElementById('comments-list');
    const errorsDiv = document.getElementById('comment-errors');
    const bodyInput = document.getElementById('comment-body');
    const postId = form.action.match(/\/posts\/(\d+)\/comments/)[1];

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        errorsDiv.classList.add('hidden');
        errorsDiv.textContent = '';

        const formData = new FormData(form);

        fetch(`/api/posts/${postId}/comments`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function (response) {
            return response.json().then(function (data) {
                return { ok: response.ok, status: response.status, data: data };
            });
        })
        .then(function (result) {
            if (!result.ok) {
                if (result.data.errors) {
                    var messages = [];
                    for (var field in result.data.errors) {
                        result.data.errors[field].forEach(function (msg) {
                            messages.push(msg);
                        });
                    }
                    errorsDiv.innerHTML = messages
                        .map(function (m) { return '<p>' + escapeHtml(m) + '</p>'; })
                        .join('');
                } else if (result.data.error) {
                    errorsDiv.textContent = result.data.error;
                }
                errorsDiv.classList.remove('hidden');
                return;
            }

            var comment = result.data;

            if (!commentsList) {
                var emptyMsg = document.querySelector('#comments .italic');
                if (emptyMsg) emptyMsg.remove();

                var newList = document.createElement('div');
                newList.id = 'comments-list';
                newList.className = 'space-y-6';

                var section = document.getElementById('comments');
                var formWrapper = document.getElementById('comment-form-wrapper');
                section.insertBefore(newList, formWrapper);

                addCommentToList(newList, comment);
            } else {
                addCommentToList(commentsList, comment);
            }

            updateCommentCount();

            bodyInput.value = '';
        })
        .catch(function () {
            errorsDiv.textContent = 'Er ging iets mis. Probeer het opnieuw.';
            errorsDiv.classList.remove('hidden');
        });
    });

    function addCommentToList(list, comment) {
        var div = document.createElement('div');
        div.className = 'py-4 border-b border-dark-600';

        var date = new Date(comment.created_at);
        var formatted = formatDate(date);

        div.innerHTML =
            '<div class="flex items-center justify-between mb-4">' +
                '<span class="text-gray-300 font-bold">' + escapeHtml(comment.author) + '</span>' +
                '<time class="text-sm text-gray-500" datetime="' + escapeHtml(comment.created_at) + '">' +
                    escapeHtml(formatted) +
                '</time>' +
            '</div>' +
            '<p class="text-gray-300 leading-relaxed">' + escapeHtml(comment.content).replace(/\n/g, '<br>') + '</p>';

        list.appendChild(div);

        div.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function updateCommentCount() {
        var heading = document.querySelector('#comments h2');
        if (!heading) return;

        var list = document.getElementById('comments-list');
        var count = list ? list.children.length : 0;
        heading.textContent = 'Reacties (' + count + ')';
    }

    function formatDate(date) {
        var months = ['jan', 'feb', 'mrt', 'apr', 'mei', 'jun',
                       'jul', 'aug', 'sep', 'okt', 'nov', 'dec'];
        var day = date.getDate();
        var month = months[date.getMonth()];
        var year = date.getFullYear();
        var hours = String(date.getHours()).padStart(2, '0');
        var minutes = String(date.getMinutes()).padStart(2, '0');
        return day + ' ' + month + ' ' + year + ' om ' + hours + ':' + minutes;
    }

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }
});