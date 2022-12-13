<?php
//DELETE REFERENCE
if(isset($_POST['delete_reference'])){
    include('../config/db.php');

    $ref_id = $_POST['ref_id'];

    $query = "DELETE FROM u_references WHERE id='$ref_id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $education = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Reference deleted successfully'
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Reference not deleted'
        ];
        echo json_encode($res);
        return false;
    }
}
//UPDATE REFERENCE
if(isset($_POST['update_reference'])){
    include('../config/db.php');

    $userRefName = $_POST['RefName'];
    $userRefPosition = $_POST['RefPosition'];
    $userRefPhone = $_POST['RefPhone'];
    $userRefEmail = $_POST['RefEmail'];
    $ref_id = $_POST['ref_id'];

    if($userRefName == NULL || $userRefPosition == NULL || $userRefPhone == NULL || $userRefEmail == NULL || $ref_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE u_references SET ref_position='$userRefPosition', ref_name='$userRefName', ref_phone='$userRefPhone', ref_email='$userRefEmail' WHERE id='$ref_id'";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Reference updated successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Reference not updated'
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
//GET REFERENCE DATA
if(isset($_GET['id'])){
    include('../config/db.php');

    $ref_id = $_GET['id'];

    $query = "SELECT * FROM u_references WHERE id='$ref_id'";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) == 1){
        $education = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Reference fetched',
            'data' => $education
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Reference not found'
        ];
        echo json_encode($res);
        return false;
    }
}
//ADD NEW REFERENCE
if(isset($_POST['save_reference'])){
    include('../config/db.php');

    $userRefName = $_POST['refName'];
    $userRefPosition = $_POST['refPosition'];
    $userRefPhone = $_POST['refPhone'];
    $userRefEmail = $_POST['refEmail'];
    $userId = $_POST['userId'];

    if($userRefName == NULL || $userRefPosition == NULL || $userRefPhone == NULL || $userRefEmail == NULL || $userId == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO u_references (ref_position,ref_name,ref_phone,ref_email,uid) VALUES ('$userRefPosition','$userRefName','$userRefPhone','$userRefEmail','$userId')";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Reference created successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Reference not created'
            ];
            echo json_encode($res);
            return false;
        }

}

?>