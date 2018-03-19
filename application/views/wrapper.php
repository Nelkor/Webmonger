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
    <script><?php include 'public/scripts/main.js'; ?></script>
</head>
<body>
    <div id="main" class="container"><?= $page ?? '' ?></div>
</body>
</html>