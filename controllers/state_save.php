<?php
include('../db.php');

if (isset($_POST['state_save'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $country = $_POST['country'];
  $query = "INSERT INTO state(name, description,country_id) VALUES ('$name', '$description','$country')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query failed: ".mysqli_error($conn));
  }

  $_SESSION['message'] = 'State Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: ../state.php');

}
else{    
  header('Location: ../state.php');
}

?>
