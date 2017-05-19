<?php
/* entry for the schoolhead table */

require_once 'includes/config.php';
require_once 'classes/class.main.php';
require_once 'classes/class.db.php';
require_once 'classes/class.school.php';

$db = new database();
$sch_head = new main_class($db);
$sch = new school($db);

$schools = $sch->get_school();  //get whole school
// get the record of schoolhead having id
$sch_head_single = $sch_head->get_main_detail($_GET['id']);


// in order to correct the timezone warning 
if (!ini_get('date.timezone')) {
    date_default_timezone_set('GMT');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['savebt']) && $_POST['savebt'] == 'Save') {
        if (isset($_POST['school']) && $_POST['school'] != '') {
            $school_n = $_POST['school'];
        }
        if ($_POST['rpt_officer'] != '' && $_POST['reportingperiod'] != '' && $_POST['deadline'] != '') {

            $_data = array(
                'schoolid' => $school_n,
                'reportingofficer' => $_POST['rpt_officer'],
                'reportingperiod' => date('Y-m-d', strtotime(str_replace('/', '-', $_POST['reporting_date']))),
                'deadline' => date('Y-m-d', strtotime(str_replace('/', '-', $_POST['deadline']))),
                'userid' => 0
            );
            if ($sch_head->update_staff_head($_data, "schooltype={$_POST['schooltypeid']}")) {
                $id = $_POST['schooltypeid'];
                $msg = "Update Successfully";
                header("Location:index.php?action=detail_entry&id=$id&msg=$msg");
            }
        } else {
            $msg = "Please fill the required field";
            header("Location:index.php?action=main_list&id=$id&msg=$msg");
        }
    } elseif (isset($_POST['closebt']) && $_POST['closebt'] == 'Cancel') {
        header("Location:index.php?action=main_list");
    }
}


include('includes/header1.php');
?>

<div class="col-sm-9 col-sm-offset-1 col-md-9 col-md-offset-1 main">

    <h2 class="sub-header">Edit Record</h2> 
    <form action="" class="form-horizontal print_disable" method="POST">
    <table class="table table-hover table-responsive table-striped">
<tr>
<td>

        <div class="form-group"> 
            <label class="control-label col-sm-2">School</label>
            <select name="school" style="font-size: 18px;">

                <?php
                if (is_array($schools) && count($schools)) {
                    foreach ($schools as $school) {
                        if ($school['SchoolID'] == $sch_head_single[0]['schoolid']) {
                            echo "<option selected='selected' value='{$school['SchoolID']}'>{$school['SchoolName']}</option>";
                        } else {
                            echo "<option value='{$school['SchoolID']}'>{$school['SchoolName']}</option>";
                        }
                    }
                } else {
                    
                }
                ?>
            </select>
        </div>
        <div class="form-group"> 
            <label class="control-label col-sm-2">Reporting Officer</label>
            <input type="text" name="rpt_officer" value="<?php echo $sch_head_single[0]['reportingofficer']; ?>" size="26" />
        </div>
        <div class="form-group"> 
            <label for="date-picker" class="control-label col-sm-2">Reporting Date</label>
            <div class="controls">
                <div class="input-group">
                    <label for="date-picker"  class="input-group-addon btn">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </label>
                    <input class="datepicker" type="text" name="reporting_date" value="<?php echo $sch_head_single[0]['reportingperiod']; ?>" />
                </div>
            </div>
        </div>
        <div class="form-group"> 
            <label for="date-picker" class="control-label col-sm-2">Deadline</label>
            <div class="controls">
                <div class="input-group">
                    <label for="date-picker" class="input-group-addon btn">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </label>
                    <input class="datepicker" type="text" name="deadline" value="<?php echo $sch_head_single[0]['deadline']; ?>" />
                    <input type="hidden" name="schooltypeid" value="<?php echo $sch_head_single[0]['schooltype'] ?>" />
                </div>
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10" style="padding-left:0;">
                <input type="submit" value="Save" name="savebt" class="btn btn-primary" />&nbsp;&nbsp;
                <input type="submit" value="Cancel" name="closebt" class="btn btn-primary" />
            </div>
        </div>
           </td>
    </tr>
</table>
    </form>


</div> 

<?php include_once 'includes/footer.php'; ?>

