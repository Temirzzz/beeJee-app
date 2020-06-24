<?php
require_once('core/config.php');
require_once('core/functions.php');
$conn = connect();

$sql = "UPDATE tasks SET complete=1 WHERE id=".$_GET['id'];    

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }
  header('Location: ./admin.php');
  close ($conn); 
?>