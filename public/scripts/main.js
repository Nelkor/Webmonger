$(function () {
    var load_time = 0;

    // Валидация и обработка объекта с html и url
    var load = function (data, receiver) {
        if (data.response == 'ok' && data.content) {
            receiver.html(data.content.html);

            history.pushState(null, null, '/' + data.content.url);
        }
    };

    // Перемещение по истории браузера
    $(window).on('popstate', function () {
        $.get(location.pathname, 'ajax', function (data) {
            load(data, $('#main'));
        }, 'json');
    });

    $('body') // обработка событий body

    // Загрузка контента в любой элемент
    .on('click', '.load', function () {
        var button = $(this);

        var receiver = $('#' + button.data('receiver'));
        var sender = button.data('sender');

        if ( ! receiver.length || Date.now() < load_time + 5000) {
            return;
        }

        load_time = Date.now();

        $.get('/' + sender, 'ajax', function (data) {
            load(data, receiver);

            load_time = 0;
        }, 'json');
    })

    ;// Конец обработки событий body
});
