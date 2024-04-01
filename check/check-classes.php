<?php
require_once '../secure.php';
require_once '../template/header.php';
if (isset($_GET['day'])) {
    $day = $_GET['day'];
    $schedules = (new ScheduleMap())->findByDayTeacher($_SESSION['id'], $day);
}
$header = 'Расписание занятий.';

$days = [
    '1' => 'Понедельник',
    '2' => 'Вторник',
    '3' => 'Среда',
    '4' => 'Четверг',
    '5' => 'Пятница',
    '6' => 'Суббота',
];
?>
<?php if (isset($_GET['day'])): ?>
    <section class="content-header">
        <h3><b>
                <?= $header ?>
            </b></h3>
    </section>
    <div class="box-body">

        <table class="table table-bordered table-hover">
            <tr>
                <th colspan="3">
                    <h4 class="center-block">
                        <?= $days[$day]; ?>
                    </h4>
                </th>
            </tr>
        </table>
        <?php if (empty($schedules)): ?>
            <tr>
                <td colspan="3">Отутствует расписание на этот день</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($schedules as $classes): ?>
            <tr>
                <th colspan="3">
                    <?= $classes->gruppa; ?>
                </th>
            </tr>
            <tr>
                <td>
                    <?= $classes->time; ?>
                </td>
                <td>
                    <?= $classes->subject; ?>
                </td>
                <td>
                    <?= $classes->classroom; ?>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        </table>
        <form action="check-classes" method="get">
            <label>Выберите день</label>
            <select style="width: 300px;" class="form-control" name="day">
                <?= Helper::printSelectOptions(0, (new ScheduleMap())->arrDays()) ?>
            </select><br>
            <input class="btn btn-primary" type="submit" value="Узнать расписание">
        </form>
    </div>
<?php endif; ?>
<?php
require_once '../template/footer.php';
?>