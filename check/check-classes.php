<?php
require_once '../secure.php';
require_once '../template/header.php';
if (isset ($_GET['day'])) {
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
<?php if (isset ($_GET['day'])): ?>
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
        <?php if (empty ($schedules)): ?>
            <tr>
                <td colspan="3">Отутствует расписание на этот день</td>
            </tr>
        <?php endif; ?>
        <table class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>Группа</th>
                    <th>Предмет</th>
                    <th>Время</th>
                    <th>Дни обучения</th>
                    <th>Дата урока</th>
                    <th>Кол-во учеников</th>
                    <th>Общее кол-во учеников</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedules as $classes): ?>
                    <tr>
                        <td>
                            <?= $classes->gruppa; ?>
                        </td>
                        <td>
                            <?= $classes->subject; ?>
                        </td>
                        <td>
                            <?= $classes->time; ?>
                        </td>
                        <td>
                            <?= $classes->days_of_study; ?>
                        </td>
                        <td>
                            <?= $classes->lesson_date; ?>
                        </td>
                        <td>
                            <?= $classes->num_of_students; ?>
                        </td>
                        <td>
                            <?= $classes->total_students; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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