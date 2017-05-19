<?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.school.php';
require_once 'classes/class.schoolcat.php';

$db = new database();
$school = new school($db);

$school_cat = new schoolcat($db);
$s_categories = $school_cat->get_school();  //getting whole list of school category

#$sch_details = $school->get_school();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addbt']) && $_POST['addbt'] == 'Add') {

        $_data = array(
            'SchoolID' => trim ($_POST['id']),
         'SchoolName' => trim ($_POST['name']),
         'SchoolCategoryId' => trim ($_POST['school_category']),
         'status' => trim ($_POST['status'])
         );
         if($school->add_school($_data)) {
            $msg = "Insert Successfully";
            header("Location:index.php?action=list_school&msg=$msg");
            }else {
                $msg = "Error in updates";
                header("Location:index.php?action=list_school&msg=$msg");
            }
        } elseif (isset($_POST['cancelbt'])) {
            header("Location:index.php?action=list_school");
        }
    }

    include_once 'includes/header1.php';
?>

<div class="col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-2 main">

    <h2 class="sub-header">New School</h2>

    <table class="table table-hover table-responsive table-striped">

        <form action="" class="form-horizontal"  method="POST">
          <tr>
                <td>School ID</td>
                 <td>
                    <input type="text" Placeholder="Enter the New School Id" name="id" value="" size="30" />
                </td>
            </tr>
   
        <tr>
            <td>School Name</td>
            
        
            <td>
                <input type="text" Placeholder="Enter the New School Name" name="name" value="" size="50" />
            </td>
        </tr>
            <tr>
                <td>School Category</td>
                <td>
                    <select name="school_category">
                       <?php
                       if (is_array($s_categories) && count($s_categories)) {
                        foreach ($s_categories as $s_category) {
                        echo "<option value='{$s_category['SchoolCategoryId']}'>{$s_category['SchoolCategoryName']}</option>";
                        }
                    }
                    ?>
                </select>
                </td>
             </tr>
        <tr>
            <td>Status</td>
            <td>
                <input type="text" Placeholder="Enter the Status" name="status" value="" size="50" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Add" name="addbt" class="btn btn-primary" />&nbsp;&nbsp;
                <input type="submit" value="Cancel" name="cancelbt" class="btn btn-primary" />
            </td>
        </tr>
    </form>    
    </table>


</div>

<?php include_once 'includes/footer.php'; ?>