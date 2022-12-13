<?php
include('includes/header.php');
include('config/db.php');
$email = $_GET['email']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CVBuilder</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <header>
        <?php
            include('includes/navigation.php');
         ?>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-4 ">
                <?php

                if($_GET['success']){
                    if($_GET['success'] == 'userUpdated'){
                        ?>
                            <small class="form-text text-success">User Profile has been updated sucessfully</small>
                        <?php
                    }
                }

                if(isset($_GET['error'])){

                    if($_GET['error'] == 'emptyEmail'){
                        ?>
                            <small class="form-text text-danger">Email should not be empty!</small>
                        <?php
                    }else if($_GET['error'] == 'invalidFileType'){
                        ?>
                            <small class="form-text text-danger">Invalid file type, only png, jpg and jpeg are allowed</small>
                        <?php
                    }else if($_GET['error'] == 'invalidFileSize'){
                        ?>
                            <small class="form-text text-danger">Invalid file size, image size should not be more than 5mb</small>
                        <?php
                    }
                }
                ?>
                <form class="m-auto" action="processes/userPersonalInfoUpdate.php" method="POST" enctype="multipart/form-data">
                <h2>Personal Information</h2>
                    <?php
                        $currentuser = $_SESSION['user_name'];
                        $sql = "SELECT * FROM users WHERE user_name='$currentuser'";

                        $gotResults = mysqli_query($connection,$sql);

                        if($gotResults){
                            if(mysqli_num_rows($gotResults)>0){
                                while($row = mysqli_fetch_array($gotResults)){
                                    ?>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                            <img src="public/userImages/<?php echo $row['user_image']; ?>" class="img-thumbnail" alt="profile">
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="inputJobTitle">Job Title</label>
                                            <input type="text" class="form-control" id="inputJobTitle" name="jobTitle" value="<?php echo $row['job_title']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputImage">Profile picture</label>
                                            <input type="file" name="userImage" class="form-control" id="inputImage">
                                            <input type="text" name="old_pp" value="<?php echo $row['user_image']; ?>" hidden>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                            <label for="inputFirstName">First Name</label>
                                            <input type="text" class="form-control" id="inputFirstName" name="firstName" value="<?php echo $row['f_name']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="inputLastName">Last Name</label>
                                            <input type="text" class="form-control" id="inputLastName" name="lastName" value="<?php echo $row['l_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" name="email" id="inputEmail4" value="<?php echo $row['email']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="inputNumber">Phone Number</label>
                                            <input type="text" class="form-control" id="inputNumber" name="phoneNumber" value="<?php echo $row['p_number']; ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="inputCity">City</label>
                                            <input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $row['city']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress">Address</label>
                                            <input type="text" class="form-control" id="inputAddress" name="address" value="<?php echo $row['u_address']; ?>">
                                        </div>
                                        <hr>
                                        <small>Social Links</small>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                            <label for="inputLinkedIn">LinkedIn</label>
                                            <input type="text" class="form-control" id="inputLinkedIn" name="linkedin" value="<?php echo $row['linkedin']; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                            <label for="inputFacebook">Facebook</label>
                                            <input type="text" class="form-control" id="inputFacebook" name="facebook" value="<?php echo $row['facebook']; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                            <label for="inputInstagram">Instagram</label>
                                            <input type="text" class="form-control" id="inputInstagram" name="instagram" value="<?php echo $row['instagram']; ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <small>Profile Description</small>
                                        <hr>
                                        <div class="form-group">
                                            <label for="inputProfileDesc">Profile Description</label>
                                            <input type="text" class="form-control" id="inputProfileDesc" name="profileDesc" value="<?php echo $row['p_desc']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" class="btn btn-info" value="Save">
                                        </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                    
                </form>
            </div>
            <div class="col-md-6">
                <img src="assets/images/cv.png" alt="cv" class="img-thumbnail">
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
