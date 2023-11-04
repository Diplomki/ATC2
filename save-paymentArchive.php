<?php
require_once 'secure.php';
if (!Helper::can('manager')) {
    header('Location: 404.php');
    exit();
}
if (isset($_POST['paymentSubmit'])) {
    $student = new Student();
    $student->parent_id = Helper::clearInt($_POST['parent_id']);
    $student->user_id = Helper::clearInt($_POST['child_id']);
    $student->subject_id = Helper::clearInt($_POST['subject_id']);
    $student->id = Helper::clearInt($_POST['id']);
    $student->count = $_POST['count'];
    $student->tab = $_POST['tab'];
    $student->price = $_POST['price'];
    $student->attend = 1;

    $servername = "127.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "atc";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка соединения: " . $conn->connect_error);
    }



    // SQL-запрос на удаление записи
    $sql = "DELETE FROM payment WHERE id = $student->id";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Ошибка при удалении записи: " . $conn->error;
    }

    $conn->close();

    if ((new StudentMap())->savePaymentArchive($student)) {
        header('Location: check-payment.php');

    } else {
        if ($student->user_id) {

            header('Location: check-payment.php');

        } else {
            header('Location: check-payment.php');
        }
    }
}

if (isset($_POST['paymentDelete'])) {
    $student = new Student();
    $student->parent_id = Helper::clearInt($_POST['parent_id']);
    $student->user_id = Helper::clearInt($_POST['child_id']);
    $student->subject_id = Helper::clearInt($_POST['subject_id']);
    $student->id = Helper::clearInt($_POST['id']);
    $student->count = $_POST['count'];
    $student->tab = $_POST['tab'];
    $student->price = $_POST['price'];
    $student->attend = 0;

    $servername = "127.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "atc";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка соединения: " . $conn->connect_error);
    }



    // SQL-запрос на удаление записи
    $sql = "DELETE FROM payment WHERE id = $student->id";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Ошибка при удалении записи: " . $conn->error;
    }

    $conn->close();

    if ((new StudentMap())->savePaymentArchive($student)) {
        header('Location: check-payment.php');

    } else {
        if ($student->user_id) {
            header('Location: check-payment.php');
        } else {
            header('Location: check-payment.php');
        }
    }
}
