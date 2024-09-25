<?php
require_once('bd.php');  // Подключаем файл для работы с БД

// Проверяем подключение к базе данных
$link = mysqli_connect('127.0.0.1', 'root', 'password', 'first');
if (!$link) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $main_text = trim($_POST['text']);

    // Проверка на заполнение полей
    if (!$title || !$main_text) {
        die("Заполните все поля.");
    }

    // Добавляем отладку SQL-запроса
    $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$main_text')";
    if (!mysqli_query($link, $sql)) {
        die("Не удалось добавить пост: " . mysqli_error($link));
    } else {
        echo "Пост успешно добавлен!";
    }
}

// Закрываем соединение с базой данных
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Красников М.Д.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Навигационная панель -->
    <div class="container-fluid bg-dark text-white py-3">
        <div class="row">
            <div class="col-3 text-center">
                <div class="nav_logo">
                    <img src="logo.jpg" alt="Логотип" class="img-fluid" width="80">
                </div>
            </div>
            <div class="col-9 d-flex align-items-center justify-content-end">
                <div class="nav_text">
                    <h3>Обо мне</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Основной контент -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-8">
                <h2 class="text-uppercase">Красников Максим Дмитриевич</h2>
                <p class="lead">Специалист по сетевой безопасности и защите данных</p>
                <p>
                    Занимаюсь разработкой и внедрением решений для защиты информации. Обладаю глубокими знаниями в сфере кибербезопасности, сетевых технологий и системного администрирования. Моя цель — создать безопасные системы для бизнеса и пользователей, минимизируя угрозы и риски.
                </p>
                <p>
                    На данный момент я активно изучаю современные методы защиты от атак и развиваю навыки работы с SOC. Я уверен, что будущее за защитой данных, и стремлюсь внести свой вклад в эту область.
                </p>
                <button id="toggle-btn" class="btn btn-primary my-4">Показать другую картинку</button>

                <!-- Форма для создания постов -->
                <form method="POST" action="profile.php" class="form my-4">
                    <h3>Создать пост</h3>
                    <input type="text" name="title" placeholder="Заголовок поста" class="form-control my-2" required>
                    <textarea name="text" rows="5" placeholder="Текст поста" class="form-control my-2" required></textarea>
                    <button type="submit" name="submit" class="btn btn-primary">Опубликовать</button>
                </form>
            </div>
            <div class="col-4 text-center">
                <div class="profile_photo">
                    <img id="profile-photo" src="photo.jpg" alt="Фото Красникова Максима" class="rounded-circle img-fluid shadow-lg" width="200">
                    <p class="mt-3 title_photo">Красников М.Д.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 bg-dark text-white">
        <p>&copy; 2024 Красников М.Д. Все права защищены.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="button.js"></script>

</body>
</html>
