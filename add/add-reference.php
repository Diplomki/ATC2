<?php
require_once('../secure.php');
if (!Helper::can('procreator')) {
    header('Location: 404');
    exit();
}

$id = 0;
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
}

$student = (new StudentMap())->findById($id);

require_once('../template/header.php');
?>

<section class="content-header">
    <h3>
        <b>
            Добавить справку
        </b>
    </h3>
    <ol class="breadcrumb">

        <li><a href="../index"><i class="fa fa-dashboard"></i> Главная</a></li>


        <li class="active">
            Добавить справку
        </li>
    </ol>
</section>

<div class="box-body">
    <form action="../save/save-reference" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" name="reference" required="required">
        </div>
        <input type="hidden" name="user_id" value="<?= $student->user_id ?>">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>
<?php
require_once('../template/footer.php');
?>