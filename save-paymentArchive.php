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


    $host = '127.0.0.1';
    $dbname = 'atc';
    $username = 'root';
    $password = 'root';

    // Создаем объект PDO для подключения к базе данных
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Устанавливаем режим выброса исключений при ошибке
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
    $sql2 = "SELECT payment_archive.child_id, payment_archive.subject_id FROM payment_archive";
    try {
        $stmt = $pdo->prepare($sql2);
        $stmt->execute();
        // Получаем результат в виде ассоциативного массива
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Вывод результатов
        $found = false;
        foreach ($result as $row) {
            if ($student->user_id == $row["child_id"] && $student->subject_id == $row["subject_id"]) {
                (new StudentMap())->saveUpdatePaymentArchive($student);
                $found = true;
                break;
            }
        }
        if ($found == false) {
            (new StudentMap())->savePaymentArchive($student);
            $found = true;
        }

        if ($found) {
            header('Location: check-payment.php');
        }
    } catch (PDOException $e) {
        die("Ошибка выполнения запроса: " . $e->getMessage());
    }

    $pdo = null;


    $conn->close();
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
