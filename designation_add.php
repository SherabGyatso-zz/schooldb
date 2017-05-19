<?php
    require_once 'includes/config.php';
    require_once 'classes/class.designation.php';
    require_once 'classes/class.db.php';
    
    $db = new database();
    $designation = new designation($db);
    
    $designations = $designation->get_designation();
    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['addbt']) && $_POST['addbt'] =='Add') {
            
            $_data = array(
                           'designation'=> trim($_POST['Designation'])
                           );
            
            if($designation->add_designation($_data)) {
                $msg = "Insert Successfully";
                header("Location:index.php?action=list_designation&msg=$msg");
            }else{
                $msg = "Error in update";
                header("Location:index.php?action=list_designation&msg=$msg");
            }
        }elseif (isset($_POST['cancelbt'])) {
            header("Location:index.php?action=list_designation");
        }
    }
    
    include('includes/header1.php');
    ?>
<div class="col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-2 main">

<h2 class="sub-header">Adding Designation</h2>
<form action="" class="form-horizontal"  method="POST">
<table class="table table-hover table-responsive table-striped">
<tr>
<td>Designation</td>
<td>
<input type="text" Placeholder="Enter the New Designation" name="Designation" value="" size="50" />
</td>
</tr>

<tr>
<td colspan="2">
<input type="submit" value="Add" name="addbt" class="btn btn-primary" />&nbsp;&nbsp;
<input type="submit" value="Cancel" name="cancelbt" class="btn btn-primary" />
</td>
</tr>
</table>
</form>

</div>

<?php include_once 'includes/footer.php'; ?>