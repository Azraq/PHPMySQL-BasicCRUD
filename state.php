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

            <!-- ADD state FORM -->
            <div class="card card-body">
                <form action="controllers/state_save.php" method="POST">


                    <div class="form-group">
                        <select name="country" class="form-control" placeholder="Country" autofocus>
                            <option value="0">Select a Country</option>
                            <?php   $query = "SELECT * FROM country WHERE status = 0";
                                     $result_countries = mysqli_query($conn, $query);    

                                     while($row = mysqli_fetch_assoc($result_countries)) { ?>

                            <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="State Name">
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="2" class="form-control"
                            placeholder="State Description"></textarea>
                    </div>
                    <input type="submit" name="state_save" class="btn btn-success btn-block" value="Save state">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
          $query = "SELECT country.name as 'country',state.* FROM state INNER JOIN country on country.id = state.country_id WHERE state.status = 0";
          $result_states = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_states)) { ?>
                    <tr>
                        <td><?php echo $row['country']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <a href="controllers/state_edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                                <i class="fas fa-marker"></i>
                            </a>
                            <a href="controllers/state_delete.php?id=<?php echo $row['id']?>" class="btn btn-danger">
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

<?php include('includes/footer.php'); ?>