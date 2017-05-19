<?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.staff.php';
require_once 'classes/class.designation.php';

$db = new database();
$staff_e = new staff($db);

$de = new designation($db);

if (isset($_GET['staffid']) && $_GET['staffid'] != '') {
    $staffid = $_GET['staffid'];
} else {
    $staffid = $_POST['staffid'];
}
if (isset($_GET['mainid']) && $_GET['mainid'] != '') {
    $mainid = $_GET['mainid'];
} elseif (isset($_POST['schoolinfo']) && $_POST['schoolinfo'] != '') {
    $mainid = $_POST['schoolinfo'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['savebt']) && $_POST['savebt'] == 'Edit') {
 
            $_data = array(
                'designationid' => trim($_POST['designationid']),
                'schoolinfo' => trim($mainid),
                'Female' => trim($_POST['female']),
                'Male' => trim($_POST['male'])                
            );

            if ($staff_e->update_staff($_data, "ID='{$staffid}'")) {
                $s_msg = "Record has been edit successfully";
            } else {
                $e_msg = "Record is not updated";
            }
 
    } elseif (isset($_POST['closebt']) && $_POST['closebt'] == 'Close') {
        header("Location:index.php?action=detail_entry&id=$mainid");
    }
}


include('includes/header1.php');

if (isset($s_msg)) {
    $_SESSION['s_msg'] = $s_msg;
}

if (isset($e_msg)) {
    $_SESSION['e_msg'] = $e_msg;
}
?>

<div class="col-sm-12 col-md-12">

    <?php
    if (isset($_SESSION['s_msg']) && $_SESSION['s_msg'] != '') {
        $s_msg = $_SESSION['s_msg'];
        unset($_SESSION['s_msg']);
        echo '<h3 style="text-align: center; color:green;"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;' . $s_msg . '</h3>';
    } elseif (isset($_SESSION['e_msg']) && $_SESSION['e_msg'] != '') {
        $e_msg = $_SESSION['e_msg'];
        unset($_SESSION['e_msg']);
        echo '<h3 style="text-align: center; color:red;"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;' . $e_msg . '</h3>';
    }

    $res = $staff_e->get_staff($staffid, 'edit');
    ?>

    <div class="col-sm-12 col-md-12">
    <h3 style="text-align: center;"><i class="icon-large icon-ok-sign"></i><span id="msg"></span></h3>
      <form action="edit_staff_form.php" method="post">
        <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
            <thead>
                <tr>    
                    <th>Designation</th>
                    <th>Male</th>
                    <th>Female </th>                   
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>                 
                        <select name="designationid">
                            <option value="all">Select Designation</option>
                            <?php
                          
                            $s_designations = $de->get_designation();
                            //echo count($s_classes)."test";
                            if (is_array($s_designations) && count($s_designations)) {
                                foreach ($s_designations as $s_designation) {
                                   if ($s_designation['ID'] == $res[0]['designationid']) {
                                            echo "<option selected='selected' value='{$s_designation['ID']}'>{$s_designation['designation']}</option>";
                                        } else {
                                            echo "<option value='{$s_designation['ID']}'>{$s_designation['designation']}</option>";
                                        }
                                }                               
                            }
                            ?>
                        </select>
                        
                     </td>
                    <td><input type="text" name="male" value="<?php echo $res[0]['Male']; ?>" size="5" /></td>
                    <td><input type="text" name="female" value="<?php echo $res[0]['Female']; ?>" size="5" />
                    <input type="hidden" value="<?php echo $res[0]['schoolinfo']; ?>" id="sid" name="schoolinfo" />
                    <input type="hidden" value="<?php echo $res[0]['ID']; ?>" id="sid" name="staffid" /></td>
                   
                    <td colspan="2">
                        <input type ="submit" name ="savebt" class="btn btn-info" value="Edit" />&nbsp;&nbsp;
                        <input type="submit" value="Close" name="closebt" class="btn btn-primary" /></td>
                </tr>

            </tbody>
        </table>     
    </form>
</div>

