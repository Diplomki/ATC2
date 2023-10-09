<?php
require_once 'secure.php';

if (!Helper::can('parent')) {
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
$header = 'Студент';
require_once 'template/header.php';

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <h1>Студент</h1>
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i> Главная</li>
                    <li class="active">Студент</li>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mysqli = new mysqli("ATC2", "root", "root", "atc");
                                if ($mysqli->connect_errno) {
                                    echo "Ошибка";
                                    exit;
                                }
                                $sql = "SELECT grades.grade_id as id, user.user_id AS user_id, CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio, subject.subject_id AS subject_id, subject.name AS subject, grades.grade AS grade, grades.date AS date FROM user
                                INNER JOIN grades ON user.user_id = grades.user_id
                                INNER JOIN subject on subject.subject_id=grades.subject_id";
                                $result = $mysqli->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['fio'] . "</td>";
                                        echo "<td>" . $row['subject'] . "</td>";
                                        echo "<td>" . $row['grade'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . '<form method="post">
                                                        <input type="hidden" name="grade_id" value="' . $row['id'] . '">
                                                        <input type="hidden" name="user_id" value="' . $row['user_id'] . '">
                                                        <input type="hidden" name="subject_id" value="' . $row['subject_id'] . '">
                                                        <input type="hidden" name="grade" value="' . $row['grade'] . '">
                                                        <input type="hidden" name="date" value="' . $row['date'] . '">
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

// Закрытие соединения с базой данных
$conn->close();
require_once 'template/footer.php';

?>