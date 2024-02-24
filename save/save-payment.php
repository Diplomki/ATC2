<?php
require_once '../secure.php';
if (!Helper::can('manager')) {
    header('Location: 404');
    exit();
}
$parent_id = (new StudentMap())->findParentByStudentId($_POST['child_id']);
if (isset($_POST['savePayment'])) {
    $student = new Student();
    $student->parent_id = Helper::clearint($parent_id);
    $student->user_id = Helper::clearInt($_POST['child_id']);
    $student->subject_id = Helper::clearInt($_POST['subject_id']);
    $student->subject_count = Helper::clearInt($_POST['subject_count']);
    $student->subject_price = Helper::clearInt($_POST['subject_price']);
    $student->tab = time() . $_FILES["fileToUpload"]["name"];
    $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];

    move_uploaded_file($fileTmpName, "../uploads/" . $student->tab);


    if ((new StudentMap())->savePayment($student)) {
        header('Location: ../add/add-payment?message=ok');
    } else {
        header('Location: ../add/add-payment?message=err');
    }
}

