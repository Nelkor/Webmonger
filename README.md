Авторизация

Прописываем пути к 5 методам контроллера users:
1. checkName
2. checkEmail
3. reg
4. auth
5. leave

Реализация методов остаётся всегда примерно одинаковой, за исключением возвращаемых значений.

Если после авторизации необходимо перейти на "path", то пишем так:

$router = new Router;
$router->run('path');

А в обработчике, например, так:

$.post('/api/auth?ajax', {name: name, pass: pass}, function (data) {
    load(data, $('#main'));

    if (data.response == 'denied') {
        var info = $('#auth-info');

        switch (data.content.reason) {
            case 'wrong name':
                info.html('Имя указано неверно!');
                break;
            case 'wrong password':
                info.html('Пароль указан неверно!');
                break;
        }
    }
}, 'json');
