<?php
require_once 'secure.php';



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
$students = $studentMap->findStudentById($id);
$header = 'Список студентов';
require_once 'template/header.php';

if (isset($_POST['formSubmit'])) {
    $mysqli = new mysqli("ATC2", "root", "root", "atc");
    if ($mysqli->connect_errno) {
        echo "Ошибка";
        exit;
    }

    foreach ($_POST['grade_id'] as $user_id => $grade) {
        $subject_id = $_POST['subject_id'][$user_id];
        $student_id = $student->user_id;
        $attend = $_POST['attend'][$user_id];
        $grade = $mysqli->real_escape_string($grade);

        if (isset($_POST["grade_id"][$user_id]) && $_POST["grade_id"][$user_id] !== "") {
            $grade = $_POST["grade_id"][$user_id];
        } else {
            $grade = "NULL";
        }

        $query = "INSERT INTO grades (user_id, subject_id, grade, date, attend) VALUES ('$user_id', '$subject_id', $grade, NOW(), $attend)";
        $result = $mysqli->query($query);


        if (!$result) {
            echo $query;
        }
    }
    $mysqli->close();
}
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
                <?php if (Helper::can('admin') || Helper::can('manager')) { ?>
                    <a class="btn btn-success" href="add-student.php">Добавить студента</a>
                <?php } ?>
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
                                    <th>Посещаемость</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo '<p>' . $student->fio . '</p> ' . '<a href="add-student.php?id=' . $student->user_id . '"></a>';
                                            ?>
                                        </td>
                                        <td>
                                            <select name="subject_id[<?php echo $student->user_id; ?>]">
                                                <?php

                                                if ($_SESSION['role'] == 'teacher') {



                                                    $mysqli = new mysqli("ATC2", "root", "root", "atc");
                                                    if ($mysqli->connect_errno) {
                                                        echo "Ошибка";
                                                        exit;
                                                    }
                                                    $sql = "SELECT teacher.otdel_id as otdel FROM teacher WHERE teacher.user_id = {$_SESSION['id']}";
                                                    $result = $mysqli->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        $row = $result->fetch_assoc();
                                                        $fieldValue = $row['otdel'];
                                                    }
                                                }
                                                $sql2 = "SELECT subject.subject_id as id, subject.name as name FROM subject WHERE subject.otdel_id = $fieldValue";
                                                $result2 = $mysqli->query($sql2);
                                                if ($result2->num_rows > 0) {
                                                    while ($row = $result2->fetch_assoc()) {
                                                        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                                                    }
                                                } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="grade_id[<?php echo $student->user_id; ?>]">
                                        </td>
                                        <td>
                                            <select name="attend[<?php echo $student->user_id; ?>]">
                                                <?php

                                                $mysqli = new mysqli("ATC2", "root", "root", "atc");
                                                if ($mysqli->connect_errno) {
                                                    echo "Ошибка";
                                                    exit;
                                                }
                                                $sql = "SELECT * FROM attend";
                                                $result = $mysqli->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<option value='" . $row["id"] . "'>" . $row["attend"] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <input class="btn btn-success" type="submit" name="formSubmit">
                    </form>
                <?php } else {
                    echo 'Ни одного студента не найдено';
                } ?>
            </div>

        </div>
    </div>
</div>

<?php
require_once 'template/footer.php';

?>