<?php
$host = 'localhost'; // Хост сервера MySQL
$dbname = 'dentistry'; // Имя вашей базы данных
$username = 'root'; // Имя пользователя (по умолчанию для XAMPP)
$password = ''; // Пароль (по умолчанию пустой)

try {
    // Создаем подключение к базе данных
    $conn = new PDO("mysql:host=localhost;dbname=dentistry", "root", ""); // Используйте свои данные

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; // Для проверки подключения
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
