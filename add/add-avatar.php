<?php
require_once '../secure.php';

$id = 0;
if (isset($_GET['id'])) {
    $id = Helper::clearInt($_GET['id']);
}

$student = (new StudentMap())->findById($id);
$userMap = new UserMap();
$user = $userMap->findById($id);

if (!Helper::can('procreator')) {
    header('Location: 404');
    exit();
}

if ($user->role_id != 5) {
    header('Location: ../index');
    exit();
}

require_once '../template/header.php';
?>
<section class="content-header">
    <h3>
        <b>
            Редактировать фото студента
        </b>
    </h3>
    <ol class="breadcrumb">

        <li><a href="../index"><i class="fa fa-
dashboard"></i> Главная</a></li>

        <li><a href="../list/list-student">Студенты</a></li>

        <li class="active">
            Редактировать фото студента
        </li>
    </ol>
</section>
<div class="box-body">
    <form action="../save/save-user" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" name="photo" id="fileInput" style="display: none;" required="required">
            <span id="fileNameLabel">Добавьте фото для загрузки</span><br>
            <label for="fileInput" class="btn btn-primary">Выберите файл</label>
            <span id="fileName"></span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="saveAvatarStudent" value="<?= $user->user_id ?>">
    </form>
</div>

<script>
    document.getElementById('fileInput').addEventListener('change', function () {
        var fileName = this.files[0].name; // Получаем имя выбранного файла
        document.getElementById('fileName').innerText = fileName; // Обновляем текст сообщения справа
    });

    document.getElementById('fileInput').addEventListener('change', function () {
        var fileName = this.value.split('\\').pop(); // Получаем имя выбранного файла
        if (fileName) {
            document.getElementById('fileNameLabel').style.display = 'none'; // Скрываем надпись
            document.getElementById('fileName').innerText = fileName; // Выводим имя файла (опционально)
        } else {
            document.getElementById('fileNameLabel').style.display = 'block'; // Показываем надпись, если файл не выбран
            document.getElementById('fileName').innerText = ''; // Очищаем текст в элементе для имени файла (опционально)
        }
    });
</script>

<?php
require_once '../template/footer.php';
?>