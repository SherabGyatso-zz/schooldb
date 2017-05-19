<?php

require_once 'includes/config.php';
require_once 'classes/class.db.php';
//require_once 'classes/class.student.php';
require_once 'classes/class.class.php';
//require_once 'classes/class.utility.php';

//include('includes/header.php');

$db = new database();
//$student = new student($db);
//$students = $student->get_student($_GET['id']);
//$ch = new utility();

$class = new school_class($db);
//$classes = $class->get_class_list();

?>
<div class="col-sm-12 col-md-12">
    <h3 style="text-align: center;"><i class="icon-large icon-ok-sign"></i><span id="msg"></span></h3>
      <form id="stu_form" action="add_stu_process.php" method="post">
        <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
            <thead>
                <tr>	
                    <th>Class</th>
                    <th>Tib Boys </th>
                    <th>Tib Girls </th>
                    <th>Non Tib Boys</th>
                    <th>Non Tib Girls</th>
                    <th>Himalayan Boys</th>
                    <th>Himalayan Girls</th>
                    <th>Total</th>
                    <th>BBoys</th>
                    <th>BGirls</th>
                    <th>Days Boys</th>
                    <th>Days Girls</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>                 
                        <select name="class">
                            <option value="all">Select Class</option>
                            <?php
                          
                            $s_classes = $class->get_class();
                            //echo count($s_classes)."test";
                            if (is_array($s_classes) && count($s_classes)) {
                                foreach ($s_classes as $s_class) {
                                   echo "<option value='{$s_class['classid']}'>{$s_class['class']}</option>";
                                }
                            }
                            ?>
                        </select>
                        
                     </td>
                    <td><input type="text" placeholder="0" id="tboy" name="tboy" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0" id="tgirl" name="tgirl" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0" id="nboy" name="nboy" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0" name="ngirl" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0" name="hboy" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0" name="hgirl" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0" id="tot1" value="0" size="5" readonly="readonly"/></td>
                    <td><input type="text" placeholder="0" name="bboy" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0" name="bgirl" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0" name="dboy" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0" name="dgirl" value="0" size="5" />
                        <input type="hidden" value="<?php echo $_GET['id']; ?>" id="sid" name="typeid" /></td>
                    <td><input type="text" placeholder="0" id="tot2" value="0" size="5" readonly="readonly" /></td>
                    <td><input type ="submit" id="add_stu" class="btn btn-info" value="Add" /></td>
                </tr>

            </tbody>
        </table>     
    </form>
</div>
