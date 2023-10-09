<?php
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li <?= ($_SERVER['PHP_SELF'] == '/index.php') ? 'class="active"' : ''; ?>>

                <a href="index.php"><i class="fa fa-calendar"></i><span>Главная</span></a>

            </li>
            <?php if (!Helper::can('teacher') && !Helper::can('admin') && !Helper::can('procreator')) { ?>
                <li class="header">Пользователи</li>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-teacher.php') ? 'class="active"' : ''; ?>>

                    <a href="list-teacher.php"><i class="fafa-users"></i><span>Преподаватели</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-student.php') ? 'class="active"' : ''; ?>>

                    <a href="list-student.php"><i class="fafa-users"></i><span>Студенты</span></a>

                <li class="header">Справочники</li>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-gruppa.php') ? 'class="active"' : ''; ?>>

                    <a href="list-gruppa.php"><i class="fa fa-users"></i><span>Группы</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-otdel.php') ? 'class="active"' : ''; ?>>

                    <a href="list-otdel.php"><i class="fa fa-users"></i><span>Отделы</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-special.php') ? 'class="active"' : ''; ?>>

                    <a href="list-special.php"><i class="fa fa-users"></i><span>Специальности</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-subject.php') ? 'class="active"' : ''; ?>>

                    <a href="list-subject.php"><i class="fa fa-users"></i><span>Предметы</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-classroom.php') ? 'class="active"' : ''; ?>>

                    <a href="list-classroom.php"><i class="fa fa-users"></i><span>Аудитории</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-teacher-schedule.php') ? 'class="active"' : ''; ?>>

                    <a href="list-teacher-schedule.php"><i class="fa fa-users"></i><span>Управление расписанием</span></a>

                </li>
            <?php } ?>
            <?php if (Helper::can('teacher')) { ?>
                <li class="header">Пользователи</li>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-teacher.php') ? 'class="active"' : ''; ?>>

                    <a href="list-teacher.php"><i class="fafa-users"></i><span>Преподаватели</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-student.php') ? 'class="active"' : ''; ?>>

                    <a href="list-student.php"><i class="fafa-users"></i><span>Студенты</span></a>
                <li class="header">Справочники</li>
                <li <?= ($_SERVER['PHP_SELF'] == '/list-gruppa.php') ? 'class="active"' : ''; ?>>

                    <a href="list-gruppa.php"><i class="fa fa-users"></i><span>Группы</span></a>
                <li <?= ($_SERVER['PHP_SELF'] == '/list-grades.php') ? 'class="active"' : ''; ?>>

                    <a href="list-grades.php"><i class="fa fa-address-book"></i><span>Журнал</span></a>
                <?php } ?>

                <?php if (Helper::can('admin')) { ?>
                <li class="header">Пользователи</li>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-teacher.php') ? 'class="active"' : ''; ?>>

                    <a href="list-teacher.php"><i class="fafa-users"></i><span>Преподаватели</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-student.php') ? 'class="active"' : ''; ?>>

                    <a href="list-student.php"><i class="fafa-users"></i><span>Студенты</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-parent.php') ? 'class="active"' : ''; ?>>

                    <a href="list-parent.php"><i class="fafa-users"></i><span>Родители</span></a>

                <li class="header">Справочники</li>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-gruppa.php') ? 'class="active"' : ''; ?>>

                    <a href="list-gruppa.php"><i class="fa fa-users"></i><span>Группы</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-otdel.php') ? 'class="active"' : ''; ?>>

                    <a href="list-otdel.php"><i class="fa fa-users"></i><span>Отделы</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-special.php') ? 'class="active"' : ''; ?>>

                    <a href="list-special.php"><i class="fa fa-users"></i><span>Специальности</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-subject.php') ? 'class="active"' : ''; ?>>

                    <a href="list-subject.php"><i class="fa fa-users"></i><span>Предметы</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-classroom.php') ? 'class="active"' : ''; ?>>

                    <a href="list-classroom.php"><i class="fa fa-users"></i><span>Аудитории</span></a>

                <li <?= ($_SERVER['PHP_SELF'] == '/list-teacher-schedule.php') ? 'class="active"' : ''; ?>>

                    <a href="list-teacher-schedule.php"><i class="fa fa-users"></i><span>Управление расписанием</span></a>

                </li>
                <li <?= ($_SERVER['PHP_SELF'] == '/check-grades.php') ? 'class="active"' : ''; ?>>

                    <a href="check-grades.php"><i class="fa fa-address-book"></i><span>Журнал</span></a>
                <?php } ?>

                <?php if (Helper::can('procreator')) { ?>

                <li class="header">Справочники</li>

                <li <?= ($_SERVER['PHP_SELF'] == '/check-performance.php') ? 'class="active"' : ''; ?>>

                    <a href="check-performance.php"><i class="fa fa-address-book"></i><span>Успеваемоть</span></a>
                <li <?= ($_SERVER['PHP_SELF'] == '/check-payment.php') ? 'class="active"' : ''; ?>>

                    <a href="check-payment.php"><i class="fa fa-usd"></i><span>Оплата</span></a>
                <?php } ?>
        </ul>
    </section>
</aside>