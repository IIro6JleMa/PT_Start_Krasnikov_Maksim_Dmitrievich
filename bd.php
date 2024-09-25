<?php
$servername = "127.0.0.1";
$username = "root";
$password = "maks";
$dbName = "first";

// Подключение к MySQL
$link = mysqli_connect($servername, $username, $password);

// Проверка соединения
if (!$link) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Создание базы данных
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if (!mysqli_query($link, $sql)) {
    echo "Не удалось создать базу данных: " . mysqli_error($link);
}

// Закрытие соединения
mysqli_close($link);

// Подключение к созданной базе данных
$link = mysqli_connect($servername, $username, $password, $dbName);

// Создание таблицы пользователей
$sql = "CREATE TABLE IF NOT EXISTS users(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(15) NOT NULL,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(20) NOT NULL
)";
if (!mysqli_query($link, $sql)) {
    echo "Не удалось создать таблицу пользователей: " . mysqli_error($link);
}

// Закрытие соединения
mysqli_close($link);
?>
