<?php

include("../db.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "UPDATE city set status = 1  WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query failed: ".mysqli_error($conn));
  }

  $_SESSION['message'] = 'City Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: ../city.php');
}

?>
