<?php
require_once '../secure.php';
if (!Helper::can('admin')) {
    header('Location: 404');
    exit();
}
if (isset($_POST['saveNotice'])) {
    $admin = new Admin();
    $admin->text = Helper::clearString($_POST['text']);
    $admin->user_id = Helper::clearint($_POST['user_id']);
    $admin->child_id = Helper::clearint($_POST['child_id']);
    $admin->subject_id = Helper::clearint($_POST['subject_id']);
    $admin->date = Helper::clearString($_POST['date']);
    if ((new AdminMap())->insertNotice($admin)) {
        header('Location: ../select-parent?message=ok');
    } else {
        header('Location: ../select-parent?message=err');
    }
}

