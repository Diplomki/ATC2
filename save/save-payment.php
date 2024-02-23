<?php
require_once '../secure.php';
if (!Helper::can('manager')) {
    header('Location: 404');
    exit();
}
if (isset($_POST['savePayment'])) {
    $student = new Student();
    $student->user_id = Helper::clearInt($_POST['child_id']);
    $student->subject_id = Helper::clearInt($_POST['subject_id']);
    $student->subject_count = Helper::clearInt($_POST['subject_count']);
    $student->subject_price = Helper::clearInt($_POST['subject_price']);
    $student->tab = time() . $_FILES["fileToUpload"]["name"];
    $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];

    move_uploaded_file($fileTmpName, "../uploads/" . $student->tab);

    if ((new StudentMap())->savePayment($student)) {
        header('Location: ../check/check-child?message=ok');
    } else {
        header('Location: ../check/check-child?message=err');
    }
}

