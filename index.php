<?php
// Подключаемся к базе данных
$link = mysqli_connect('127.0.0.1', 'root', 'maks', 'first');

// Проверяем подключение
if (!$link) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}
?>

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
                    // Пользователь авторизован, выводим приветствие
                    echo '<div class="alert alert-success" role="alert">';
                    echo '<h4 class="alert-heading">Добро пожаловать, ' . htmlspecialchars($_COOKIE['User']) . '!</h4>';
                    echo '<p>Вы успешно вошли в систему.</p>';
                    echo '<hr>';
                    echo '<p class="mb-0">Продолжайте пользоваться нашим сайтом.</p>';
                    echo '</div>';

                    // Получаем записи из таблицы posts
                    $sql = "SELECT * FROM posts";
                    $res = mysqli_query($link, $sql);

                    // Если есть записи, выводим список
                    if (mysqli_num_rows($res) > 0) {
                        echo '<h3 class="mt-4">Доступные статьи:</h3>';
                        echo '<ul class="list-group">';
                        while ($post = mysqli_fetch_array($res)) {
                            echo "<li class='list-group-item'><a href='/posts.php?id=" . $post["id"] . "'>" . htmlspecialchars($post['title']) . "</a></li>";
                        }
                        echo '</ul>';
                    } else {
                        echo "<p class='mt-4'>Записей пока нет.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Закрываем подключение к базе данных
mysqli_close($link);
?>
