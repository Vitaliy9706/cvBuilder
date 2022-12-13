<?php
include('includes/header.php');
include('config/db.php');

$currentuser = $_SESSION['user_name'];
$sql = "SELECT * FROM users WHERE user_name='$currentuser'";

$gotResults = mysqli_query($connection,$sql);

if($gotResults){
    if(mysqli_num_rows($gotResults)>0){
        while($row = mysqli_fetch_array($gotResults)){
            $id = $row['id'];
        }
    }
}
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

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
        <?php
            if(!isset($_SESSION['user_name'])){
                ?>
                <h1 class="display-3">Log In to create your CV</h1>
                <p><a class="btn btn-primary btn-lg" href="login.php" role="button">Login »</a></p>
            </div>
            </div>
            <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>Step 1</h2>
            <p>Create your account </p>
            <p><a class="btn btn-secondary" href="register.php" role="button">Register »</a></p>
          </div>
          <div class="col-md-4">
            <h2>Step 2</h2>
            <p>Fill up the forms with your personal Information, Skills, Education, Experience, Interests and add your references </p>
          </div>
          <div class="col-md-4">
            <h2>Step 3</h2>
            <p>Generate your CV and share with employer</p>
          </div>
        </div>

        <hr>

      </div> <!-- /container -->
                <?php
                    }else{
                        ?>
                            <h1 class="display-3">Hello, <?php echo ucfirst($_SESSION['user_name']); ?>!</h1>
                            <p>This web application will help you create an outstanding CV/Resume that you can share with your employer.</p>
                            </div>
                    </div>
                            <div class="container">
                            <!-- Example row of columns -->
                            <div class="row">
                              <div class="col-md-12">
                                <h2>Let's crete your CV in 2 easy steps</h2>
                                <hr>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <h3>Step 1</h3>
                                <p>Fill up the forms with your personal Information, Skills, Education, Experience, Interests and add your references </p>
                                <p><a class="btn btn-secondary" href="personalInfo.php" role="button">View details »</a></p>
                              </div>
                              <div class="col-md-6">
                                <h3>Step 2</h3>
                                <p>Generate your CV and share with employer</p>
                                <p><a class="btn btn-secondary" href="cv/template.php?id=<?php echo $id; ?>" role="button">Generate CV »</a></p>
                              </div>
                            </div>

                            <hr>

                          </div> <!-- /container -->
                    
                        <?php
                    }

                ?>
        </div>
      </div>

    </main>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
