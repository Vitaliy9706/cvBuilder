<?php
session_start();

if(isset($_POST['submit'])){
    include('../config/db.php');

    if(empty($_POST['userName'])){
        header('Location:../register.php?error=emptyName');
        exit;
    }
    if(empty($_POST['email'])){
        header('Location:../register.php?error=emptyEmail');
        exit;
    }
    if(empty($_POST['password'])){
        header('Location:../register.php?error=emptyPassword');
        exit;
    }

    if(!empty($_POST['userName']) && !empty($_POST['email']) && !empty($_POST['password'])){

        //checking email validation
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            header('Location:../register.php?error=invalidEmail');
            exit;
        }

        $userName = mysqli_real_escape_string($connection,strip_tags($_POST['userName']));
        $userEmail = mysqli_real_escape_string($connection,strip_tags($_POST['email']));
        $userPassword = password_hash(mysqli_real_escape_string($connection,$_POST['password']), PASSWORD_DEFAULT);

        //check if username exist
        $sql2 = "SELECT * FROM users WHERE user_name='$userName'";
        $res2 = mysqli_query($connection,$sql2);
        if(mysqli_num_rows($res2) > 0){
            header('Location:../register.php?error=userNameAlreadyExist');
            exit;
        }else{
            //check if user email exist\/
            $sql1 = "SELECT * FROM users WHERE email='$userEmail'";
            $res = mysqli_query($connection,$sql1);
            if(mysqli_num_rows($res) > 0){
                header('Location:../register.php?error=userAlreadyExist');
                exit;
            }else{
                $sql = "INSERT INTO users (user_name,email,password,created_at) VALUES ('$userName','$userEmail','$userPassword',now())";

                $inserted = mysqli_query($connection,$sql);

                if($inserted){

                    $_SESSION['user_name'] = $userName;


                    header('Location:../register.php?success=userCreated');
                    header('Location:../');
                    exit;
                }else{
                    header('Location:../register.php?error=userCreateFailed');
                    exit;
                }
            }
        }


    }
}

?>