<?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.class.php';

$db = new database();

$class = new school_class($db);
$classes = $class->get_class($_GET['sid']);



if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['savebt']) && $_POST['savebt'] == 'Save') {
        
        $_data = array(
            'class' => $_POST['class'],
            'ClassNum' => $_POST['class_num']
        );
        
     
        if($class->update_class($_data, "classid={$_GET['sid']}")) {
            $msg = "Update Successfully";
            header("Location:index.php?action=list_class&msg=$msg");
        }else {
            $msg ="Error in Update";
            header("Location:index.php?action=list_class&msg=$msg");
        }
    }elseif(isset($_POST['closebt']) && $_POST['closebt']=='Close') {
        header("Location:index.php?action=list_class");
    }
}
    
    include('includes/header1.php');
    

?>

<div class="col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-2 main">

    <h2 class="sub-header">Edit Class</h2> 
    <form action="" class="form-horizontal"  method="POST">
        <table class="table table-hover table-responsive table-striped"> 
            <tr>
                <td>School Category</td>
                <td>
                    <input type="text" name="class" value="<?php echo $classes[0]['class']; ?>" size="50" />
                </td>
            </tr>
            <tr>
                <td>School Category Full Form</td>
                <td>
                    <input type="text" name="class_num" value="<?php echo $classes[0]['ClassNum']; ?>" size="50" />
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