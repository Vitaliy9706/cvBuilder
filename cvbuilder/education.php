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
    <title>CVBuilder</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <!--------------Modal update education---------->
    <div class="modal fade" id="update_Education" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Education</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="m-auto" id="updateEducation" >
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Subject">Subject</label>
                    <input type="text" class="form-control" id="Subject" name="subject">
                    <input type="text" class="form-control" id="education_id" name="education_id" hidden>
                </div>
                <div class="form-group col-md-6">
                    <label for="University">University</label>
                    <input type="text" class="form-control" id="University" name="university">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="YearFrom">Year From</label>
                    <input type="text" class="form-control" name="yearFrom" id="YearFrom">
                </div>
                <div class="form-group col-md-6">
                    <label for="YearTo">Year To</label>
                    <input type="text" class="form-control" id="YearTo" name="yearTo">
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
                <form class="m-auto" id="saveEducation" >
                <h2>Education</h2>
                    <?php
                        $currentuser = $_SESSION['user_name'];
                        $sql = "SELECT * FROM users WHERE user_name='$currentuser'";

                        $gotResults = mysqli_query($connection,$sql);

                        if($gotResults){
                            if(mysqli_num_rows($gotResults)>0){
                                while($row = mysqli_fetch_array($gotResults)){
                                    ?>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                            <label for="inputSubject">Subject</label>
                                            <input type="text" class="form-control" id="inputSubject" name="subject">
                                            <input type="text" class="form-control" id="education_id" name="education_id" hidden>
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="inputUniversity">University</label>
                                            <input type="text" class="form-control" id="inputUniversity" name="university">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                            <label for="inputYearFrom">Year From</label>
                                            <input type="text" class="form-control" name="yearFrom" id="inputYearFrom">
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="inputYearTo">Year To</label>
                                            <input type="text" class="form-control" id="inputYearTo" name="yearTo">
                                            <input type="text" class="form-control" id="userId" name="userId" hidden value="<?php echo $id; ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <input type="submit" name="submit" id="save" class="btn btn-info" value="Save">
                                        </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                    
                </form>
            </div>
            <div class="col-md-8">
            <table id="myTable" class="table table-hover mt-4">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject</th>
                    <th scope="col">University</th>
                    <th scope="col">Year From</th>
                    <th scope="col">Year To</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=0;
                    $sql = "SELECT * FROM education WHERE uid='$id'";

                    $gotResults = mysqli_query($connection,$sql);

                    if($gotResults){
                        if(mysqli_num_rows($gotResults)>0){
                            while($row = mysqli_fetch_array($gotResults)){
                                $count =$count+1;
                                ?>
                                <tr>
                                <th scope="row"><?php echo $count; ?></th>
                                <td><?php echo $row['subject']; ?></td>
                                <td><?php echo $row['university']; ?></td>
                                <td><?php echo $row['year_from']; ?></td>
                                <td><?php echo $row['year_to']; ?></td>
                                <td>
                                    <button type="button" class="editEducation btn btn-warning btn-sm" value="<?php echo $row['id']; ?>">Edit</button>
                                    <button type="button" class="deleteEducation btn btn-danger btn-sm" value="<?php echo $row['id']; ?>">Delete</button>
                                </td>
                                </tr>
                                <?php
                            }
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
    //AJAX Add new education
    $(document).on('submit', '#saveEducation', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_education", true);

        $.ajax({
            type: "POST",
            url: "processes/userEducationUpdate.php",
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
                    $('#saveEducation')[0].reset();
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    });
    //AJAX edit education
    $(document).on('click', '.editEducation', function () {

        var educationId = $(this).val();

        $.ajax({
            type: "GET",
            url: "processes/userEducationUpdate.php?id=" + educationId,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
                   
                    $('#education_id').val(res.data.id);
                    $('#Subject').val(res.data.subject);
                    $('#University').val(res.data.university);
                    $('#YearFrom').val(res.data.year_from);
                    $('#YearTo').val(res.data.year_to);

                    $('#update_Education').modal('show');

                }
            }
        });
    });
    //AJAX update education
    $(document).on('submit', '#updateEducation', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_education", true);

        $.ajax({
            type: "POST",
            url: "processes/userEducationUpdate.php",
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
                    $('#updateEducation')[0].reset();
                    $('#update_Education').modal('hide');
                    $('#save').removeClass('d-none');
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    });
    //AJAX delete education
    $(document).on('click', '.deleteEducation', function (e) {
        e.preventDefault();

        if(confirm('Are you sure you want to delete this data?')){
            var educationId = $(this).val();
            $.ajax({
                type: "POST",
                url: "processes/userEducationUpdate.php?id=" + educationId,
                data: {
                    'delete_education': true,
                    'education_id': educationId
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
