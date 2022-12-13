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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 padding-top-10">
                <form class="form-signin mt-2" action="processes/loginProcess.php" method="post">
                    <h1 class="h3 mb-3 font-weight-normal text-center">Please login into your account</h1>
                    <?php
                        if(isset($_GET['error'])){
                            
                            if($_GET['error'] == 'emptyEmail'){
                                ?>
                                    <small class="form-text text-danger">Email is required!</small>
                                <?php
                            }else if($_GET['error'] == 'emptyPassword'){
                                ?>
                                    <small class="form-text text-danger">Password is required!</small>
                                <?php
                            }else if($_GET['error'] == 'invalidEmail'){
                                ?>
                                    <small class="form-text text-danger">Email is invalid!</small>
                                <?php
                            }else if($_GET['error'] == 'userLoginFailed'){
                                ?>
                                    <small class="form-text text-danger">Oops... Something went wrong, try again!</small>
                                <?php
                            }else if($_GET['error'] == 'wrongPassword'){
                                ?>
                                    <small class="form-text text-danger">Seems like you forgot your password</small>
                                <?php
                            }else if($_GET['error'] == 'wrongEmail'){
                                ?>
                                    <small class="form-text text-danger">User <?php echo $email ?> doesn't exist</small>
                                <?php
                            }
                        }else if(isset($_GET['success'])){
                            if($_GET['success'] == 'loggedIn'){
                                ?>
                                <small class="form-text text-success">User has been logged in successfully!</small>
                            <?php
                            }
                        }
                    ?>
                    <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email address" autofocus="">
                    </div>
                    <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                    <input type="submit" name="submit" value="Login" class="btn btn-lg btn-primary btn-block">
                    <small class="form-text text-primary py-3"><a href="forgotPassword.php">Forgot your password?</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
