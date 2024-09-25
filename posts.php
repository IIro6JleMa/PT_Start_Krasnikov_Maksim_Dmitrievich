<?php
// Подключение к базе данных
$link = mysqli_connect('127.0.0.1', 'root', 'maks', 'first');

// Проверяем подключение
if (!$link) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

// Получаем параметр id из строки запроса
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Преобразуем параметр id в целое число

    // Запрос к таблице posts для получения записи с заданным id
    $sql = "SELECT * FROM posts WHERE id=$id";
    $res = mysqli_query($link, $sql);

    // Проверяем, найдена ли запись
    if (mysqli_num_rows($res) > 0) {
        // Извлекаем данные записи
        $rows = mysqli_fetch_array($res);
        $title = $rows['title'];
        $main_text = $rows['main_text'];
        $file_path = $rows['file_path'];  // Путь к файлу, если он был загружен
    } else {
        die("Запись с id=$id не найдена.");
    }
} else {
    die("ID поста не указан.");
}

// Закрываем соединение с базой данных
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Отображаем заголовок и текст поста -->
                <h1><?php echo htmlspecialchars($title); ?></h1>
                <p><?php echo htmlspecialchars($main_text); ?></p>

                <?php if (!empty($file_path)): ?>
                    <!-- Если есть прикрепленный файл, отображаем его -->
                    <h3>Прикрепленное изображение:</h3>
                    <img src="<?php echo htmlspecialchars($file_path); ?>" alt="Изображение к посту" class="img-fluid my-3">
                <?php endif; ?>

                <a href="index.php" class="btn btn-primary mt-3">Вернуться на главную</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
