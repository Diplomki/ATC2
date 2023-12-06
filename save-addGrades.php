<?php
require_once 'secure.php';
if(!Helper::can('teacher')) {
    header('Location: 404');
    exit();
}

if(isset($_POST['formSubmit'])) {
    $flag = false;
    foreach($_POST['grade_id'] as $user_id => $grade) {
        $student = new Student();
        $student->subject_id = $_POST['subject_id'][$user_id];
        $student->user_id = $user_id;
        $student->attend = $_POST['attend'][$user_id];
        $student->grade = $grade;
        (new StudentMap())->saveAddGrades($student);
        $flag = true;
    }
    if($flag) {
        header('Location: list-grades?message=ok');
        exit();
    } else {
        header('Location: list-grades?message=err');
        exit();
    }

}

?>