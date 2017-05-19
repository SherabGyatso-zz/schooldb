<?php
require_once 'includes/config.php';
require_once 'classes/class.main.php';
require_once 'classes/class.db.php';
require_once 'classes/class.school.php';


$db = new database();
$sch_head = new main_class($db);

$sch = new school($db);
$schools = $sch->get_school();



if ($_SERVER['REQUEST_METHOD']=='POST') {
  if (isset($_POST['savebt']) && $_POST['savebt']=='Save') {

    $_data = array(
     'schoolid'=> trim($_POST['school']),
     'reportingofficer'=> trim($_POST['rpt_officer']),
     'reportingperiod'=> date('Y/m/d', strtotime(str_replace('/', '-',$_POST['reporting_date']))),
     'deadline'=> date('Y/m/d', strtotime(str_replace('/', '-', $_POST['Deadline']))),
     'userid'=>0
     );
    if ($sch_head->add_staff_head($_data)) {
      $id = $sch_head->get_staff_head_id();

      $msg = "Added Successfully";
                //echo("Added Successfully");
       header("Location:index.php?action=detail_entry&id=$id&msg=$msg");
     
      
              
    }else {
      $msg = "Please fill the required field";
                //echo("Please fill the required field");
            header("Location:index.php?action=main_entry&msg=$msg");
    }


  }elseif (isset($_POST['closebt']) && $_POST['closebt'] == 'Cancel') {
           //elseif (isset($_POST['closebt'])) {
    header("Location:index.php?action=main_list");

    $msg = "Thank you";
               //echo("Thank You");
  }

}
include('includes/header1.php');

?>

<div class="col-sm-9 col-sm-offset-1 col-md-9 col-md-offset-1 main">

  <h2 class="sub-header">Add Record</h2>
  <form action="" class="form-horizontal"  method="POST">
<table class="table table-hover table-responsive table-striped">
<tr>
<td>
    <div class="form-group">
      <label class="control-label col-sm-2">School</label>
      <select name="school" style="font-size: 18px;">
      <option value="all" selected="selected"><- -Select School- -></option>
        <?php
        if (is_array($schools) && count($schools)) {
          foreach ($schools as $school) {
            echo "<option value='{$school['SchoolID']}'>{$school['SchoolName']}</option>";
          }
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Reporting Officer</label>
      <input type="text" name="rpt_officer" placeholder="Reporting Officer" size="26" />
    </div>
    <div class="form-group">
      <label for="date-picker" class="control-label col-sm-2">Reporting Date</label>
      <div class="controls">
        <div class="input-group">
          <label for="date-picker"  class="input-group-addon btn">
            <span class="glyphicon glyphicon-calendar"></span>
          </label>
          <input class="datepicker" type="text" name="reporting_date" placeholder='Reporting Date' />
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
          <input class="datepicker" type="text" name="Deadline" placeholder='Deadline' />
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

