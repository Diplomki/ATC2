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
$userMap = new UserMap();

$message = 'Создать уведомление';

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

        <li>Уведомления</li>


    </ol>
</section>
<div class="box-body">
    <form action="save-notice" method="POST">
        <div class="form-group">
            <label>Текст уведомления</label>
            <input class="form-control" type="text" name="text">
        </div>
        <div class="form-group">
            <label>Кому</label>
            <select class="form-control" name="user_id">
                <?php Helper::printSelectOptions(0, $userMap->ArrParents()) ?>
            </select>
        </div>
        <div class="form-group">
            <label>Оплатить до</label>
            <input type="date" class="form-control" name="date">
        </div>
        <div class="form-group">
            <button type="submit" name="saveNotice" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>
<?php
require_once 'template/footer.php';
?>