<?php
require_once 'secure.php';
if (!Helper::can('admin') && !Helper::can('manager')) {
    header('Location: 404');
    exit();
}
$id = 0;
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
}
$teacher = (new TeacherMap())->findById($id);
$header = (($id) ? 'Редактировать данные' : 'Добавить') . '
преподавателя';
require_once 'template/header.php';
?>
<section class="content-header">
    <h3>
        <b>
            <?= $header; ?>
        </b>
    </h3>
    <ol class="breadcrumb">

        <li><a href="/index"><i class="fa fa-
dashboard"></i> Главная</a></li>

        <li><a href="list-
teacher">Преподаватели</a></li>

        <li class="active">
            <?= $header; ?>
        </li>
    </ol>
</section>
<div class="box-body">
    <form action="save-user" method="POST">
        <?php require_once '_formUser.php'; ?>
        <div class="form-group">
            <label>Отделение</label>
            <select class="form-control" name="otdel_id">
                <?= Helper::printSelectOptions($teacher->otdel_id, (new OtdelMap())->arrOtdels()); ?>
            </select>
        </div>
        <div class="form-group">
            <label>Заблокировать</label>
            <div class="radio">
                <label>
                    <input type="radio" name="active" value="1" class="input-radio" <?= ($user->active) ? 'checked' : ''; ?>> Нет
                </label> &nbsp;
                <label>
                    <input type="radio" name="active" value="0" class="input-radio" <?= (!$user->active) ? 'checked' : ''; ?>> Да
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" name="saveTeacher" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>
<?php
require_once 'template/footer.php';
?>