<?php

//DELETE EXPERIENCE
if(isset($_POST['delete_experience'])){
    include('../config/db.php');

    $experience_id = $_POST['experience_id'];

    $query = "DELETE FROM experience WHERE id='$experience_id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $experience = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Experience deleted successfully'
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Experience not deleted'
        ];
        echo json_encode($res);
        return false;
    }
}

//UPDATE EXPERIENCE
if(isset($_POST['update_experience'])){
    include('../config/db.php');

    $userPosition = $_POST['position'];
    $userCompany = $_POST['company'];
    $userYearFrom = $_POST['yearFrom'];
    $userYearTo = $_POST['yearTo'];
    $userExDesc = $_POST['exDescription'];
    $experience_id = $_POST['experience_id'];

    if($userPosition == NULL || $userCompany == NULL || $userYearFrom == NULL || $userYearTo == NULL || $userExDesc == NULL || $experience_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE experience SET position='$userPosition', company='$userCompany', year_from='$userYearFrom', year_to='$userYearTo', ex_desc='$userExDesc' WHERE id='$experience_id'";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Experience updated successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Experience not updated'
            ];
            echo json_encode($res);
            return false;
        }
}

//GET EXPERIENCE DATA
if(isset($_GET['id'])){
    include('../config/db.php');

    $experience_id = $_GET['id'];

    $query = "SELECT * FROM experience WHERE id='$experience_id'";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) == 1){
        $experience = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Experience fetched',
            'data' => $experience
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Experience not found'
        ];
        echo json_encode($res);
        return false;
    }
}

//ADD NEW EXPERIENCE
if(isset($_POST['save_experience'])){
    include('../config/db.php');

    $userPosition = $_POST['position'];
    $userCompany = $_POST['company'];
    $userYearFrom = $_POST['yearFrom'];
    $userYearTo = $_POST['yearTo'];
    $userExDesc = $_POST['description'];
    $userId = $_POST['userId'];

    if($userPosition == NULL || $userCompany == NULL || $userYearFrom == NULL || $userYearTo == NULL || $userExDesc == NULL || $userId == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO experience (position,company,year_from,year_to,ex_desc,uid) VALUES ('$userPosition','$userCompany','$userYearFrom','$userYearTo','$userExDesc','$userId')";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Experience created successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Experience not created'
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