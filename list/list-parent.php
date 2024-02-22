<?php
require_once '../secure.php';
if (!Helper::can('admin') && !Helper::can('manager') && !Helper::can('teacher')) {
    header('Location: 404');
    exit();
}
$size = 10;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);

} else {
    $page = 1;
}
$parentMap = new ProcreatorMap();
$count = $parentMap->count();
$parent = $parentMap->findAll($page * $size - $size, $size);
$header = 'Список студентов';
require_once '../template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <h3><b>Список родителей</b></h3>
                <ol class="breadcrumb">
                    <li><a href="../index"><i class="fa
fa-dashboard"></i> Главная</a></li>
                    <li class="active">Список
                        родителей</li>
                </ol>
            </section>
            <?php if (Helper::can('admin')) { ?>
                <div class="box-body">
                    <a class="btn btn-success" href="../add/add-parent">Добавить родителя</a>
                </div>

                <div class="box-body">
                    <a class="btn btn-success" href="../add/add-child-parent">Добавить ученика к родителю</a>
                </div>
            <?php } ?>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                if ($parent) {
                    ?>

                    <table id="example2" class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>Ф.И.О</th>
                                <th>Дата рождения</th>
                                <th>Ученик</th>
                                <?php if (Helper::can('manager')) { ?>
                                    <th>Филиал</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($parent as $parent) {
                                echo '<tr>';
                                if (Helper::can('admin')) {
                                    echo '<td><a href="../profile/profile-parent?id=' . $parent->user_id . '">' . $parent->parent_fio . '</a> ' . '<a href="../add/add-parent?id=' . $parent->user_id . '"><i class="fa fa-pencil"></i></a> <a><i class="fa fa-times"></i></a></td>';
                                } elseif (Helper::can('manager')) {
                                    echo '<td><a href="../profile/profile-parent?id=' . $parent->user_id . '">' . $parent->parent_fio . '</a> ' . '<a href="../add/add-parent?id=' . $parent->user_id . '"></a></td>';
                                } else {
                                    echo '<td><p>' . $parent->parent_fio . '</p> ';
                                }
                                echo '<td>' . $parent->birthday . '</td>';
                                echo '<td>' . $parent->child_fio . '</td>';
                                if (Helper::can('manager'))
                                    echo '<td>' . $parent->branch . '</td>';
                                echo '</tr>';

                            }
                            ?>
                        </tbody>
                    </table>
                <?php } else {
                    echo 'Ни одного студента не найдено';
                } ?>
            </div>
            <div class="box-body">
                <?php Helper::paginator($count, $page, $size); ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<?php
require_once '../template/footer.php';
?>