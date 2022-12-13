<?php

//DELETE CERTIFICATE
if(isset($_POST['delete_certificate'])){
    include('../config/db.php');

    $certificate_id = $_POST['certificate_id'];

    $query = "DELETE FROM certificates WHERE id='$certificate_id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $skill = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Certificate deleted successfully'
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Certificate not deleted'
        ];
        echo json_encode($res);
        return false;
    }
}

//UPDATE CERTIFICATE
if(isset($_POST['update_certificate'])){
    include('../config/db.php');

    $userCertificate = $_POST['certificate'];
    $userCertificateDesc = $_POST['certificateDesc'];
    $certificate_id = $_POST['certificate_id'];

    if($userCertificate == NULL || $userCertificateDesc == NULL || $certificate_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE certificates SET cert_title='$userCertificate', cert_desc='$userCertificateDesc' WHERE id='$certificate_id'";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Certificate updated successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Certificate not updated'
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

//GET CERTIFICATE DATA
if(isset($_GET['id'])){
    include('../config/db.php');

    $certificate_id = $_GET['id'];

    $query = "SELECT * FROM certificates WHERE id='$certificate_id'";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) == 1){
        $skill = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Certificate fetched',
            'data' => $skill
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Certificate not found'
        ];
        echo json_encode($res);
        return false;
    }
}

//ADD NEW CERTIFICATE
if(isset($_POST['save_certificate'])){
    include('../config/db.php');

    $userCertificate = $_POST['certificate'];
    $userCertDesc = $_POST['certificateDesc'];
    $userId = $_POST['userId'];

    if($userCertificate == NULL || $userCertDesc == NULL || $userId == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO certificates (cert_title,cert_desc,uid) VALUES ('$userCertificate','$userCertDesc','$userId')";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Certificate created successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Certificate not created'
            ];
            echo json_encode($res);
            return false;
        }
}

?>