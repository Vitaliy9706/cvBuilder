<?php

//DELETE SKILL
if(isset($_POST['delete_language'])){
    include('../config/db.php');

    $lang_id = $_POST['lang_id'];

    $query = "DELETE FROM languages WHERE id='$lang_id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $skill = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Language deleted successfully'
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Language not deleted'
        ];
        echo json_encode($res);
        return false;
    }
}

//UPDATE SKILL
if(isset($_POST['update_language'])){
    include('../config/db.php');

    $userLanguage = $_POST['language'];
    $lang_id = $_POST['lang_id'];

    if($userLanguage == NULL || $lang_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE languages SET lang_name='$userLanguage' WHERE id='$lang_id'";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Language updated successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Language not updated'
            ];
            echo json_encode($res);
            return false;
        }
}

//GET skill data
if(isset($_GET['id'])){
    include('../config/db.php');

    $lang_id = $_GET['id'];

    $query = "SELECT * FROM languages WHERE id='$lang_id'";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) == 1){
        $skill = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Language fetched',
            'data' => $skill
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Language not found'
        ];
        echo json_encode($res);
        return false;
    }
}

//ADD NEW LANGUAGE
if(isset($_POST['save_language'])){
    include('../config/db.php');

    $userLanguage = $_POST['language'];
    $userId = $_POST['userId'];

    if($userLanguage == NULL || $userId == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO languages (lang_name,uid) VALUES ('$userLanguage','$userId')";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Language created successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Language not created'
            ];
            echo json_encode($res);
            return false;
        }

}

?>