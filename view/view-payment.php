<?php
require_once '../secure.php';
if (!Helper::can('admin') && !Helper::can('manager')) {
    header('Location: 404');
    exit();
}
$id = 0;
if (isset ($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
}

$message = 'Сверка оплаты';

require_once '../template/header.php';

?>
<section class="content-header">
    <h3>
        <b>
            <?= $message; ?>
        </b>
    </h3>
    <ol class="breadcrumb">

        <li><a href="/index"><i class="fa fa-dashboard"></i> Главная</a></li>

        <li>Сверка оплаты</li>


    </ol>
</section>
<div class="box-body">
    <div class="form-group">
        <form method="GET" action="../list/list-payment">
            <div class="form-group">
                <label>Дата</label>
                <input class="form-control" type="date" name="date" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Далее</button>
            </div>

        </form>
    </div>
</div>
<?php

require_once '../template/footer.php';
?>