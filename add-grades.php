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
$student = $studentMap->findStudentsFromGroup($id, $page * $size - $size, $size);
$header = 'Список студентов';
require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <h1>Список студентов</h1>
                <ol class="breadcrumb">
                    <li><a href="/index.php"><i class="fa
fa-dashboard"></i> Главная</a></li>
                    <li class="active">Список
                        студента</li>
                </ol>
            </section>
            <div class="box-body">
                <?php if (Helper::can('admin') || Helper::can('manager')) { ?>
                    <a class="btn btn-success" href="add-student.php">Добавить студента</a>
                <?php } ?>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                if ($student) {
                    ?>

                    <table id="example2" class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>Ф.И.О</th>
                                <th>Предмет</th>
                                <th>Оценка</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($student as $student) {
                                ?>
                                <form method="POST">
                                <?php
                                echo '<tr>';
                                if (Helper::can('manager') || Helper::can('teacher'))
                                    echo '<td><p>' . $student->fio . '</p> ' . '<a href="add-student.php?id=' . $student->user_id . '"></a></td>';
                                ?>
                                <td>
                                    <select name="subject_id" id="">
                                        <?= Helper::printSelectOptions($student->gruppa_id, (new SubjectMap())->arrSubjects()); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="grade_id">
                                </td>

                                <?php
                                echo '</tr>';
                                if(isset($_POST['formSubmit'])){
                                    $subject_id = $_POST['subject_id'];
                                    $grade_id = $_POST['grade_id'];
                                    $mysqli = new mysqli("ATC2", "root", "root", "atc");
                                    if($mysqli->connect_errno){
                                        echo "Ошибка";
                                        exit;
                                    }
                                    $query = "INSERT INTO grades (user_id, subject_id, grade, date) VALUES ($student->user_id, $subject_id, $grade_id, NOW())";
                                    $result = $mysqli->query($query);
                                    if($result){
                                        print('Успешно !'. '<br>');
                                    }
                                    $mysqli->close();
                                }
                            }
                            ?>
                                <input class="btn btn-success" type="submit" name="formSubmit">
                                </form>
                        </tbody>
                    </table>
                <?php } else {
                    echo 'Ни одного студента не найдено';
                } ?>
            </div>
            <div class="box-body">
                <?php Helper::paginator($count, $page, $size); ?>
            </div>
            <!-- /.box-body -->
            <?php

            ?>
        </div>
    </div>
</div>
<?php
require_once 'template/footer.php';
?>