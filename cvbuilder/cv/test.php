<?php
include('includes/header.php');
include('../config/db.php');
$id=$_GET['id'];

echo $id;

$sql = "SELECT * FROM users WHERE id='$id'";

$gotResults = mysqli_query($connection,$sql) or die(mysqli_error($connection));

    if($gotResults){
        if(mysqli_num_rows($gotResults)>0){
        while($row = mysqli_fetch_array($gotResults)){
            $userFirstName = $row['f_name'];
        }
    }
}

echo $userFirstName;

?>