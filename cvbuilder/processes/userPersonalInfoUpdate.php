<?php
session_start();

if(isset($_POST['submit'])){
    include('../config/db.php');

    $userJobTitle = $_POST['jobTitle'];
    $userFirstName = $_POST['firstName'];
    $userLastName = $_POST['lastName'];
    $userEmail = $_POST['email'];
    $userPhoneNumber = $_POST['phoneNumber'];
    $userCity = $_POST['city'];
    $userAddress = $_POST['address'];
    $userLinkedin = $_POST['linkedin'];
    $userFacebook = $_POST['facebook'];
    $userInstagram = $_POST['instagram'];
    $userProfileDesc = $_POST['profileDesc'];
    $old_pp = $_POST['old_pp'];
    $userImage = $_FILES['userImage'];

    if(!empty($userEmail)){


        $imageName = $userImage ['name'];
        $fileType = $userImage ['type'];
        $fileSize = $userImage ['size'];
        $fileTmpName = $userImage ['tmp_name'];
        $fileError = $userImage ['error'];

        $fileData = explode('/',$fileType);
        $fileExtension = $fileData[count($fileData)-1];

        if(isset($_FILES['userImage']['name']) && !empty($_FILES['userImage']['name'])){
            if($fileExtension == 'jpg' || $fileExtension == 'png' || $fileExtension == 'jpeg'){
                //Process
                if($fileSize < 500000){
                    $fileNewName = "../public/userImages/".$imageName;
                    $old_pp_des = "../public/userImages/$old_pp";
                    if(unlink($old_pp_des)){
                        $uploaded = move_uploaded_file($fileTmpName,$fileNewName);
                    }else{
                        $uploaded = move_uploaded_file($fileTmpName,$fileNewName);
                    }
    
                    if($uploaded){
                        $loggedInUser = $_SESSION['user_name'];
                        $sql = "UPDATE users SET email = '$userEmail', user_image = '$imageName' WHERE user_name = '$loggedInUser'";
                        $results = mysqli_query($connection,$sql);
    
                        header('Location:../personalInfo.php?success=userUpdated');
                        exit;
                    }
                }else{
                    header('Location:../personalInfo.php?error=invalidFileSize');
                    exit;
                }
    
            }else{
                header('Location:../personalInfo.php?error=invalidFileType');
                exit;
            }
        }else{
            $loggedInUser = $_SESSION['user_name'];
            $sql = "UPDATE users SET email='$userEmail', job_title='$userJobTitle', f_name='$userFirstName', l_name='$userLastName', p_number='$userPhoneNumber', city='$userCity', u_address='$userAddress', linkedin='$userLinkedin', facebook='$userFacebook', instagram='$userInstagram', p_desc='$userProfileDesc' WHERE user_name='$loggedInUser'";
            $results = mysqli_query($connection,$sql) or die(mysqli_error($connection));

            if($results){
                header('Location:../personalInfo.php?success=userUpdated');
                exit;
            }else{
                
            }
        }

    }else{
        header('Location:../personalInfo.php?error=emptyEmail');
        exit;
    }

   
}

?>