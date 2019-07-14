<?php
include("../db.php");
$name = '';
$description= '';
$country_id= '';
$state_id= '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM city WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $country_id = $row['country_id'];
    $state_id = $row['state_id'];
    $name = $row['name'];
    $description = $row['description'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $country_id = $_POST['country'];
  $state_id = $_POST['state'];
  $name= $_POST['name'];
  $description = $_POST['description'];

  $query = "UPDATE city set name = '$name', description = '$description',country_id = '$country_id' ,state_id = '$state_id' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'City Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: ../city.php');
}

?>
<?php include('../includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="city_edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
            <select name="country" id="country" class="form-control" placeholder="Country" onchange="get_states()" autofocus>
                <option value="0">Select a Country</option>
                <?php   $query = "SELECT * FROM country WHERE status = 0";
                            $result_countries = mysqli_query($conn, $query);    

                            while($row = mysqli_fetch_assoc($result_countries)) { ?>

                <option value="<?php echo $row['id']?>" <?php if($country_id == $row['id']) echo "SELECTED";?> ><?php echo $row['name']?></option>
                <?php } ?>
            </select>
        </div>
        <div id = "state" class="form-group">
            <select name="state" class="form-control" placeholder="State" autofocus>
                <option value="0">Select a State</option>
                <?php   $query = "SELECT * FROM state WHERE status = 0 AND country_id = ".$country_id;
                            $result_states = mysqli_query($conn, $query);    

                            while($row = mysqli_fetch_assoc($result_states)) { ?>

                <option value="<?php echo $row['id']?>" <?php if($state_id == $row['id']) echo "SELECTED";?> ><?php echo $row['name']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
          <input name="name" type="text" class="form-control" value="<?php echo $name; ?>" placeholder="Update Name">
        </div>
        <div class="form-group">
        <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $description;?></textarea>
        </div>
        <button class="btn-success" name="update">
          Update
</button>
      </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function get_states() { // Call to ajax function
    var country_id = $('#country').val();
    var dataString = "country="+country_id;
    $.ajax({ 
        type: "POST",
        url: "../controllers/state_getByCountryId.php", // Name of the php file that will return states based on country_id
        data: dataString,
        success: function(html)
        {
            $("#state").html(html);

        }
        ,error: function (jqXHR, textStatus, errorThrown) { alert('Failed to retrieve states'+errorThrown); }
        
    });
}
</script>
<?php include('../includes/footer.php'); ?>
