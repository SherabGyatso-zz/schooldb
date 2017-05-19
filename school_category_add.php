<?php
    require_once 'includes/config.php';
    require_once 'classes/class.db.php';
    require_once 'classes/class.schoolcat.php';
    
    $db = new database();
    $sch_cat = new schoolcat($db);

    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        if(isset($_POST['addbt']) && $_POST['addbt']=='Add') {
            
            $_data = array(
                           'SchoolCategoryName' => trim($_POST['cat_name_short']),
                           'schoolcatname' => trim($_POST['cat_name_full'])
                           );
            
            //if($sch_cat->update_school_category($_data, "SchoolCategoryId = {$_GET['sid']}")) {
            if($sch_cat->add_school_category($_data)) {
            $msg = "Update Successfully";
            header("Location:index.php?action=list_school_category&msg=$msg");
            }else {
                $msg = "Error in updates";
                header("Location:index.php?action=list_school_category&msg=$msg");
            }
        } elseif (isset($_POST['cancelbt'])) {
            header("Location:index.php?action=list_school_category");
        }
    }
    
    include_once 'includes/header1.php';
    ?>
<div id="" class="col-sm-offset-2 col-md-6 col-md-offset-2 main">

<h2 class="sub-header">New School Category</h2>
<form action="" class="form-horizontal"  method="POST">
<table class="table table-hover table-responsive table-striped">
<tr>
<td>School Category</td>
<td>

<input type="text" Placeholder="Enter the New School Category Name" name="cat_name_short" value="" size="50" />
</td>
</tr>
<tr>
<td>School Category Full Form</td>
<td>
<input type="text" Placeholder="Enter the Full Form of School Category" name="cat_name_full" value="" size="50" />
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