 <?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.school.php';
require_once 'classes/class.schoolcat.php';

$db = new database();
$school = new school($db);
$sch_detail = $school->get_school($_GET['sid']);

$school_cat = new schoolcat($db);
$s_categories = $school_cat->get_schoolcat();  //getting whole list of school category


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['savebt']) && $_POST['savebt']=='Save') {
        
         $_data = array(
            'SchoolID' => trim ($_POST['id']),
             'SchoolName' => trim($_POST['schoolname']),
             'SchoolCategoryId' => trim($_POST['school_category_id']),
             'status' => trim($_POST['status'])
         );
            if($school->update_school($_data, "SchoolID = {$_GET['sid']}")) {
                $msg = "Update Successfully";
                header("Location:index.php?action=list_school&msg=$msg");
            } else {
                 $msg = "Error in updates";
             header("Location:index.php?action=list_school&msg=$msg");
        }
    } elseif (isset($_POST['closebt'])) {
        header("Location:index.php?action=list_school");
    }
}


include_once 'includes/header1.php';
?>
<div class="col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-2 main">

    <h2 class="sub-header">Edit School</h2> 
    <form action="" class="form-horizontal"  method="POST">
        <table class="table table-hover table-responsive table-striped"> 
          <tr>
                <td>School</td>
                <td>
                    <input type="text" name="id" value="<?php echo $sch_detail[0]['SchoolID']; ?>" size="50" />
                </td>
            </tr>
            <tr>
                <td>School</td>
                <td>
                    <input type="text" name="schoolname" value="<?php echo $sch_detail[0]['SchoolName']; ?>" size="50" />
                </td>
            </tr>
            <tr>
                <td>School Category</td>
                <td>                                  
                    <select name="school_category_id">
                        <?php
                        if (is_array($s_categories) && count($s_categories)) {
                            foreach ($s_categories as $s_category) {

                                if ($s_category['SchoolCategoryId'] == $sch_detail[0]['SchoolCategoryId']) {
                                    echo "<option selected='selected' value='{$s_category['SchoolCategoryId']}'>{$s_category['SchoolCategoryName']}</option>";
                                } else {
                                    echo "<option value='{$s_category['SchoolCategoryId']}'>{$s_category['SchoolCategoryName']}</option>";
                                }
                            }
                        } else {
                            echo "testing";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <input type="text" name="status" value="<?php echo $sch_detail[0]['status']; ?>" />
                   <!-- <input type="hidden" name="id" value="<?php echo $sch_detail[0]['SchoolID'] ?>" />-->
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