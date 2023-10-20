<?php
require_once 'secure.php';

if (!Helper::can('procreator')) {
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
$students = $studentMap->findStudentsFromGrades($id, $page * $size - $size, $size);
$header = 'Студент';
$userMap = new UserMap();
$user = $userMap->auth($login, $password);
require_once 'template/header.php';

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <h1>Посещаемость</h1>
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i> Главная</li>
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
                                    <th>Посещаемость</th>
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
                                $sql = "SELECT parent.child_id as child_id, CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio, subject.name as subject, grade_accept.date as date, attend.attend as attend, branch.id as branch, user.user_id as user_id
                                FROM parent
                                INNER JOIN user ON user.user_id = parent.child_id
                                INNER JOIN grade_accept ON grade_accept.user_id = parent.child_id
                                INNER JOIN subject ON subject.subject_id = grade_accept.subject_id
                                INNER JOIN attend ON attend.id = grade_accept.attend
                                INNER JOIN branch ON branch.id = user.branch_id
                                WHERE parent.user_id = {$_SESSION['id']} and grade_accept.grade is null and branch.id = {$_SESSION['branch']}";
                                $result = $mysqli->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['fio'] . "</td>";
                                        echo "<td>" . $row['subject'] . "</td>";
                                        echo "<td>" . $row['attend'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";

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