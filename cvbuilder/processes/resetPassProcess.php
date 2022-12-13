<?php
session_start();

if(isset($_POST['submit'])){
    include('../config/db.php');

    if(empty($_POST['email'])){
        header('Location:../resetPassword.php?error=emptyEmail');
        exit;
    }
    if(empty($_POST['password'])){
        header('Location:../resetPassword.php?error=emptyPassword');
        exit;
    }

    if(!empty($_POST['email']) && !empty($_POST['password'])){

        $userEmail = mysqli_real_escape_string($connection,strip_tags($_POST['email']));
        $userPassword = password_hash(mysqli_real_escape_string($connection,$_POST['password']), PASSWORD_DEFAULT);


            //check if user email exist\/
            $sql1 = "SELECT * FROM users WHERE email='$userEmail'";
            $res = mysqli_query($connection,$sql1);
            if(mysqli_num_rows($res) < 0){
                header('Location:../resetPassword.php?error=userNotExist');
                exit;
            }else{
                $sql = "UPDATE users SET password = '$userPassword' WHERE email = '$userEmail'";

                $inserted = mysqli_query($connection,$sql);

                if($inserted){
                    $update = "UPDATE users SET code = 'NULL' WHERE email = '$userEmail'";
                    $updateResult = mysqli_query($connection,$update);

                    $_SESSION['user_name'] = $userName;


                    header('Location:../resetPassword.php?success=passwordUpdated');
                    header('Location:../');
                    exit;
                }else{
                    header('Location:../resetPassword.php?error=failed');
                    exit;
                }
            }
        }


    }

?>