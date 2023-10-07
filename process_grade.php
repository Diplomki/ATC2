<?php
// Подключение к базе данных
$servername = "ATC2";
$username = "root";
$password = "root";
$dbname = "atc";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверка, был ли запрос отправлен
if (isset($_POST['gradeSubmit'])) {

    $grade_delete = $_POST['id'];
    $user_id = $_POST['user_id'];
    $subject_id = $_POST['subject_id'];
    $grade_id = $_POST['grade'];
    $date = $_POST['date'];

    // SQL-запрос на вставку данных в таблицу "grade_accept"
    $sql = "INSERT INTO grade_accept (user_id, subject_id, grade, date) VALUES ('$user_id', '$subject_id', '$grade_id', '$date')";
    $sql2 = "DELETE FROM grades WHERE grade_id = '$grade_delete'";
    if ($conn->query($sql) && $conn->query($sql2)) {
        echo "Данные успешно добавлены в таблицу grade_accept.";
    } else {
        echo "Ошибка при добавлении данных: " . $conn->error;
    }
}

// Закрытие соединения с базой данных
$conn->close();
?>