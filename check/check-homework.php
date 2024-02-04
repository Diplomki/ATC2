<?php
require_once '../secure.php';
if (!Helper::can('teacher')) {
    header('Location: 404');
    exit();
}
require_once '../template/header.php';

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i> Главная</li>
                </ol>
            </section>
            <div class="box-body">
                <a class="btn btn-success" style="width: 250px;" href="../create-homework">Создать домашнее задание</a>
            </div>

            <div class="box-body">
                <a class="btn btn-success" style="width: 250px;" href="check-parent-homework">Проверить домашнее
                    задание</a>
            </div>

        </div>
    </div>
</div>

<?php
require_once '../template/footer.php';
?>