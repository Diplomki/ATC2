<?php
require_once '../secure.php';

$id = 0;

$size = 10;

if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
}

if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}

$procreatorMap = new ProcreatorMap();
$notice = $procreatorMap->findNoticeById($id);
require_once '../template/header.php';
$header = "Оплата";
?>

<section class="content-header">
    <h3><b>
            <?= $header ?>
        </b></h3>
    <ol class="breadcrumb">
        <li><a href="../index"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Оплата</li>
    </ol>
</section><br>
<form action="../save/save-payment" method="post" enctype="multipart/form-data">
    <div class="box-body">
        <table class="table table-bordered table-hover">
            <tr>
                <th>Текст уведомления</th>
                <td>
                    <?= $notice->text ?>
                </td>
            </tr>
            <tr>
                <th>Предмет</th>
                <td>
                    <?= $notice->subject ?>
                </td>
            </tr>
            <tr>
                <th>За кого</th>
                <td>
                    <?= $notice->fio ?>
                </td>
            </tr>
            <tr>
                <th>Количество предметов</th>
                <td>
                    <?= $notice->subject_count ?>
                </td>
            </tr>
            <tr>
                <th>Цена</th>
                <td>
                    <?= $notice->subject_price ?>
                </td>
            </tr>
            <tr>
                <th>До</th>
                <td>
                    <?= $notice->date; ?>
                </td>
            </tr>
        </table>
    </div>
</form>

<?php
require_once '../template/footer.php';

?>