<?php
require_once 'secure.php';
require_once 'template/header.php';
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
    <?php if (!Helper::can('procreator') && !Helper::can('teacher')) { ?>
        <section class="content">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-stats-bars"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Кол-во учителей</span>
                        <?php
                        $servername = "ATC2";
                        $username = "root";
                        $password = "root";
                        $dbname = "atc";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Ошибка подключения: " . $conn->connect_error);
                        }
                        if ($_SESSION['branch'] != 999) {
                            $sql1 = "SELECT COUNT(*) as count FROM teacher
                    INNER JOIN user ON teacher.user_id = user.user_id
                    WHERE user.branch_id = {$_SESSION['branch']}";
                        } else {
                            $sql1 = "SELECT COUNT(*) as count FROM teacher
                        ";
                        }
                        $total_count1 = 0;

                        $result1 = mysqli_query($conn, $sql1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $total_count1 = $row1['count'];

                        ?>
                        <span class="info-box-number">
                            <?php echo $total_count1; ?>
                        </span>
                    </div>

                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-person-add"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Кол-во студентов</span>
                        <?php
                        $servername = "ATC2";
                        $username = "root";
                        $password = "root";
                        $dbname = "atc";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Ошибка подключения: " . $conn->connect_error);
                        }

                        if ($_SESSION['branch'] != 999) {
                            $sql1 = "SELECT COUNT(*) as count FROM student
                    INNER JOIN user ON student.user_id = user.user_id
                    WHERE user.branch_id = {$_SESSION['branch']}";
                        } else {
                            $sql1 = "SELECT COUNT(*) as count FROM student
                        ";
                        }
                        $result1 = $conn->query($sql1);

                        if ($result1 === false) {
                            die("Ошибка выполнения запроса: " . $conn->error);
                        }

                        $row1 = $result1->fetch_assoc();
                        $total_count1 = $row1['count'];
                        $conn->close();
                        ?>
                        <span class="info-box-number">
                            <?php echo $total_count1; ?>
                        </span>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

</html>
</body>
<?php
if (!Helper::can('admin') && !Helper::can('manager')) {
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
require_once 'template/footer.php';
echo $user->role_id;
?>