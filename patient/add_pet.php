<?php
session_start();
include("../connection.php");

?>

<div class=" " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Pet</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <form method="POST" action="../admin/functions/add_pet.php">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="date" name="date">

                    <?php


                    ?>
                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                    <!-- <input type="hidden" class="form-control"   name="contact" value="<?php echo $_SESSION['p'] ?>"> -->

                    <div class="mb-3">
                        <label for="pet_baka" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category" required>
                            <option selected>Open this select menu</option>
                            <?php
                            $query =
                                "SELECT * FROM category_list";


                            $results = mysqli_query($database, $query);


                            while ($row = $results->fetch_assoc()) { ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>

                            <?php }

                            ?>

                        </select>
                    </div>


                    <div class="mb-3">

                        <label for="pet_name" class="form-label">Pet Name</label>
                        <input type="text" class="form-control" id="pet_name" name="pet_name" placeholder="Abu">
                    </div>
                    <div class="mb-3">

                        <label for="pet_age" class="form-label">Age</label>
                        <input type="text" class="form-control" id="pet_age" name="pet_age" placeholder="3">
                    </div>

                    <div class="mb-3">

                        <label for="pet_gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="pet_gender" name="pet_gender" placeholder="Female">
                    </div>

                    <div class="mb-3">
                        <label for="pet_baka" class="form-label">Jenis Breed</label>
                        <input type="text" class="form-control" id="pet_baka" name="pet_baka" placeholder="Persian">
                    </div>


                    <!-- <div id="circum2" class="d-none">

                            <div class="form-check form-check-inline  ">
                                <input class="form-check-input" type="radio" name="circum" id="inlineRadio1" value="Circumcision Male">
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="circum" id="inlineRadio2" value="Circumcision Female">
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                        </div> -->


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add_pet">Add changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<script>