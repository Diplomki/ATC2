<?php
require_once 'secure.php';
require_once 'template/header.php';
if (isset ($_GET['id'])) {
    $_SESSION['branch'] = (int) $_GET['id'];
}

$id = $_SESSION['branch'];

$userMap = new UserMap();
$indexTeacher = $userMap->teacherCount();
$indexStudent = $userMap->studentCount();
$indexParent = $userMap->parentCount();

$branch = $userMap->findBranchById($id);

$branchWithoutCurrent = (new UserMap())->arrBranchWithoutCurrent();



?>
<script>


</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboards/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="dashboards/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dashboards/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="dashboards/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="dashboards/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="dashboards/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="dashboards/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">





<body>
    <?php if (Helper::can('manager')) {
        $header = isset ($_GET['message']) ? '<span style="color: red;">Неверный формат файла</span>' : $branch->name;
        ?>

        <section class="content-header">
            <h3><b>
                    <?= $header ?>
                </b></h3>
        </section>
        <section class="content-header">
            <h3><b>
                    Дата основания:
                    <?= $branch->date_founding ?>
                </b></h3>
        </section>
        <section class="content">
            <a style="text-decoration: none; color: #333;" href="list/list-teacher">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-stats-bars"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><b>Кол-во учителей</b></span>
                            <span class="info-box-number">
                                <?= $indexTeacher->count ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>

            <a style="text-decoration: none; color: #333;" href="list/list-student">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="ion ion-person-add"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Кол-во учеников</b></span>
                            <span class="info-box-number">
                                <?= $indexStudent->count ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>

            <a style="text-decoration: none; color: #333;" href="list/list-parent">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="ion ion-person-add"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Кол-во родителей</b></span>
                            <span class="info-box-number">
                                <?= $indexParent->count ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </section>
    <?php } ?>



    <?php if (Helper::can('admin')) {
        $header = isset ($_GET['message']) ? '<span style="color: red;">Неверный формат файла</span>' : $branch->name;
        ?>

        <section class="content-header">
            <h3><b>
                    <?= $header ?>
                </b></h3>
        </section>
        <section class="content-header">
            <h3><b>
                    Дата основания:
                    <?= $branch->date_founding ?>
                </b></h3>
        </section>

        <section class="content-header">
            <h3><b>
                    Список филиалов:

                </b></h3>
        </section>
        <section class="content-header">
            <form id="myForm" action="index" method="GET">
                <?php foreach ($branchWithoutCurrent as $item): ?>
                    <button class="btn btn-primary" type="button" onclick="submitForm(<?= $item->id ?>)">
                        <?= $item->value ?>
                    </button>
                <?php endforeach; ?>
                <input type="hidden" id="selectedId" name="id" value="">
            </form>

            <script>
                function submitForm(id) {
                    document.getElementById('selectedId').value = id;
                    document.getElementById('myForm').submit();

                }
            </script>
        </section>
        <section class="content">
            <a style="text-decoration: none; color: #333;" href="list/list-teacher">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-stats-bars"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><b>Кол-во учителей</b></span>
                            <span class="info-box-number">
                                <?= $indexTeacher->count ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>

            <a style="text-decoration: none; color: #333;" href="list/list-student">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="ion ion-person-add"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Кол-во учеников</b></span>
                            <span class="info-box-number">
                                <?= $indexStudent->count ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>

            <a style="text-decoration: none; color: #333;" href="list/list-parent">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="ion ion-person-add"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Кол-во родителей</b></span>
                            <span class="info-box-number">
                                <?= $indexParent->count ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </section>
    <?php } ?>

</html>
</body>

