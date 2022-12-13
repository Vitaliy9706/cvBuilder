<?php

//DELETE SKILL
if(isset($_POST['delete_skill'])){
    include('../config/db.php');

    $skill_id = $_POST['skill_id'];

    $query = "DELETE FROM skills WHERE id='$skill_id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $skill = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Skill deleted successfully'
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Skill not deleted'
        ];
        echo json_encode($res);
        return false;
    }
}

//UPDATE SKILL
if(isset($_POST['update_skill'])){
    include('../config/db.php');

    $userSkill = $_POST['skill'];
    $skill_id = $_POST['skill_id'];

    if($userSkill == NULL || $skill_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "UPDATE skills SET skill_name='$userSkill' WHERE id='$skill_id'";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Skill updated successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Skill not updated'
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

    $skill_id = $_GET['id'];

    $query = "SELECT * FROM skills WHERE id='$skill_id'";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) == 1){
        $skill = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Skill fetched',
            'data' => $skill
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Skill not found'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['save_skill'])){
    include('../config/db.php');

    $userSkill = $_POST['skill'];
    $userId = $_POST['userId'];

    if($userSkill == NULL || $userId == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    $sql = "INSERT INTO skills (skill_name,uid) VALUES ('$userSkill','$userId')";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){
            $res = [
                'status' => 200,
                'message' => 'Skill created successfully'
            ];
            echo json_encode($res);
            return false;
        }else{
            $res = [
                'status' => 500,
                'message' => 'Skill not created'
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