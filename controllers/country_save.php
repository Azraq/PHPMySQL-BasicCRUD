<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('../db.php');

if (isset($_POST['country_save'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $query = "INSERT INTO country(name, description) VALUES ('$name', '$description')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query failed: ".mysqli_error($conn));
  }

  $_SESSION['message'] = 'Country Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: ../country.php');

}
else{
  header('Location: ../country.php');
}

?>
