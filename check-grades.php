<?php
require_once 'secure.php';

if (!Helper::can('admin') && !Helper::can('manager') && !Helper::can('teacher')) {
    header('Location: 404.php');
    exit();
}

$size = 10;

if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}

if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
} else {
    $id = 1;
}

$studentMap = new StudentMap();
$count = $studentMap->count();
$students = $studentMap->findStudentsFromGroup($id, $page * $size - $size, $size);
$header = 'Список студентов';
require_once 'template/header.php';

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <h1>Список студентов</h1>
                <ol class="breadcrumb">
                    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                    <li class="active">Список студентов</li>
                </ol>
            </section>
            <div class="box-body">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php if ($students) { ?>
                    <form method="POST">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Ф.И.О</th>
                                    <th>Предмет</th>
                                    <th>Оценка</th>
                                    <th>Дата</th>
                                    <th>Посещаемость</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mysqli = new mysqli("ATC2", "root", "root", "atc");
                                if ($mysqli->connect_errno) {
                                    echo "Ошибка";
                                    exit;
                                }
                                $sql = "SELECT grades.grade_id as id, user.user_id AS user_id, CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio, subject.subject_id AS subject_id, subject.name AS subject, grades.grade AS grade, grades.date AS date, attend.attend as attend, attend.id as attend_id FROM user
                                INNER JOIN grades ON user.user_id = grades.user_id
                                INNER JOIN subject on subject.subject_id=grades.subject_id
                                INNER JOIN attend on attend.id = grades.attend";
                                $result = $mysqli->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['fio'] . "</td>";
                                        echo "<td>" . $row['subject'] . "</td>";
                                        echo "<td>" . $row['grade'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['attend'] . "</td>";
                                        echo "<td>" . '<form method="post">
                                                        <input type="hidden" name="grade_id" value="' . $row['id'] . '">
                                                        <input type="hidden" name="user_id" value="' . $row['user_id'] . '">
                                                        <input type="hidden" name="subject_id" value="' . $row['subject_id'] . '">
                                                        <input type="hidden" name="grade" value="' . $row['grade'] . '">
                                                        <input type="hidden" name="date" value="' . $row['date'] . '">
                                                        <input type="hidden" name="attend" value="' . $row['attend_id'] . '">
                                                        <input class="btn btn-success" type="submit" name="gradeSubmit" value="Подтвердить">
                                                        <input class="btn btn-danger" type="submit" name="gradeDelete" value="Отклонить">
                                                        </form>' . "</td>";

                                        echo "</tr>";
                                    }
                                } else {
                                    echo "Нет данных в таблице.";
                                }

                                ?>
                            </tbody>
                        </table>
                    </form>
                <?php } else {
                    echo 'Ни одного студента не найдено';
                } ?>
            </div>

        </div>
    </div>
</div>

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
    $grade_delete = $_POST['grade_id'];
    $user_id = $_POST['user_id'];
    $subject_id = $_POST['subject_id'];
    $grade = $_POST['grade'];
    $grade = $mysqli->real_escape_string($grade);

    if (isset($grade) && $grade !== "") {
        $grade = $_POST['grade'];
    } else {
        $grade = "NULL";
    }
    $date = $_POST['date'];
    $attend = $_POST['attend'];

    $sql = "INSERT INTO grade_accept (user_id, subject_id, grade, date, attend) VALUES ('$user_id', '$subject_id', $grade, NOW(), $attend)";
    $sql2 = "DELETE FROM grades WHERE grade_id = '$grade_delete'";

    if ($conn->query($sql) && $conn->query($sql2)) {
        echo '<script type="text/javascript">
                setTimeout(function () {
                window.location.href = window.location.href;
                }, 0);
            </script>';

    } else {

    }
}

if (isset($_POST['gradeDelete'])) {
    $grade_delete = $_POST['grade_id'];
    $sql = "DELETE FROM grades WHERE grade_id = '$grade_delete'";
    if ($conn->query($sql)) {
        echo '<script type="text/javascript">
                    setTimeout(function () {
                    window.location.href = window.location.href;
                    }, 0);
            </script>';
    } else {
        echo "Ошибка при удалении данных: " . $conn->error;
    }
}

// Закрытие соединения с базой данных
$conn->close();
require_once 'template/footer.php';

?>