<?php

if(isset($_POST['submit'])){
    include('../config/db.php');

    if(!empty($_POST['email'])){

        //checking email validation
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            header('Location:../verifyOtp.php?error=invalidEmail');
            exit;
        }

        $userEmail = mysqli_real_escape_string($connection,strip_tags($_POST['email']));
        $userOTP = mysqli_real_escape_string($connection,strip_tags($_POST['otp']));


        $sql = "SELECT * FROM users WHERE email='$userEmail' AND code='$userOTP'";

        $userFound = mysqli_query($connection,$sql);

        if($userFound){

            if(mysqli_num_rows($userFound) > 0){
                header("Location:../resetPassword.php?email=$userEmail");
            }else{
                header("Location:../verifyOtp.php?error=wrongOTP&email=$userEmail");
                exit;
            }

        }else{
            header('Location:../verifyOtp.php?error=verificationFailed');
            exit;
        }

    }
}

?>