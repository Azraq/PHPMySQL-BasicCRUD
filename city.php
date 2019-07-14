<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <!-- MESSAGES -->

            <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php session_unset(); } ?>

            <!-- ADD city FORM -->
            <div class="card card-body">
                <form action="controllers/city_save.php" method="POST">


                <div class="form-group">
                        <select name="country" id="country"  class="form-control" placeholder="Country" onchange="get_states()" autofocus>
                            <option value="0">Select a Country</option>
                            <?php   $query = "SELECT * FROM country WHERE status = 0";
                                     $result_countries = mysqli_query($conn, $query);    

                                     while($row = mysqli_fetch_assoc($result_countries)) { ?>

                            <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" id="state">
                        <select  name="state" class="form-control" placeholder="State">
                            <option value="0">Select a State</option>       
                        </select>             
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="City Name">
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="2" class="form-control"
                            placeholder="City Description"></textarea>
                    </div>
                    <input type="submit" name="city_save" class="btn btn-success btn-block" value="Save city">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>State</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
          $query = "SELECT country.name as 'country',state.name as 'state',city.* FROM city INNER JOIN country on country.id = city.country_id INNER JOIN state on state.id = city.state_id WHERE city.status = 0";
          $result_cities = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_cities)) { ?>
                    <tr>
                        <td><?php echo $row['country']; ?></td>
                        <td><?php echo $row['state']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <a href="controllers/city_edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                                <i class="fas fa-marker"></i>
                            </a>
                            <a href="controllers/city_delete.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script type="text/javascript">
function get_states() { // Call to ajax function
    var country_id = $('#country').val();
    var dataString = "country="+country_id;
    $.ajax({ 
        type: "POST",
        url: "controllers/state_getByCountryId.php", // Name of the php file that will return states based on country_id
        data: dataString,
        success: function(html)
        {
            $("#state").html(html);

        },
        error: function (jqXHR, textStatus, errorThrown) { alert('Failed to retrieve states'); }
        
    });
}
</script>
<?php include('includes/footer.php'); ?>



