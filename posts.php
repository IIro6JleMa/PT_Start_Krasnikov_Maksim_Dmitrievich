<?php
// Подключение к базе данных
$link = mysqli_connect('127.0.0.1', 'root', 'maks', 'first');

// Проверяем подключение
if (!$link) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

// Получаем параметр id из строки запроса
$id = $_GET['id'];  // Уязвимо для SQL-инъекций

// Запрос к базе данных
$sql = "SELECT * FROM posts WHERE id=$id";
$res = mysqli_query($link, $sql);
$rows = mysqli_fetch_array($res);

// Обрабатываем результат инъекции, если она есть
$main_text = $rows['main_text'];  // Текст поста

// Обработка загрузки файлов
if(!empty($_FILES["file"])) {
    if (((@$_FILES["file"]["type"] == "image/gif") || (@$_FILES["file"]["type"] == "image/jpeg")
        || (@$_FILES["file"]["type"] == "image/jpg") || (@$_FILES["file"]["type"] == "image/pjpeg")
        || (@$_FILES["file"]["type"] == "image/x-png") || (@$_FILES["file"]["type"] == "image/png"))
        && (@$_FILES["file"]["size"] < 102400)) 
    {
        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
        echo "Загружено в: " . "upload/" . $_FILES["file"]["name"];
    } else {
        echo "Загрузка не удалась!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $rows['title']; ?></title> <!-- Уязвимо для XSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo $rows['title']; ?></h1> <!-- Уязвимо для XSS -->
        <p><?php echo $main_text; ?></p> <!-- Уязвимо для XSS -->

        <!-- Форма загрузки файлов -->
        <form action="" method="post" enctype="multipart/form-data" name="upload">
            <input type="file" name="file" />
            <button type="submit" class="btn btn-primary mt-3">Загрузить файл</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
