<?php
/* entry for student, staff and result record */

require_once 'includes/config.php';
require_once 'classes/class.main.php';
require_once 'classes/class.db.php';
require_once 'classes/class.school.php';
require_once 'classes/class.student.php';
require_once 'classes/class.class.php';

$db = new database();
$sch_head = new main_class($db);
$sch = new school($db);

$sch_heads = $sch_head->get_main_detail($_GET['id']);

$schools = $sch->get_school_list();

include('includes/header1.php');
?>
<div class="col-sm-10 col-sm-offset-1 col-md-7 col-md-offset-1">
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
    ?>
    <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>     
            <tr>
                <th>S.No</th>
                <th>School</th>
                <th>Reporting Officer</th>
                <th>Reporting Date</th>
                <th>Deadline</th>


            </tr>
        </thead>
        <tbody>
            <?php
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

                    </tr>
                    <?php
                    ++$i;
                }
            }
            ?>
        </tbody>            
    </table>
</div>

<!-- STUDENT INFORMATION -->

<?php
    $student = new student($db);
    $students = $student->get_student($_GET['id']);

    $class = new school_class($db);
    $classes = $class->get_class_list();

    if (count($students)) {
        ?>
      
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-0">
            <h2 style="text-align: center;"> Student Information </h2>
            <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
                <thead>
                    <tr>
                         <th rowspan="2" style="vertical-align:middle; text-align:center" >S.no</th>
                <th rowspan="2" style="vertical-align:middle">Class</th>
                <th colspan="3" style="vertical-align:middle; text-align:center">Tibetan</th>
                <th colspan="3" style="vertical-align:middle; text-align:center">Indian </th>
                <th colspan="3" style="vertical-align:middle; text-align:center">Himalayan </th>
                <th colspan="3" style="vertical-align:middle; text-align:center">Dayscholar </th>
                <th colspan="3" style="vertical-align:middle; text-align:center">Boarder</th>
                <th colspan="3" style="vertical-align:middle; text-align:center">Grand Total</th>
                <th colspan="2" rowspan="2" style="vertical-align:middle; text-align:center"> Action </th>
                        

                    </tr>
                
                    <tr>    
                     
                        <th>Boys </th>
                        <th>Girls </th>
                        <th>Total </th>
                        <th>Boys</th>
                        <th>Girls</th>
                        <th>Total </th>
                        <th>Boys</th>
                        <th>Girls</th>
                        <th>Total </th>
                        <th>Boys</th>
                        <th>Girls</th>
                        <th>Total </th>
                        <th>Boys</th>
                        <th>Girls</th>
                        <th>Total</th>
                        <th>Boys</th>
                        <th>Girls</th>
                        <th>Total</th>
                       
                       

                    </tr>
                    <?php
                    $i = 1;
                    $tibtotb = 0;
                    $tibtotg = 0;
                    $tibtot = 0;
                    $itotb = 0;
                    $itotg = 0;
                    $itot = 0;
                    $htotb = 0;
                    $htotg = 0;
                    $htot = 0;
                    $daytotb = 0;
                    $daytotg = 0;
                    $daytot = 0;
                    $boartotb = 0;
                    $boartotg = 0;
                    $boartot = 0;
                    $gtotb = 0;
                    $gtotg = 0;
                    $grtotb = 0;
                    $grtotg = 0;
                    $otot = 0;
                    if (is_array($students) && count($students)) {
                        foreach ($students as $row) {

                            $tibtotb += $row['tboy'];
                            $tibtotg += $row['tgirl'];

                            $itotb += $row['nboy'];
                            $itotg += $row['ngirl'];
                            $htotb += $row['hboy'];
                            $htotg += $row['hgirl'];
                            $daytotb += $row['dboy'];
                            $daytotg += $row['dgirl'];
                            $boartotb += $row['bboy'];
                            $boartotg += $row['bgirl'];

                            $tibtot = $tibtotb + $tibtotg;
                            $tibtotr = $row['tboy'] + $row['tgirl'];
                            $itot = $itotb + $itotg;
                            $itotr = $row['nboy'] + $row['ngirl'];
                            $htot = $htotb + $htotg;
                            $htotr = $row['hboy'] + $row['hgirl'];
                            $daytot = $daytotb + $daytotg;
                            $daytotr = $row['dboy'] + $row['dgirl'];
                            $boartot = $boartotb + $boartotg;
                            $boartotr = $row['bboy'] + $row['bgirl'];

                            $gtotb = $row['dboy'] + $row['bboy'];
                            $gtotg = $row['dgirl'] + $row['bgirl'];

                            $grtotb += $gtotb;
                            $grtotg += $gtotg;

    //$stib = $row['tboy'] + $row['tgirl'];
    //$shml = $row['nboy'] + $row['ngirl'];
    //$sind = $row['hboy'] + $row['hgirl'];
                            $tot = $gtotb + $gtotg;
                            $otot = $otot + $tot;

                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $classes[$row['class']]; ?></td>  
                                <td><?php echo $row['tboy']; ?></td>
                                <td><?php echo $row['tgirl']; ?></td>
                                <td><?php echo $tibtotr; ?></td>
                                <td><?php echo $row['nboy']; ?></td>
                                <td><?php echo $row['ngirl']; ?></td>
                                <td><?php echo $itotr; ?></td>
                                <td><?php echo $row['hboy']; ?></td>
                                <td><?php echo $row['hgirl']; ?></td>
                                <td><?php echo $htotr; ?></td>
                                <td><?php echo $row['dboy']; ?></td>
                                <td><?php echo $row['dgirl']; ?></td>
                                <td><?php echo $daytotr; ?></td>
                                <td><?php echo $row['bboy']; ?></td>
                                <td><?php echo $row['bgirl']; ?></td>
                                <td><?php echo $boartotr; ?></td>
                                <td><?php echo $gtotb; ?></td>
                                <td><?php echo $gtotg; ?></td>

                                <td><?php echo $tot; ?></td>
<td><a class="btn btn-danger btn-mini" href="edit_student_form.php?studentid=<?php echo $row['detailid']; ?>&mainid=<?php echo $row['typeid']; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> &nbsp;Edit</a></td>

<td><div data-table="student" class="del btn btn-danger btn-mini" data-id = "<?php echo $_GET['id']; ?>" id="<?php echo $row['detailid']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Delete</div></td>
                            </tr>

                            <?php
                            ++$i;
                        }
                        ?>
                        <tr>
                            <th colspan="2" align="center">Total</th>
                            <th align="center"><?php echo $tibtotb; ?></th>
                            <th align="center"><?php echo $tibtotg; ?></th>
                            <th align="center"><?php echo $tibtot; ?></th>
                            <th align="center"><?php echo $itotb; ?></th>
                            <th align="center"><?php echo $itotg; ?></th>
                            <th align="center"><?php echo $itot; ?></th>
                            <th align="center"><?php echo $htotb; ?></th>
                            <th align="center"><?php echo $htotg; ?></th>
                            <th align="center"><?php echo $htot; ?></th>
                            <th align="center"><?php echo $daytotb; ?></th>
                            <th align="center"><?php echo $daytotg; ?></th>
                            <th align="center"><?php echo $daytot; ?></th>
                            <th align="center"><?php echo $boartotb; ?></th>
                            <th align="center"><?php echo $boartotg; ?></th>
                            <th align="center"><?php echo $boartot; ?></th>
                            <th align="center"><?php echo $grtotb; ?></th>
                            <th align="center"><?php echo $grtotg; ?></th>

                            <th align="center"><?php echo $otot; ?></th>

                        </tr>
                        <?php }
                        ?>
                    </tbody>            
                </table>
            </div>
    <?php
//end of count(student)
}
?>
<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-0">
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="margin-bottom: 20px;">
        Add Student
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Student Records</h4>
                </div>
                <div class="modal-body">
                    <?php include('add_student_form.php'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>   
</div>

<!-- STAFF INFORMATION -->

<?php
require_once 'classes/class.staff.php';
require_once 'classes/class.designation.php';

$staff = new staff($db);
$staffs = $staff->get_staff($_GET['id']);

$desg = new designation($db);
$designations = $desg->get_designation_list();

if (count($staffs)) {
    ?>
    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-0">
        <h2 style="text-align: center;"> Staff Information </h2>

        <h3 style="text-align: center;"><i class="icon-large icon-ok-sign"></i><span id="msg"></span></h3>

        <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
            <thead>     
                <tr>    
                    <th>S.no</th>
                    <th>Designation</th>
                    <th>Male</th>
                    <th>Female</th>
                    <th>Total</th>
                   <th colspan="2" style="vertical-align:middle; text-align:center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $totmale = 0;
                $totfemale = 0;
                $overall = 0;
                if (is_array($staffs) && count($staffs)) {
                    foreach ($staffs as $staff) {

                        $totmale += $staff['Male'];
                        $totfemale += $staff['Female'];
                        $sbor = $staff['Male'] + $staff['Female'];
                        $tot = $sbor;
                        $overall = $overall + $tot;
                        ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $designations[$staff['designationid']]; ?></td>  
                            <td><?php echo $staff['Male']; ?></td>
                            <td><?php echo $staff['Female']; ?></td>                     
                            <td><?php echo $tot; ?></td>
<td><a class="btn btn-danger btn-mini" href="edit_staff_form.php?staffid=<?php echo $staff['ID']; ?>&mainid=<?php echo $staff['schoolinfo']; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> &nbsp;Edit</a></td>
<td><div data-table="staff" class="del btn btn-danger btn-mini" data-id = "<?php echo $_GET['id']; ?>" id="<?php echo $staff['ID']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Delete</div></td>
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
    </div>
    <?php
//end of count(student)
}
?>

<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-0">
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2" style="margin-bottom: 20px;">
        Add Staff
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Staff Record</h4>                   
                </div>
                <div class="modal-body">
                    <h3 style="text-align: center;"><i class="icon-large icon-ok-sign"></i><span id="msg"></span></h3>
<?php include('add_staff_form.php'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>   
</div>

<!-- Result -->
<?php
require_once 'classes/class.result.php';

$result = new result($db);
$results = $result->get_result($_GET['id']);

if (count($results)) {
    ?>
    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-0">
        <h2 style="text-align: center;"> Result Information </h2>
        <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
            <thead>     
                <tr>    
                    <th>S.no</th>
                    <th>Total</th>
                    <th>Appeared</th>
                    <th>Promoted</th>
                    <th>Retain</th>
                    <th colspan="2" style="vertical-align:middle; text-align:center">Action</th>
                </tr>   
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (is_array($results) && count($results)) {
                    foreach ($results as $result) {
                        ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['totstu']; ?></td>
                            <td><?php echo $result['stuappear']; ?></td>                     
                            <td><?php echo $result['stupromoted']; ?></td>
                            <td><?php echo $result['sturetain']; ?></td>




<td><a class="btn btn-danger btn-mini" href="edit_result_form.php?resultID=<?php echo $result['resultid']; ?>&mainid=<?php echo $result['schooltype']; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> &nbsp;Edit</a></td>
<td><div data-table="genresult" class="del btn btn-danger btn-mini" data-id = "<?php echo $_GET['id']; ?>" id="<?php echo $result['resultid']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Delete</div></td>


                        </tr>

                        <?php
                        ++$i;
                    }
                }
                ?>
            </tbody>            
        </table>
    </div>
    <?php
//end of count(student)
}
?>

<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-0">
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal3" style="margin-bottom: 20px;">
        Add Result
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Result</h4>
                </div>
                <div class="modal-body">
<?php include('add_result_form.php'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>   
</div>


<?php include_once 'includes/footer.php'; ?>