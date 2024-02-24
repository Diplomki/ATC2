<?php
require_once 'secure.php';
if (!Helper::can('admin')) {
    header('Location: 404');
    exit();
}
$id = 0;
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
}

$message = 'Посмотреть оценки';

switch ($_GET['message']) {
    case 'ok':
        $message = '<span style="color: green;">Уведомление отправлено</span>';
        break;
    case 'err':
        $message = '<span style="color: red;">Ошибка при отправке уведомления</span>';
        break;
}
require_once 'template/header.php';

?>
<section class="content-header">
    <h3>
        <b>
            <?= $message; ?>
        </b>
    </h3>
    <ol class="breadcrumb">

        <li><a href="/index"><i class="fa fa-dashboard"></i> Главная</a></li>

        <li>Оценки</li>


    </ol>
</section>
<div class="box-body">
    <div class="form-group">
        <form method="GET" action="list-students-grades">
            <div class="form-group">
                <label>Предмет</label>
                <select class="form-control" name="id">
                    <?php Helper::printSelectOptions(0, (new SubjectMap)->arrSubjects()) ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Далее</button>
            </div>
        </form>
        <div class="form-group">
            <a class="btn btn-primary" href="list-students-grades">Посмотреть оценки по всем дисциплинам</a>
        </div>
    </div>
</div>
<?php

require_once 'template/footer.php';
?>