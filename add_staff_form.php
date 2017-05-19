<?php

require_once 'includes/config.php';
require_once 'classes/class.db.php';
//require_once 'classes/class.staff.php';
require_once 'classes/class.designation.php';
//require_once 'classes/class.utility.php';

//include('includes/header.php');

$db = new database();
//$staff = new staff($db);
//$staffs = $staff->get_staff($_GET['id']);
//$ch = new utility();

$de = new designation($db);
//$des = $class->get_designation_list();

?>
<div class="col-sm-12 col-md-12">
    <h3 style="text-align: center;"><i class="icon-large icon-ok-sign"></i><span id="msg"></span></h3>
      <form id="staff_form" action="add_staff_process.php" method="post">
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
                                   echo "<option value='{$s_designation['ID']}'>{$s_designation['designation']}</option>";
                                }
                            }
                            ?>
                        </select>
                        
                     </td>
                    <td><input type="text" placeholder="0"  name="male" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0"  name="female" value="0" size="5" />
                    <input type="hidden" value="<?php echo $_GET['id']; ?>" id="sid" name="schoolinfo" /></td>
                    
                    <td><input type ="submit" id="add_staff" class="btn btn-info" value="Add" /></td>
                </tr>

            </tbody>
        </table>     
    </form>
</div>
