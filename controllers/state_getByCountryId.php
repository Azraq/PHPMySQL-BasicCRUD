<?php
include('../db.php');

if ($_POST) {
    $country = $_POST['country'];
    if ($country != '') {
       $sql = "SELECT * FROM state WHERE country_id = " . $country." AND status = 0";
       $result_states = mysqli_query($conn,$sql);
       echo '<select  name="state" class="form-control" placeholder="State">';
       echo '<option value="0">Select a State</option>'; 
       while ($row = mysqli_fetch_assoc($result_states)) {
          echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';}
       echo '</select>';
    }
    else
    {
        echo  '';
    }
}


?>