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

if (isset($_POST['formSubmit'])) {
    $mysqli = new mysqli("ATC2", "root", "root", "atc");
    if ($mysqli->connect_errno) {
        echo "Ошибка";
        exit;
    }

    foreach ($_POST['grade_id'] as $user_id => $grade) {
        $subject_id = $_POST['subject_id'][$user_id];
        $grade = $mysqli->real_escape_string($grade);
        $query = "INSERT INTO grades (user_id, subject_id, grade, date) VALUES ('$user_id', '$subject_id', '$grade', NOW())";
        $result = $mysqli->query($query);
        if (!$result) {
            echo "Ошибка при добавлении оценки для студента $user_id";
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if (Helper::can('manager') || Helper::can('teacher')) {
                                                echo '<p>' . $student->fio . '</p> ' . '<a href="add-student.php?id=' . $student->user_id . '"></a>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <select name="subject_id[<?php echo $student->user_id; ?>]" id="">
                                                <?= Helper::printSelectOptions($student->gruppa_id, (new SubjectMap())->arrSubjects()); ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="grade_id[<?php echo $student->user_id; ?>]">
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
            <div class="box-body">
                <?php Helper::paginator($count, $page, $size); ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'template/footer.php';
?>