<?php
require_once 'includes/config.php';
require_once 'classes/class.designation.php';
require_once 'classes/class.db.php';

$db = new database();
$designation = new designation($db);

$designations = $designation->get_designation($_GET['sid']);


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['savebt']) && $_POST['savebt'] =='Save') {
        
        $_data = array(
            'designation' => trim($_POST['designation'])
        );

        if($designation->update_designation($_data, "ID={$_GET['sid']}")) {
            $msg = "Update Successfully";
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

    <h2 class="sub-header">Edit Designation</h2> 
    <form action="" class="form-horizontal"  method="POST">
        <table class="table table-hover table-responsive table-striped"> 
            <tr>
                <td>Designation</td>
                <td>
                <input type="text" name="designation" value="<?php echo $designations[0]['designation']; ?>" size="50" />

                </td>
            </tr>
                   
            <tr>
                <td colspan="2">
                    <input type="submit" value="Save" name="savebt" class="btn btn-primary" />&nbsp;&nbsp;
                    <input type="submit" value="Cancel" name="cancelbt" class="btn btn-primary" />
                </td>
            </tr>
        </table>
    </form>

</div>

<?php include_once 'includes/footer.php'; ?>