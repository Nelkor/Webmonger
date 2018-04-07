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

    // АВТОРИЗАЦИЯ
    .on('click', '#btn-auth', function () {
        var auth = $('#auth');

        if (auth.is(':visible')) {
            auth.slideUp();
        } else {
            auth.slideDown();

            $('#reg').slideUp();
        }
    })

    // регистрация
    .on('click', '#btn-reg', function () {
        var reg = $('#reg');

        if (reg.is(':visible')) {
            reg.slideUp();
        } else {
            reg.slideDown();

            $('#auth').slideUp();
        }
    })

    .on('blur', '#reg input', function () {
        var value = $(this).val();
        var which = $(this).data('reg');
        var hint = $('#' + which + '-hint');

        if ( ! value) {
            return hint.slideUp();
        }

        switch (which) {
            case 'name':
                $.get('/auth/check_name', 'ajax&name=' + value, function (data) {
                    if (data.response == 'ok' && data.content) {
                        if (data.content.good_name) {
                            hint.removeClass('text-danger').addClass('text-success').html('Отличное имя!');
                        } else {
                            switch (data.content.reason) {
                                case 'unfit':
                                    hint.html('Недопустимый формат!');
                                    break;
                                case 'taken':
                                    hint.html('Это имя уже занято :(');
                            }

                            hint.removeClass('text-success').addClass('text-danger');
                        }
                    }

                    hint.slideDown();
                }, 'json');

                break;
            case 'gmail':
                $.get('/auth/check_email', 'ajax&gmail=' + value, function (data) {
                    if (data.response == 'ok' && data.content) {
                        if (data.content.good_email) {
                            hint.removeClass('text-danger').addClass('text-success').html('Подходящая почта!');
                        } else {
                            switch (data.content.reason) {
                                case 'unfit':
                                    hint.html('Нужен ...@gmail.com');
                                    break;
                                case 'taken':
                                    hint.html('Эта почта уже занята :(');
                            }

                            hint.removeClass('text-success').addClass('text-danger');
                        }
                    }

                    hint.slideDown();
                }, 'json');

                break;
            case 'pass':
                if (value.length < 6) {
                    hint.removeClass('text-success').addClass('text-danger').html('Хотя бы 6 символов : )');
                } else {
                    hint.removeClass('text-danger').addClass('text-success').html('Надёжный пароль!');
                }

                hint.slideDown();

                hint = $('#repeat-hint');
                value = $('#reg-repeat').val();
            case 'repeat':
                var pass = $('#reg-pass').val();

                if (value == pass) {
                    hint.removeClass('text-danger').addClass('text-success').html('Пароли совпадают!');
                } else {
                    hint.removeClass('text-success').addClass('text-danger').html('Пароли не совпадают!');
                }

                if (value) {
                    hint.slideDown();
                }

                break;
        }
    })

    .on('click', '#reg button', function () {
        var name = $('#reg-name').val();
        var pass = $('#reg-pass').val();
        var gmail = $('#reg-gmail').val();

        if (name && pass && gmail) {
            $.post('/reg?ajax', {name: name, pass: pass, gmail: gmail}, function (data) {
                if (data.response == 'ok') {
                    if (data.content.success) {
                        $('#auth-reg').html(data.content.html);
                    } else {
                        var hint = $('#reg-hint');

                        switch (data.content.reason) {
                            case 'bad data':
                                hint.html('Форма заполнена неверно :(');
                                break;
                            case 'insert':
                                hint.html('Неизвестная ошибка :(');
                                break;
                        }

                        hint.slideDown();
                    }
                }
            }, 'json');
        }
    })

    .on('blur', '#reg button', function () {
        $('#reg-hint').slideUp();
    })

    .on('click', '#auth button', function () {
        var name = $('#auth-name').val();
        var pass = $('#auth-pass').val();

        if (name && pass) {
            $.post('/auth?ajax', {name: name, pass: pass}, function (data) {
                if (data.response == 'ok') {
                    if (data.content.success) {
                        $('#auth-reg').html(data.content.html);
                    } else {
                        var hint = $('#auth-hint');

                        switch (data.content.reason) {
                            case 'frequency':
                                hint.html('Слишком частые попытки :(');
                                break;
                            case 'name':
                                console.log('name');
                                hint.html('Такого имени не существует :(');
                                break;
                            case 'password':
                                console.log('password');
                                hint.html('Пароль введён неверно :(');
                                break;
                        }

                        hint.slideDown();
                    }
                }
            }, 'json');
        }
    })

    .on('blur', '#auth button', function () {
        $('#auth-hint').slideUp();
    })

    .on('click', '#btn-leave', function () {
        $.post('/leave?ajax', function (data) {
            if (data.response == 'ok') {
                $('#auth-reg').html(data.content.html);
            }
        }, 'json');
    })

    ;// Конец обработки событий body
});