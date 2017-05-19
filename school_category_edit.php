<?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.schoolcat.php';

$db = new database();
$sch_cat = new schoolcat($db);

$school_cat = $sch_cat->get_school($_GET['sid']);

if($_SERVER['REQUEST_METHOD']=='POST') {
    if(isset($_POST['savebt']) && $_POST['savebt']=='Save') {
        
        $_data = array(
            'SchoolCategoryName' => trim($_POST['cat_name_short']),
            'schoolcatname' => trim($_POST['cat_name_full'])
        );       
       
        if($sch_cat->update_school_category($_data, "SchoolCategoryId = {$_GET['sid']}")) {
            $msg = "Update Successfully";
            header("Location:index.php?action=list_school_category&msg=$msg");
        }else {
            $msg = "Error in updates";
            header("Location:index.php?action=list_school_category&msg=$msg"); 
        }
    } elseif (isset($_POST['closebt'])) {
        header("Location:index.php?action=list_school_category");
    }
}

include_once 'includes/header1.php';
?>
<div class="col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-2 main">

    <h2 class="sub-header">Edit School Category</h2> 
    <form action="" class="form-horizontal"  method="POST">
        <table class="table table-hover table-responsive table-striped"> 
            <tr>
                <td>School Category</td>
                <td>
                    <input type="text" name="cat_name_short" value="<?php echo $school_cat[0]['SchoolCategoryName']; ?>" size="50" />
                </td>
            </tr>
            <tr>
                <td>School Category Full Form</td>
                <td>
                    <input type="text" name="cat_name_full" value="<?php echo $school_cat[0]['schoolcatname']; ?>" size="50" />
                </td>
            </tr>
          
            <tr>
                <td colspan="2">
                    <input type="submit" value="Save" name="savebt" class="btn btn-primary" />&nbsp;&nbsp;
                    <input type="submit" value="Close" name="closebt" class="btn btn-primary" />
                </td>
            </tr>
        </table>
    </form>

</div>

<?php include_once 'includes/footer.php'; ?>