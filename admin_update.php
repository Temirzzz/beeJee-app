<?php
require_once('core/config.php');
require_once('core/functions.php');
$conn = connect();
require_once('./check.php');
get_info($conn);
?>

<?php
if (isset($_POST['content']) AND $_POST['content'] != '') { 
    $content = trim($_POST['content']);

    $sql = "UPDATE tasks set content = '".$content."' WHERE id=".$_GET['id'];    

    if (mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM tasks WHERE content=".$_GET['id'];
        mysqli_query($conn, $sql);        
       
        header('Location: ./admin.php');

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    close ($conn);
}
?>

<?php 
require_once('template/header_admin.php');
?>

<div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-10 col-md-8 col-sm-12">
        <form method="POST" class="mt-5">
            <div class="form-group">
                <label for="content">Введите задачу</label>
                <textarea type="text" class="form-control" name="content"></textarea>
            </div>
            <button type="submit" class="form-submit-btn btn btn-sm btn-primary">Submit</button>   
        </form>
        </div>
    </div>
</div>

