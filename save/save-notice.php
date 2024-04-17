<?php
require_once '../secure.php';
if (!Helper::can('manager')) {
    header('Location: 404');
    exit();
}
if (isset($_POST['saveNotice'])) {
    $admin = new Admin();
    $admin->text = Helper::clearString($_POST['text']);
    $admin->user_id = Helper::clearint($_POST['user_id']);
    $admin->child_id = Helper::clearint($_POST['child_id']);
    $admin->subject_id = Helper::clearint($_POST['subject_id']);
    $admin->subject_count = Helper::clearint($_POST['subject_count']);
    $admin->subject_price = Helper::clearint($_POST['subject_price']);
    $admin->link = Helper::clearString($_POST['link']);
    $admin->date = Helper::clearString($_POST['date']);
    if ((new AdminMap())->insertNotice($admin)) {
        header('Location: ../select-parent?message=ok');
    } else {
        header('Location: ../select-parent?message=err');
    }
}

if (isset($_POST['saveNoticeForParent'])) {
    $admin = new Admin();

    $admin->text = Helper::clearString($_POST['text']);
    $admin->user_id = Helper::clearint($_POST['user_id']);
    $admin->child_id = Helper::clearint($_POST['child_id']);
    $admin->subject_id = Helper::clearint($_POST['subject_id']);
    $admin->subject_count = Helper::clearint($_POST['subject_count']);
    $admin->subject_price = Helper::clearint($_POST['subject_price']);
    $admin->link = Helper::clearString($_POST['link']);
    $admin->date = Helper::clearString($_POST['date']);
    if ((new AdminMap())->insertNotice($admin)) {
        header('Location: ../select-parent?message=ok');
    } else {
        header('Location: ../select-parent?message=err');
    }
}

