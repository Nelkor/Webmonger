<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webmonger</title>
    <link rel="shortcut icon" href="/public/images/logo.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style><?php include 'public/styles/main.css'; ?></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script><?php include 'public/scripts/main.js'; ?></script>
</head>
<body class="d-flex flex-column">
    <nav class="navbar navbar-expand-sm navbar-dark">
        <span class="navbar-brand load" data-sender="" data-receiver="main">Webmonger</span>
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="nav-link load" data-sender="downloads" data-receiver="main">Загрузки</span>
            </li>
            <li class="nav-item">
                <span class="nav-link load" data-sender="guides" data-receiver="main">Гайды</span>
            </li>
            <li class="nav-item">
                <span class="nav-link load" data-sender="contacts" data-receiver="main">Контакты</span>
            </li>
        </ul>
    </nav>
    <div id="main" class="container"><?= $page ?? '' ?></div>
    <footer class="page-footer font-small stylish-color-dark">
        <div class="footer-copyright py-3 text-center">© <?= date('d.m.Y') ?> Webmonger</div>
    </footer>
</body>
</html>