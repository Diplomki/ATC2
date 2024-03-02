<?php
require_once '../secure.php';
if (!Helper::can('admin') && !Helper::can('manager')) {
    header('Location: 404');
    exit();
}
$size = 10;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}

$subject_id = 0;
$date = '';
$gruppa_id = 0;
if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];
    $date = $_GET['date'];
    $gruppa_id = $_GET['gruppa_id'];
}

$gradeMap = new GradeMap();
$grade = $gradeMap->findBySubjectId($date, $subject_id, $gruppa_id);

$header = 'Список студентов';
require_once '../template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <h3><b>Список оценок</b></h3>
                <ol class="breadcrumb">
                    <li><a href="../index"><i class="fa fa-dashboard"></i> Главная</a></li>
                    <li class="active">Список
                        оценок</li>
                </ol>
            </section>
            <div class="box-body">
                <?php
                if ($grade) {
                    ?>
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
                            foreach ($grade as $grade) {
                                echo '<tr>';
                                echo '<td>' . $grade->fio . '</td>';
                                echo '<td>' . $grade->subject . '</td>';
                                echo '<td>' . $grade->grade . '</td>';
                                echo '<td>' . $grade->date . '</td>';
                                echo '</tr>';

                            }
                            ?>
                        </tbody>
                    </table>
                    <form action="../excel" method="GET">
                        <div class="form-group"><br>
                            <button type="submit" class="btn btn-primary">Выгрузка в Excel</button>
                            <input type="hidden" name="subject_id" value="<?= $subject_id ?>">
                            <input type="hidden" name="date" value="<?= $date ?>">
                            <input type="hidden" name="gruppa_id" value="<?= $gruppa_id ?>">
                        </div>
                    </form>
                <?php } else {
                    echo 'Ни одной оценки не найдено';
                } ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once '../template/footer.php';
?>