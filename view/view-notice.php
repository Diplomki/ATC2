<?php
require_once('../secure.php');
require_once('../template/header.php');

$notice = (new ProcreatorMap())->notice();
?>
<section class="content-header">
    <h3><b>
            <?= $message = isset($_GET['message']) ? Helper::getQuery($_GET['message']) : 'Уведомления'; ?>
        </b></h3><br>
</section>
<?php
foreach ($notice as $item) {
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <p style='font-size: 16px;'>
                        <?= $item->text ?>
                    </p>
                    <p><b style='font-size: 16px;'>
                            <?= $item->child ?> ->
                            <?= $item->subject ?> ->
                            <?= $item->date ?>
                        </b></p>
                    <form action="../add/add-payment" method="get">
                        <input class="btn btn-primary" type="submit" value="Оплатить">
                        <input type="hidden" name="id" value="<?= $item->id ?>">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
}
?>
<?php
require_once('../template/footer.php');
?>