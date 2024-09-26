<?php
require_once('bd.php');
$link = mysqli_connect('127.0.0.1', 'root', 'maks', 'first');

if (isset($_POST['submit'])) {
    // Удаляем пробелы в начале и конце строки
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Выводим значения логина и пароля без экранирования (уязвимо для XSS)
    echo "Логин: " . $username . "<br>"; // Уязвимо для XSS
    echo "Пароль: " . $password . "<br>"; // Уязвимо для XSS

    // Выполняем обычный запрос, уязвимый для SQL-инъекций
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($link, $sql);

    // Добавляем вывод количества строк, найденных в запросе
    $num_rows = mysqli_num_rows($result);
    echo "Количество найденных строк: " . $num_rows . "<br>";

    if ($num_rows > 0) {
        // Выводим все строки, найденные запросом
        echo "<h3>Результаты запроса:</h3>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>";
        
        // Получаем строки из результата и выводим их
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['password'] . "</td>
                  </tr>";
        }
        echo "</table>";
        
        setcookie("User", $username, time() + 7200); // Кука на 2 часа
    } else {
        echo "Неправильный логин или пароль.<br>";
    }

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
