<?php

/* List of schoolhead tables */

require_once 'includes/config.php';
require_once 'classes/class.main.php';
require_once 'classes/class.db.php';
require_once 'classes/class.school.php';
require_once 'classes/class.student.php';
require_once 'classes/class.class.php';

$db = new database();
$sch_head = new main_class($db);
$sch = new school($db);

$dls = $sch_head->get_deadline();

include('includes/header1.php');
$dl_cond="";
?>
<div class="col-sm-8 col-sm-offset-1 col-md-8 col-md-offset-1">

     <?php
    if (isset($_GET['msg']) && $_GET['msg'] != '') {
        echo '<h3 style="text-align:center; color:red;">' . $_GET['msg'] . '</h3>';
    }
    ?> 

     <?php
                    if(isset($_POST['dl']) && $_POST['dl'] !='') {
                        $dl_cond = $_POST['dl'];


                    }
                ?>
    <form action="" method="POST" class="print_disable">
    <table class="table table-hover table-responsive table-striped">
<tr>
<td>
<div class="form-group">
    <label> Select Deadline</label>
    <select name="dl" style="font-size: 18px;">

                <?php
                if (is_array($dls) && count($dls)) {
                    foreach ($dls as $dl) {
                        #echo "<option value='{$dl['deadline']}'>{$dl['deadline']}</option>";
                        echo "<option value='{$dl['deadline']}'";
                                if ( ( $dl['deadline'] == $dl_cond ) && !empty( $dl_cond ) ) { 
                                    echo ' selected';
                                }
                                echo ">{$dl['deadline']}</option>" . "\n";
                    }
                }
                ?>
    </select>
    <input type="submit" value="Choose" />
    </div>
    </td>
    </tr>
    </table>
    </form>
   <?php
    if(isset($_POST['dl']) && $_POST['dl'] !='') {
                $dl_cond = $_POST['dl'];
      
    ?>
    
    
<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>		
            <tr>
                <th>S.No</th>
                <th>School</th>
                <th>Reporting Officer</th>
                <th>Reporting Date</th>
                <th>Deadline</th>
                <th class="print_disable">Detail</th>
                <th class="print_disable">Action</th>


            </tr>
        </thead>
        <tbody>
            <?php
            
            $sch_heads = $sch_head->get_main_detail('',$dl_cond);
            $schools = $sch->get_school_list();
            
            $i = 1;
            if (is_array($sch_heads) && count($sch_heads)) {
                foreach ($sch_heads as $srow) {
                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $schools[$srow['schoolid']]; ?></td>  
                        <td><?php echo $srow['reportingofficer']; ?></td>
                        <td><?php echo $srow['reportingperiod']; ?></td>
                        <td><?php echo $srow['deadline']; ?></td>
                        <td class="print_disable"><a href="main_info.php?id=<?php echo $srow['schooltype']; ?>">Detail</a></td>
                        <td class="print_disable"><a href="main_edit.php?id=<?php echo $srow['schooltype']; ?>">Edit</a></td>
                    </tr>

                    <?php
                    ++$i;
                }
            }

            ?>

        </tbody>            
    </table>
    <?php
}
?>
</div>
<?php include_once 'includes/footer.php'; ?>