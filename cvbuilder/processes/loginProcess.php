<?php
session_start();

if(isset($_POST['submit'])){
    include('../config/db.php');


    if(empty($_POST['email'])){
        header('Location:../login.php?error=emptyEmail');
        exit;
    }
    if(empty($_POST['password'])){
        header('Location:../login.php?error=emptyPassword');
        exit;
    }

    if(!empty($_POST['email']) && !empty($_POST['password'])){

        //checking email validation
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            header('Location:../login.php?error=invalidEmail');
            exit;
        }

        $userEmail = mysqli_real_escape_string($connection,strip_tags($_POST['email']));
        $userPassword = mysqli_real_escape_string($connection,$_POST['password']);

        $sql = "SELECT * FROM users WHERE email='$userEmail'";

        $userFound = mysqli_query($connection,$sql);

        if($userFound){

            if(mysqli_num_rows($userFound) > 0){
                while($row = mysqli_fetch_assoc($userFound)){
                    if(password_verify($userPassword,$row['password'])){
                        $_SESSION['user_name'] = $row['user_name'];
                    }else{
                        header('Location:../login.php?error=wrongPassword');
                        exit;
                    }
                }
            }else{
                header("Location:../login.php?error=wrongEmail&email='$userEmail'");
                exit;
            }


            header('Location:../index.php?success=loggedIn');

        }else{
            header('Location:../login.php?error=userLoginFailed');
            exit;
        }

    }
}

?>