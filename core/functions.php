<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function connect(){
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    mysqli_set_charset($conn, "utf8");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function select ($conn) {

    $sql = "SELECT * FROM tasks ORDER BY id DESC"; 
    $result = mysqli_query($conn, $sql);
    $a = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    }
    return $a;
}

function select_main ($conn) {
    $offset = 0;

    if (isset($_GET['page']) AND trim($_GET['page']) != '') {
        $offset = trim($_GET['page']);
    }

    $sql = "SELECT * FROM tasks ORDER BY id DESC LIMIT 3 OFFSET ".$offset*3; //обязательный отступ после OFFSET
   
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $a[] = $row;
        }
    }      
    return $a;
}

function messages ($conn) {
   
    if (isset($_POST['name']) AND isset($_POST['email']) AND isset($_POST['content'])) {
        $name = strip_tags(trim($_POST['name']));
        $email = strip_tags(trim($_POST['email']));
        $content = strip_tags(trim($_POST['content']));  
        

        $sql = "INSERT INTO tasks (name, email, content) VALUES ('$name', '$email', '$content')";
        

        if (mysqli_query($conn, $sql)) {
            setcookie('success', 1, time()+5);
            header('Location: ./');
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
     
    }
}

function genHash ($length = 5) {
    $symbol = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789";
    $code = "";
    for ($i = 0; $i < $length; $i++) {
        $code .= $symbol[rand(0, strlen($symbol) -1)];
    }
    return $code;
}

function pagination_count ($conn) {
    $sql = "SELECT * FROM tasks";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_num_rows($result);
    return ceil($result/3);
}

function get_info ($conn) {
    $sql = "SELECT * FROM tasks";
    $result = mysqli_query($conn, $sql);

    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $a[] = $row;
        }
    }          
    return $a;
}

function close ($conn) {
    mysqli_close($conn);
}