<?php

if(isset($_POST['delete_education'])){
    include('../config/db.php');

    $education_id = $_POST['education_id'];

    $query = "DELETE FROM education WHERE id='$education_id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $education = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Education deleted successfully'
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Education not deleted'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['update_education'])){
    include('../config/db.php');

    $userSubject = $_POST['subject'];
    $userUniversity = $_POST['university'];
    $userYearFrom = $_POST['yearFrom'];
    $userYearTo = $_POST['yearTo'];
    $education_id = $_POST['education_id'];

    if($userSubject == NULL || $userUniversity == NULL || $userYearFrom == NULL || $userYearTo == NULL || $education_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE education SET subject='$userSubject', university='$userUniversity', year_from='$userYearFrom', year_to='$userYearTo' WHERE id='$education_id'";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Education updated successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Education not updated'
            ];
            echo json_encode($res);
            return false;
        }

        /*if($inserted){


            header('Location:../education.php?success=educationCreated');
            exit;
        }else{
            header('Location:../register.php?error=educationCreationFailed');
            exit;
        }*/
}

if(isset($_GET['id'])){
    include('../config/db.php');

    $education_id = $_GET['id'];

    $query = "SELECT * FROM education WHERE id='$education_id'";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) == 1){
        $education = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Student fetched',
            'data' => $education
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Education not found'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['save_education'])){
    include('../config/db.php');

    $userSubject = $_POST['subject'];
    $userUniversity = $_POST['university'];
    $userYearFrom = $_POST['yearFrom'];
    $userYearTo = $_POST['yearTo'];
    $userId = $_POST['userId'];

    if($userSubject == NULL || $userUniversity == NULL || $userYearFrom == NULL || $userYearTo == NULL || $userId == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO education (subject,university,year_from,year_to,uid) VALUES ('$userSubject','$userUniversity','$userYearFrom','$userYearTo','$userId')";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Education created successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Education not created'
            ];
            echo json_encode($res);
            return false;
        }

        /*if($inserted){


            header('Location:../education.php?success=educationCreated');
            exit;
        }else{
            header('Location:../register.php?error=educationCreationFailed');
            exit;
        }*/
}

?>