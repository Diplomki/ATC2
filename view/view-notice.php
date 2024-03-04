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
    $text = "Оплатите сумму указанную в приложении";
    if (strtolower($item->text) == strtolower($text)) {
        $text = mb_substr($text, 8);
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <p style="font-size: 16px;">Оплатите
                            <b>
                                за
                                <?= $item->child ?>
                                по предмету

                                <?= $item->subject ?>
                            </b>
                            <?= $text ?> до <b>
                                <?= $item->date ?> по ссылке

                            </b>
                            <?= $item->link ?>
                        </p>
                        <form action="../add/add-payment" method="get">
                            <input class="btn btn-primary" type="submit" value="Оплатить">
                            <input type="hidden" name="id" value="<?= $item->id ?>">
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <p style="font-size: 16px;">
                            <?= $item->text ?>
                            <b>
                                <?= $item->child ?>
                                <?= $item->subject ?>
                                до
                                <?= $item->date ?>
                                по ссылке
                            </b>
                            <?= $item->link ?>
                        </p>
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
}
?>
<?php
require_once('../template/footer.php');
?>