<?php
require_once('core/config.php');
require_once('core/functions.php');
require_once('template/header_login.php');
$conn = connect();

if (isset($_POST['password']) AND $_POST['password'] != '') {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $query = mysqli_query($conn, "SELECT id, password FROM `admin` WHERE login='".$login."'LIMIT 1");

    $row = mysqli_fetch_assoc($query);
  
    
    if ($row['password'] == md5($_POST['password'])) {
        $hash = genHash (20);
        mysqli_query($conn, "UPDATE admin SET hash='".$hash."' WHERE id=".$row['id']);
        setcookie('id', $row['id'], time()+30*24*60*60);
        setcookie('hash', $hash, time()+30*24*60*60, null, null, null, true);
        header('Location: ./admin.php');
        exit();
    }
    else {
        echo "<p class='danger'>Введите верные данные</p>";
    }
}

close ($conn);
?>

<div class="chieps-field"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <h2 class="text-center mt-5">Панель администратора</h2>
            <form method="POST" class="mt-5">
                <div class="form-group">
                    <label for="login">Email</label>
                    <input type="text" class="form-control name" name="login">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control password" name="password">
                </div>                
                <button class="btn btn-info form-submit-btn" type="submit">Войти</button>
            </form>
        </div>
    </div>
</div>

<?php require_once('template/footer.php'); ?>