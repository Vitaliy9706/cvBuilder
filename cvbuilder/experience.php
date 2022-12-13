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
    <!--------------Modal update experience---------->
    <div class="modal fade" id="update_Experience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Experience</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="m-auto" id="updateExperience" >
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Position">Position</label>
                    <input type="text" class="form-control" id="Position" name="position">
                    <input type="text" class="form-control" id="experience_id" name="experience_id" hidden>
                </div>
                <div class="form-group col-md-6">
                    <label for="Company">Company</label>
                    <input type="text" class="form-control" id="Company" name="company">
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
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="ExDescription">Experience Description</label>
                    <input type="text" class="form-control" name="exDescription" id="ExDescription">
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
                <form class="m-auto" id="saveExperience" >
                <h2>Experience</h2>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPosition">Position</label>
                            <input type="text" class="form-control" id="inputPosition" name="position">
                            <input type="text" class="form-control" id="experience_id" name="experience_id" hidden>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCompany">Company</label>
                            <input type="text" class="form-control" id="inputCompany" name="company">
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
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputDesc">Experience Description</label>
                            <input type="text" class="form-control" name="description" id="inputDesc">
                        </div>
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
                    <th scope="col">Position</th>
                    <th scope="col">Company</th>
                    <th scope="col">Year From</th>
                    <th scope="col">Year To</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=0;
                    $sql = "SELECT * FROM experience WHERE uid='$id'";

                    $gotResults = mysqli_query($connection,$sql);

                    if($gotResults){
                        if(mysqli_num_rows($gotResults)>0){
                            while($row = mysqli_fetch_array($gotResults)){
                                $count =$count+1;
                                ?>
                                <tr>
                                <th scope="row"><?php echo $count; ?></th>
                                <td><?php echo $row['position']; ?></td>
                                <td><?php echo $row['company']; ?></td>
                                <td><?php echo $row['year_from']; ?></td>
                                <td><?php echo $row['year_to']; ?></td>
                                <td><?php echo $row['ex_desc']; ?></td>
                                <td>
                                    <button type="button" class="editExperience btn btn-warning btn-sm" value="<?php echo $row['id']; ?>">Edit</button>
                                    <button type="button" class="deleteExperience btn btn-danger btn-sm" value="<?php echo $row['id']; ?>">Delete</button>
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
    //AJAX Add new experience
    $(document).on('submit', '#saveExperience', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_experience", true);

        $.ajax({
            type: "POST",
            url: "processes/userExperienceUpdate.php",
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
                    $('#saveExperience')[0].reset();
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    });
    //AJAX edit experience
    $(document).on('click', '.editExperience', function () {

    var experienceId = $(this).val();

        $.ajax({
            type: "GET",
            url: "processes/userExperienceUpdate.php?id=" + experienceId,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
                
                    $('#experience_id').val(res.data.id);
                    $('#Position').val(res.data.position);
                    $('#Company').val(res.data.company);
                    $('#YearFrom').val(res.data.year_from);
                    $('#YearTo').val(res.data.year_to);
                    $('#ExDescription').val(res.data.ex_desc);

                    $('#update_Experience').modal('show');

                }
            }
        });
    });
    //AJAX update experience
    $(document).on('submit', '#updateExperience', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_experience", true);

        $.ajax({
            type: "POST",
            url: "processes/userExperienceUpdate.php",
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
                    $('#updateExperience')[0].reset();
                    $('#update_Experience').modal('hide');
                    $('#save').removeClass('d-none');
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    });
    //AJAX delete experience
    $(document).on('click', '.deleteExperience', function (e) {
        e.preventDefault();

        if(confirm('Are you sure you want to delete this data?')){
            var experienceId = $(this).val();
            $.ajax({
                type: "POST",
                url: "processes/userExperienceUpdate.php?id=" + experienceId,
                data: {
                    'delete_experience': true,
                    'experience_id': experienceId
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
