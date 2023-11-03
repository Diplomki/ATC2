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
$students = $studentMap->Payment();
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
                                    <th>Ф.И.О Родителя</th>
                                    <th>Ф.И.О Ученика</th>
                                    <th>Предмет</th>
                                    <th>Кол-во уроков</th>
                                    <th>Чек</th>
                                    <th>Цена</th>
                                    <th>Подтверждение</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($students as $student) {
                                    echo '<tr>';
                                    echo '<td>' . $student->parent_fio . '</td>';
                                    echo '<td>' . $student->child_fio . '</td>';
                                    echo '<td>' . $student->subject . '</td>';
                                    echo '<td>' . $student->count . '</td>';
                                    echo '<td>' . '<a href="#">' . $student->tab . '</a>' . '</td>';
                                    echo '<td>' . $student->price . '</td>';
                                    echo '</tr>';
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
require_once 'template/footer.php';

?>