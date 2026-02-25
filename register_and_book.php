<?php
include 'db.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $comments = $_POST['comments'];

    try {
        $conn->beginTransaction();

        // Сохранение пользователя
        $sqlUser = "INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)";
        $stmtUser = $conn->prepare($sqlUser);
        $stmtUser->execute(['name' => $name, 'email' => $email, 'phone' => $phone]);

        // Получение ID пользователя
        $userId = $conn->lastInsertId();

        // Сохранение записи на прием
        $sqlAppointment = "INSERT INTO appointments (user_id, doctor, date, time, comments)
                           VALUES (:user_id, :doctor, :date, :time, :comments)";
        $stmtAppointment = $conn->prepare($sqlAppointment);
        $stmtAppointment->execute([
            'user_id' => $userId,
            'doctor' => $doctor,
            'date' => $date,
            'time' => $time,
            'comments' => $comments
        ]);

        $conn->commit();
        header('Location: success.html');
        exit();
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>
