<?php
require_once('secure.php');
if (!Helper::can('teacher')) {
    header('Location: 404');
}

if (isset($_POST['saveHomeworkStudent'])) {
    $teacher = new Teacher();
    $teacher->id = $_POST['id'];
    $teacher->user_id = $_POST['user_id'];
    $teacher->grade = $_POST['grade'];
    $teacher->subject_id = $_POST['subject_id'];
    if ((new TeacherMap())->insertGradeFromHomework($teacher)) {
        header('Location: check-parent-homework?message=ok');
    } else {
        header('Location: check-parent-homework?message=err');
    }
    exit;
}