<?php
//UPDATE Interest
if(isset($_POST['update_interest'])){
    include('../config/db.php');

    $userInterest = $_POST['interest'];
    $interest_id = $_POST['interest_id'];
    $userInterestIcon = $_POST['interest_icon'];

    if($userInterest == NULL || $userInterestIcon == NULL || $interest_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE interests SET interest_name='$userInterest',icon_id='$userInterestIcon' WHERE id='$interest_id'";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Interest updated successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Interest not updated'
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

//GET skill data
if(isset($_GET['id'])){
    include('../config/db.php');

    $interest_id = $_GET['id'];

    //$query = "SELECT * FROM interests WHERE id='$interest_id'";
    //$query_run = mysqli_query($connection,$query);

    $sql = "SELECT a.id AS interest_id, a.interest_name AS interest_title, b.title AS icon_title FROM interests AS a INNER JOIN icons AS b ON (a.icon_id = b.id) WHERE a.id='$interest_id'";

    $query_run = mysqli_query($connection,$sql);

    if(mysqli_num_rows($query_run) == 1){
        $interest = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Interest fetched',
            'data' => $interest
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Interest not found'
        ];
        echo json_encode($res);
        return false;
    }
}

//DELETE SKILL
if(isset($_POST['delete_interest'])){
    include('../config/db.php');

    $interest_id = $_POST['interest_id'];

    $query = "DELETE FROM interests WHERE id='$interest_id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $interest = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Interest deleted successfully'
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Interest not deleted'
        ];
        echo json_encode($res);
        return false;
    }
}

//ADD NEW INTEREST
if(isset($_POST['save_interest'])){
    include('../config/db.php');

    $userInterest = $_POST['interest'];
    $userInterestIcon = $_POST['interest_icon'];
    $userId = $_POST['userId'];

    if($userInterest == NULL || $userInterestIcon == NULL || $userId == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO interests (interest_name,icon_id,uid) VALUES ('$userInterest','$userInterestIcon','$userId')";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Interest created successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Interest not created'
            ];
            echo json_encode($res);
            return false;
        }
}

?>