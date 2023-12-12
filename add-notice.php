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
<form action="save-notice" method="post">
    <div class="form-group">
        <label>Текст уведомления</label>
        <input class="form-control" type="text" name="text" value="Оплатите до указанного срока по предмету:">
    </div>

    <div class="form-group">
        <label>Для кого</label>
        <select class="form-control" name="child_id">
            <?php Helper::printSelectOptions(0, (new ProcreatorMap())->arrChilds($id)) ?>
        </select>
        <input type="hidden" name="user_id" value=<?= $id ?>>
    </div>

    <div class="form-group">
        <label>Предмет</label>
        <select class="form-control" name="subject_id">
            <?php Helper::printSelectOptions(0, (new SubjectMap())->arrSubjects()) ?>
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