<?php
if (Helper::can('teacher')) {
    $header = 'Главная: расписание занятий.';

    $userIdentity = (new UserMap())->identity($_SESSION['id']);
    $user = ((new TeacherMap())->findById($_SESSION['id']));
    if ($userIdentity == UserMap::TEACHER) {
        $schedules = (new ScheduleMap())->findByTeacherId($_SESSION['id']);
    } elseif ($userIdentity == UserMap::STUDENT) {
        $schedules = (new ScheduleMap())->findByStudentId($_SESSION['id']);
    } else {
        $schedules = null;
    }
    require_once 'template/header.php';
    ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h3><b>
                            Добро пожаловать:
                            <?= $user->fio ?>
                        </b></h3>
                </section>
                <section class="content-header">
                    <h3><b>
                            <img style="width: 150px; height: 150px;" src=" /avatars/<?= $user->photo ?>">
                        </b></h3>
                </section>
                <section class="content-header">
                    <form action="add/add-avatar" method="get">
                        <h3><b>
                                <input type="hidden" name="id" value="<?= $user->user_id ?>">
                                <input class="btn btn-primary" type="submit" value="Изменить фото">
                            </b></h3>
                    </form>

                </section>
                <section class="content-header">
                    <form action="add/add-avatar" method="get">
                        <h3><b>
                                <input class="btn btn-primary" type="submit" value="Журнал">
                            </b></h3>
                    </form>
                </section><br>
                <form action="index" method="get">
                    <section class="content-header">
                        <select style="width: 250px;" class="form-control" name="branch">
                            <?= Helper::printSelectOptions(0, (new UserMap())->arrBranchs()) ?>
                        </select>
                    </section>
                    <section class="content-header">
                        <input class="btn btn-primary" type="submit" value="Узнать расписание">
                    </section>
                </form>
                <br>
                <section class="content-header">
                    <form action="index" method="get">
                        <h3><b>
                                <input class="btn btn-primary" type="submit" value="Замена">
                            </b></h3>
                    </form>
                </section>
                <section class="content-header">
                    <h3><b>
                            <?= $header ?>
                        </b></h3>
                </section>
                <div class="box-body">
                    <?php if ($schedules): ?>
                        <?php if ($userIdentity == UserMap::TEACHER): ?>
                            <table class="table table-bordered table-hover">
                                <?php foreach ($schedules as $day):
                                    ?>
                                    <tr>
                                        <th colspan="3">
                                            <h4 class="center-block">
                                                <?= $day['name']; ?>
                                            </h4>
                                        </th>
                                    </tr>

                                    <?php if ($day['gruppa']): ?>
                                        <?php foreach ($day['gruppa'] as $gruppa): ?>
                                            <tr>
                                                <th colspan="3">
                                                    <?= $gruppa['name']; ?>
                                                </th>
                                            </tr>

                                            <?php foreach ($gruppa['schedule'] as $schedule): ?>
                                                <tr>
                                                    <td>
                                                        <?= $schedule['time']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $schedule['subject']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $schedule['classroom']; ?>
                                                    </td>

                                                </tr>

                                            <?php endforeach; ?>
                                        <?php endforeach; ?>

                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3">Отутствует расписание на этот день</td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </table>
                        <?php else: ?>
                            <p>Ваша группа:
                                <?= $schedules['gruppa']; ?>
                            </p>
                            <table class="table table-bordered table-hover">

                                <?php foreach ($schedules['allSchedule'] as $day):
                                    ?>
                                    <tr>
                                        <th colspan="3">
                                            <h4 class="center-block">
                                                <?= $day['name']; ?>
                                            </h4>
                                        </th>
                                    </tr>

                                    <?php if ($day['schedule']): ?>
                                        <?php foreach ($day['schedule'] as $gruppa): ?>



                                            <tr>
                                                <td>
                                                    <?= $gruppa['lesson_num']; ?>
                                                </td>
                                                <td>
                                                    <?= $gruppa['subject']; ?>
                                                </td>
                                                <td>
                                                    <?= $gruppa['classroom']; ?>
                                                </td>

                                            </tr>

                                        <?php endforeach; ?>


                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3">Отутствует расписание на этот день</td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </table>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>Для Вас расписание отутствует</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if (Helper::can('procreator')) {
    require_once 'secure.php';
    if (!Helper::can('procreator')) {
        header('Location: 404');
        exit();
    }
    $size = 10;
    if (isset ($_GET['page'])) {
        $page = Helper::clearInt($_GET['page']);

    } else {
        $page = 1;
    }
    $studentMap = new StudentMap();
    $count = $studentMap->count();
    $student = $studentMap->findStudentsFromParent($page * $size - $size, $size);
    $header = isset ($_GET['message']) ? '<span style="color: red;">Ошибка</span>' : 'Главная';
    require_once 'template/header.php';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="content-header">
                    <h1><b>
                            <?= $header ?>
                        </b>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">Главная</li>
                    </ol>
                </section>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if ($student) {
                        ?>
                        <form action="save/saveStundentInfo" method="POST" enctype="multipart/form-data">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Ф.И.О</th>
                                        <th></th>
                                        <th>Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($student as $student) {
                                        echo '<tr>';
                                        echo '<td><a href="profile/profile-student?id=' . $student->user_id . '">' . $student->fio . '</a> ' . '</td>';
                                        echo '<td><a class="btn btn-primary" href="add/add-avatar?id=' . $student->user_id . '">Изменить фото</a> ' . '</td>';
                                        echo '<td><a class="btn btn-primary" href="add/add-reference?id=' . $student->user_id . '">Добавить справку</a> ' . '</td>';
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
                <div class="box-body">
                    <?php Helper::paginator($count, $page, $size); ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <?php
    require_once 'template/footer.php';
}
require_once 'template/footer.php';


?>