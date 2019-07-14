<?php
include('../db.php');

if (isset($_POST['city_save'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $country = $_POST['country'];
  $state = $_POST['state'];
  $query = "INSERT INTO city(name, description,country_id,state_id) VALUES ('$name', '$description','$country','$state')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query failed: ".mysqli_error($conn));
  }

  $_SESSION['message'] = 'City Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: ../city.php');

}
else{    
  header('Location: ../city.php');
}

?>
