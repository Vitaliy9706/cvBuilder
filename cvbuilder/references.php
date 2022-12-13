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
    <div class="modal fade" id="update_Reference" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Reference</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="m-auto" id="updateReference" >
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="RefName">Name</label>
                    <input type="text" class="form-control" id="RefName" name="RefName">
                    <input type="text" class="form-control" id="ref_id" name="ref_id" hidden>
                </div>
                <div class="form-group col-md-6">
                    <label for="RefPosition">Position</label>
                    <input type="text" class="form-control" id="RefPosition" name="RefPosition">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="RefPhone">Phone</label>
                    <input type="text" class="form-control" name="RefPhone" id="RefPhone">
                </div>
                <div class="form-group col-md-6">
                    <label for="RefEmail">Email</label>
                    <input type="text" class="form-control" id="RefEmail" name="RefEmail">
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
                <form class="m-auto" id="saveReference" >
                <h2>References</h2>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputRefName">Name</label>
                        <input type="text" class="form-control" id="inputRefName" name="refName">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputRefPosition">Position</label>
                        <input type="text" class="form-control" id="inputRefPosition" name="refPosition">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputRefPhone">Phone Number</label>
                        <input type="text" class="form-control" name="refPhone" id="inputRefPhone">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputRefEmail">Email</label>
                        <input type="text" class="form-control" id="inputRefEmail" name="refEmail">
                        <input type="text" class="form-control" id="userId" name="userId" hidden value="<?php echo $id; ?>">
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
                    <th scope="col">Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=0;
                    $sql = "SELECT * FROM u_references WHERE uid='$id'";

                    $gotResults = mysqli_query($connection,$sql);

                    if($gotResults){
                        if(mysqli_num_rows($gotResults)>0){
                            while($row = mysqli_fetch_array($gotResults)){
                                $count =$count+1;
                                ?>
                                <tr>
                                <th scope="row"><?php echo $count; ?></th>
                                <td><?php echo $row['ref_name']; ?></td>
                                <td><?php echo $row['ref_position']; ?></td>
                                <td><?php echo $row['ref_phone']; ?></td>
                                <td><?php echo $row['ref_email']; ?></td>
                                <td>
                                    <button type="button" class="editReference btn btn-warning btn-sm" value="<?php echo $row['id']; ?>">Edit</button>
                                    <button type="button" class="deleteReference btn btn-danger btn-sm" value="<?php echo $row['id']; ?>">Delete</button>
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
    $(document).on('submit', '#saveReference', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_reference", true);

        $.ajax({
            type: "POST",
            url: "processes/userReferenceUpdate.php",
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
                    $('#saveReference')[0].reset();
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    });
    //AJAX edit education
    $(document).on('click', '.editReference', function () {

        var refId = $(this).val();

        $.ajax({
            type: "GET",
            url: "processes/userReferenceUpdate.php?id=" + refId,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
                   
                    $('#ref_id').val(res.data.id);
                    $('#RefName').val(res.data.ref_name);
                    $('#RefPosition').val(res.data.ref_position);
                    $('#RefPhone').val(res.data.ref_phone);
                    $('#RefEmail').val(res.data.ref_email);

                    $('#update_Reference').modal('show');

                }
            }
        });
    });
    //AJAX update education
    $(document).on('submit', '#updateReference', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_reference", true);

        $.ajax({
            type: "POST",
            url: "processes/userReferenceUpdate.php",
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
                    $('#updateReference')[0].reset();
                    $('#update_Reference').modal('hide');
                    $('#save').removeClass('d-none');
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    });
    //AJAX delete education
    $(document).on('click', '.deleteReference', function (e) {
        e.preventDefault();

        if(confirm('Are you sure you want to delete this data?')){
            var refId = $(this).val();
            $.ajax({
                type: "POST",
                url: "processes/userReferenceUpdate.php?id=" + refId,
                data: {
                    'delete_reference': true,
                    'ref_id': refId
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
