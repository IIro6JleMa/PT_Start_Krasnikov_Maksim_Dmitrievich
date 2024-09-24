<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1 class="mb-4">Добро пожаловать!</h1>
                
                <?php
                // Проверка наличия куки "User"
                if (!isset($_COOKIE['User'])) {
                ?>
                    <p class="lead mb-4">Чтобы продолжить, вам нужно авторизоваться</p>
                    <a href="/registration.php" class="btn btn-primary btn-lg">Зарегистрироваться</a>
                    <span class="mx-2">или</span>
                    <a href="/login.php" class="btn btn-secondary btn-lg">Войти</a>
                <?php
                } else {
                    // Пользователь авторизован
                    echo '<div class="alert alert-success" role="alert">';
                    echo '<h4 class="alert-heading">Добро пожаловать, ' . htmlspecialchars($_COOKIE['User']) . '!</h4>';
                    echo '<p>Вы успешно вошли в систему.</p>';
                    echo '<hr>';
                    echo '<p class="mb-0">Продолжайте пользоваться нашим сайтом.</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
