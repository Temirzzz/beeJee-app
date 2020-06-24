<?php
require_once('core/config.php');
require_once('core/functions.php');
require_once('template/header_message.php');
$conn = connect();
messages($conn);
close ($conn);
?>

<div class="chieps-field"></div>
<div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-10 col-md-8 col-sm-12">
        <h1 class="text-center mt-3">Новая задача</h1>
        <form method="POST" class="mt-5">
            <div class="form-group">
                <label for="name">Ваше имя</label>
                <input type="text" class="form-control name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Ваш email</label>
                <input type="email" class="form-control email" name="email">
            </div>
            <div class="form-group">
                <label for="content">Введите задачу</label>
                <textarea type="text" class="form-control content" name="content"></textarea>
            </div>
            <button type="submit" class="form-submit-btn btn btn-sm btn-primary" name="done">Добавить</button>   
        </form>
        </div>
    </div>
</div>

<?php require_once('template/footer.php'); ?>