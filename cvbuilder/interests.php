<?php
include('includes/header.php');
include('config/db.php');
$id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>CVBuilder</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <!--------------Modal update interest---------->
    <div class="modal fade" id="update_Interest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Interest</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="m-auto" id="updateInterest" >
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="Skill">Interest</label>
                    <input type="text" class="form-control" id="Interest" name="interest">
                    <input type="text" class="form-control" id="interest_id" name="interest_id" hidden>
                </div>
                <div class="form-group col-md-12">
                    <label for="icons">Icons</label>
                    <select class="form-control" id="icons" name="interest_icon">
                        <option>--Select icon--</option>
                        <?php
                                $sql = "SELECT * FROM icons";

                                $gotResults = mysqli_query($connection,$sql);

                                if($gotResults){
                                    if(mysqli_num_rows($gotResults)>0){
                                        while($row = mysqli_fetch_array($gotResults)){
                                            ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                            <?php
                                        }
                                    }
                                }

                        ?>
                    </select>
                </div>
            </div>
            <hr>
            <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>
            <div class="form-group">
                <input type="submit" name="submit1" id="update" class="btn btn-warning" value="Update">
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    <header>
        <?php
            include('includes/navigation.php');
         ?>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 p-4 ">
                <div id="errorMessage" class="alert alert-warning d-none"></div>
                <form class="m-auto" id="saveInterest" >
                <h2>Interests</h2>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputInterest">Interest</label>
                            <input type="text" class="form-control" id="inputInterest" name="interest">
                            <input type="text" class="form-control" id="userId" name="userId" hidden value="<?php echo $id; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="icons">Icons</label>
                            <select class="form-control" id="icons" name="interest_icon">
                                <option>--Select icon--</option>
                            <?php
                                $sql = "SELECT * FROM icons";

                                $gotResults = mysqli_query($connection,$sql);

                                if($gotResults){
                                    if(mysqli_num_rows($gotResults)>0){
                                        while($row = mysqli_fetch_array($gotResults)){
                                            ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                            <?php
                                        }
                                    }
                                }

                            ?>
                            </select>
                        </div>
                    </div>
                    <div>
                    <?php
                        $sql = "SELECT * FROM icons";

                        $gotResults = mysqli_query($connection,$sql);

                        if($gotResults){
                            if(mysqli_num_rows($gotResults)>0){
                                while($row = mysqli_fetch_array($gotResults)){
                                    ?>
                                    <div>
                                    <i class='bx <?php echo $row['icon_name']; ?> interests__icon'></i> <?php echo $row['title']; ?>
                                    </div>
                                    <?php
                                }
                            }
                        }

                    ?>
                    </div>
                    <hr>
                    <div class="form-group">
                        <input type="submit" name="submit" id="save" class="btn btn-info" value="Save">
                    </div>  
                </form>
            </div>
            <div class="col-md-8">
            <table id="myTable" class="table table-hover mt-4">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Interest</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=0;
                    $sql = "SELECT a.id AS interest_id, a.interest_name AS interest_title, b.icon_name AS icon_title FROM interests AS a INNER JOIN icons AS b ON (a.icon_id = b.id) WHERE uid='$id'";

                    $gotResults = mysqli_query($connection,$sql);

                    if($gotResults){
                        if(mysqli_num_rows($gotResults)>0){
                            while($row = mysqli_fetch_array($gotResults)){
                                $count =$count+1;
                                ?>
                                <tr>
                                <th scope="row"><?php echo $count; ?></th>
                                <td><i class='bx <?php echo $row['icon_title']; ?> interests__icon'></i></td>
                                <td><?php echo $row['interest_title']; ?></td>
                                <td>
                                    <button type="button" class="editInterest btn btn-warning btn-sm" value="<?php echo $row['interest_id']; ?>">Edit</button>
                                    <button type="button" class="deleteInterest btn btn-danger btn-sm" value="<?php echo $row['interest_id']; ?>">Delete</button>
                                </td>
                                </tr>
                                <?php
                            }
                        }else{
                            ?>
                            <tr>
                                <td>You don't have any interests yet</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
    //AJAX Add new skill
    $(document).on('submit', '#saveInterest', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_interest", true);

        $.ajax({
            type: "POST",
            url: "processes/userInterestsUpdate.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 422) {
                    $('#errorMessage').removeClass('d-none');
                    $('#errorMessage').text(res.message);
                }else if(res.status == 200){
                    $('#errorMessage').addClass('d-none');
                    $('#saveInterest')[0].reset();
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    });
    //AJAX edit skill
    $(document).on('click', '.editInterest', function () {

        var interestId = $(this).val();

        $.ajax({
            type: "GET",
            url: "processes/userInterestsUpdate.php?id=" + interestId,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
                
                    $('#interest_id').val(res.data.interest_id);
                    $('#Interest').val(res.data.interest_title);

                    $('#update_Interest').modal('show');

                }
            }
        });
    });
    //AJAX update skill
    $(document).on('submit', '#updateInterest', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_interest", true);

        $.ajax({
            type: "POST",
            url: "processes/userInterestsUpdate.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 422) {
                    $('#errorMessageUpdate').removeClass('d-none');
                    $('#errorMessageUpdate').text(res.message);
                }else if(res.status == 200){
                    $('#errorMessageUpdate').addClass('d-none');
                    $('#updateInterest')[0].reset();
                    $('#update_Interest').modal('hide');
                    $('#save').removeClass('d-none');
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    });
    //AJAX delete skill
    $(document).on('click', '.deleteInterest', function (e) {
        e.preventDefault();

        if(confirm('Are you sure you want to delete this data?')){
            var interestId = $(this).val();
            $.ajax({
                type: "POST",
                url: "processes/userInterestsUpdate.php?id=" + interestId,
                data: {
                    'delete_interest': true,
                    'interest_id': interestId
                },
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {
                        alert(res.message);
                    }else{
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");
                    }
                }
            });
        }
    });
</script>
</body>
</html>
