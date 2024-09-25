<?php
// Подключаем файл для работы с базой данных
require_once('bd.php');

// Подключаемся к базе данных
$link = mysqli_connect('127.0.0.1', 'root', 'maks', 'first');

// Проверка, отправлена ли форма
if (isset($_POST['submit'])) {
    // Получаем значения из полей формы
    $email = $_POST['email'];
    $username = $_POST['login'];  // Заменил имя поля с 'login'
    $password = $_POST['password'];

    // Проверка на заполненность полей
    if (!$email || !$username || !$password) {
        die('Пожалуйста, введите все значения!');
    }

    // SQL-запрос для добавления пользователя в базу данных
    $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";

    // Выполняем запрос и проверяем на наличие ошибок
    if (!mysqli_query($link, $sql)) {
        echo "Не удалось добавить пользователя: " . mysqli_error($link);
    } else {
        echo "Пользователь успешно зарегистрирован!";
    }
}

// Закрываем подключение к базе данных
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
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Регистрация</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Форма для регистрации -->
                <form method="POST" action="registration.php">
                    <div class="row form__reg">
                        <input class="form-control" type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="row form__reg">
                        <input class="form-control" type="text" name="login" placeholder="Login" required>
                    </div>
                    <div class="row form__reg">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn_red btn__reg" name="submit">Продолжить</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
