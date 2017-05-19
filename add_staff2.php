<?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.staff.php';
require_once 'classes/class.designation.php';
require_once 'classes/class.utility.php';

include('includes/header.php');

$db = new database();
$staff = new staff($db);
$staffs = $staff->get_staff($_GET['id']);
#$ch = new utility();

$designation = new designation($db);
$designations = $designation->get_designation_list();
#$class = new school_class($db);


?>
<div>
    <h2 style="text-align: center;"> Adding Staff Details </h2><hr/>


    <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>     
            <tr> 
                <th>S.No</th>  
                <th>Designation</th>
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $i = 1;
            $totmale = 0;
            $totfemale = 0;
            $overall = 0;
            if (is_array($staffs) && count($staffs)) {
                foreach ($staffs as $row) {

                    $totmale += $row['Male'];
                    $totfemale += $row['Female'];
                    $sbor = $row['Male'] + $row['Female'];
                    $tot = $sbor;
                    $overall = $overall + $tot;
                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $designations[$row['designationid']]; ?></td>  
                        <td><?php echo $row['Female']; ?></td>
                        <td><?php echo $row['Male']; ?></td>                     
                        <td ><?php echo $tot; ?></td>
                    </tr>

                    <?php
                    ++$i;
                }

                ?>
                <tr>
                    <th colspan="2" align="center"> Grand Total </th>
                    <th align="center"> <?php echo ($totmale / 2); ?> </th>
                    <th align="center"> <?php echo ($totfemale / 2); ?> </th>
                    <th align="center"> <?php echo ($overall / 2); ?> </th>
                </tr>
                <?php }
                ?>
            </tbody>
        </table>

        <?php
                 if ($_SERVER['REQUEST_METHOD']=='POST') {
                 if (isset($_POST['savebt']) && $_POST['savebt']=='Save') {

                 $_data = array(
                 'Male'=> trim($_POST['male']),
                 'Female'=> trim($_POST['female'])
                 );
                 if ($staff->add_staff($_data)) {
                 $id = $staff->get_new_staff_id();

                 $msg = "Added Successfully";
                 //echo("Added Successfully");
                 //header("Location:index.php?action=entry_main&id=$id&msg=$msg");
             }else {
             $msg = "Please fill the required field";
             //echo("Please fill the required field");
             //header("Location:index.php?action=entry_main&id=$id&msg=$msg");
         }


     }elseif (isset($_POST['closebt']) && $_POST['closebt'] == 'Cancel') {
     //elseif (isset($_POST['closebt'])) {
     header("Location:index.php?action=main_list");

     $msg = "Thank you";
     //echo("Thank You");
 }

}

?>
<div>
    <form action="" method="post">
        <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
                <thead>
                 <tr>    
                    <th>Designation</th>
                    <th>Male</th>
                    <th>Female</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>                 
                        <select name="designation">
                            <option value="all">Select Designation</option>
                            <?php
                            
                            $s_designations = $designation->get_designation();
                            echo count($s_designations)."test";
                            if (is_array($s_designations) && count($s_designations)) {
                                foreach ($s_designations as $s_designation) {
                                 echo "<option value='{$s_designation['ID']}'>{$s_designation['designation']}</option>";
                             }
                         }
                         ?>
                     </select>

                 </td>

                 <td><input type="text"   name="male" placeholder="" value="0" size="5" /></td>
                 <td><input type="text"   name="female" placeholder="" value="0" size="5" /></td>
                 <td><input type="text"  <?php echo ($Male + $Female); ?> value="0" size="5"> </td>
                 <td><input  id="add_staf" type="submit" value="Add" name="savebt" class="btn btn-primary" /></td>
                </tr>
            </tbody>
        </table>
     </form>
</div>
<div class="col-sm-2 col-sm-offset-1 col-md-2 col-md-offset-9">
<hr />
<a href="main_info.php?<?php echo 'id='.$_GET['id']; ?>" class="btn btn-primary btn-block" role="button" title="Add Staff and Result Data"><< Back</a>
</div>


<?php include_once 'includes/footer.php'; ?>
