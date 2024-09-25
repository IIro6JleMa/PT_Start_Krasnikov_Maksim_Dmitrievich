<?php
require_once('bd.php');
$link = mysqli_connect('127.0.0.1', 'root', 'maks', 'first');

if (isset($_POST['submit'])) {
    // Удаляем пробелы в начале и конце строки
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Выводим значения логина и пароля для проверки
    echo "Логин: " . htmlspecialchars($username) . "<br>";
    echo "Пароль: " . htmlspecialchars($password) . "<br>";

    // Используем подготовленный запрос
    $stmt = mysqli_prepare($link, "SELECT * FROM users WHERE username = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Добавляем вывод количества строк, найденных в запросе
    $num_rows = mysqli_num_rows($result);
    echo "Количество найденных строк: " . $num_rows . "<br>";

    if ($num_rows == 1) {
        setcookie("User", $username, time() + 7200); // Кука на 2 часа
        header('Location: profile.php');
    } else {
        echo "Неправильный логин или пароль.<br>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
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
    <form method="POST" action="login.php">
        <label for="username">Логин:</label>
        <input type="text" name="username" required><br>

        <label for="password">Пароль:</label>
        <input type="password" name="password" required><br>

        <button type="submit" name="submit">Войти</button>
    </form>
</body>
</html>
