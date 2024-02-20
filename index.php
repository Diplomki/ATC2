<?php
require_once 'secure.php';
require_once 'template/header.php';

$userMap = new UserMap();
$indexTeacher = $userMap->teacherCount();
$indexStudent = $userMap->studentCount();
?>
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
    <?php if (!Helper::can('procreator') && !Helper::can('teacher')) {
        $header = isset($_GET['message']) ? '<span style="color: red;">Неверный формат файла</span>' : 'Главная';
        ?>
        <section class="content-header">
            <h3><b>
                    <?= $header ?>
                </b></h3>
        </section>
        <section class="content">

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-stats-bars"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><b>Кол-во учителей</b></span>
                        <span class="info-box-number">
                            <?php echo $indexTeacher->count; ?>
                        </span>
                    </div>

                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-person-add"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><b>Кол-во студентов</b></span>
                        <span class="info-box-number">
                            <?php echo $indexStudent->count; ?>
                        </span>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

</html>
</body>

<?php
if (!Helper::can('admin') && !Helper::can('manager') && !Helper::can('procreator')) {
    $header = 'Главная: расписание занятий.';

    $userIdentity = (new UserMap())->identity($_SESSION['id']);
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
                <section class="box-body">
                    <h3>
                        <?= $header; ?>
                    </h3>
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
                                                        <?= $schedule['lesson_num']; ?>
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
    if (isset($_GET['page'])) {
        $page = Helper::clearInt($_GET['page']);

    } else {
        $page = 1;
    }
    $studentMap = new StudentMap();
    $count = $studentMap->count();
    $student = $studentMap->findStudentsFromParent($page * $size - $size, $size);
    $header = isset($_GET['message']) ? '<span style="color: red;">Неверный формат файла</span>' : 'Главная';
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($student as $student) {
                                        echo '<tr>';
                                        echo '<td><a href="profile/profile-student?id=' . $student->user_id . '">' . $student->fio . '</a> ' . '</td>';
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