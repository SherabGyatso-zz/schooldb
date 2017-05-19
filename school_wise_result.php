<?php
/* entry for student, staff and result record */

require_once 'includes/config.php';
require_once 'classes/class.main.php';
require_once 'classes/class.db.php';
require_once 'classes/class.school.php';
require_once 'classes/class.student.php';
require_once 'classes/class.class.php';


$db = new database();
$school = new school($db);

$sch_head = new main_class($db);
$sch = new school($db);
$dls = $sch_head->get_deadline();

#$schools = $school->get_school();

include('includes/header.php');
error_reporting(E_ALL);
$dl_cond="";
#h_school = $school->get_student_total_by_schools();

?>


<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
    <thead>
    <div>
        <tr rowspan="">
            <td colspan="21" align="center">
                
                <?php
                    if(isset($_POST['dl']) && $_POST['dl'] !='') {
                        $dl_cond = $_POST['dl'];
                    }
                ?>


                <form action="" method="POST" >
                    <label class="print_disable"> Select Date</label>
                    <select class="print_disable" name="dl" style="font-size: 18px;">
                        <?php

                        if (is_array($dls) && count($dls)) {
                            foreach ($dls as $dl) {
                        # echo "<option value='{$dl['deadline']}'>{$dl['deadline']}</option>";

                                echo "<option value='{$dl['deadline']}'";
                                if ( ( $dl['deadline'] == $dl_cond ) && !empty( $dl_cond ) ) { 
                                    echo ' selected';
                                }
                               echo ">{$dl['deadline']}</option>" . "\n";
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" value="Choose" class="print_disable"/>
                </form>
                 <?php
                    if(isset($_POST['dl']) && $_POST['dl'] !='') {
                        $dl_cond = $_POST['dl'];
                    
                ?>
                  <h2>School Wise Result Enrolment As On <?php echo gmdate("F j, Y", strtotime($_POST['dl'])); ?> </h2>
                </td>
            </tr>
            
                <tr>
                   <th>S.no</th>
                   <th width="25%">School Name</th>
                   <th>Total</th>
                   <th>Appeared</th>
                   <th>Pass</th>
                   <th>Fail</th>
                   <th>Pass %</th>
                   <th>Fail %</th>
                   </tr>
     </thead>
        <?php

           $h_student_data = $school->get_student_result($dl_cond);
           $schools = $sch->get_school_list();
              $i = 1; $totstu = 0; $totappear = 0; $totpass = 0; $totfail = 0; $totpasspercentage = 0; $totfailpercentage = 0; $totpassperc = 0; $totfailperc = 0;


           if (is_array($h_student_data) && count($h_student_data)) {
               foreach ($h_student_data as $row) {

                     $tot = $row['Total'];
                     $appear = $row['Appeared'];
                     $pass = $row['Pass'];
                     $fail = $row['Fail'];
                     $passperc = $row['PassPercentage'];
                     $failperc = $row['FailPercentage'];


                     $totstu += $tot;
                     $totappear += $appear;
                     $totpass += $pass;
                     $totfail += $fail;
                     $totpassperc += $passperc;
                     $totfailperc += $failperc;
                     $totpasspercentage = $totpassperc / ($i);
                     $totfailpercentage = $totfailperc / ($i);

                   ?>


                    <tr>

                        <td><?php echo $i; ?></td>

                        <td><?php echo $row['SchoolName']; ?></td>
                        <td><?php echo $row['Total']; ?></td>
                        <td><?php echo $row['Appeared']; ?></td>
                        <td><?php echo $row['Pass']; ?></td>
                        <td><?php echo $row['Fail']; ?></td>
                        <td><?php echo $row['PassPercentage']; ?></td>
                        <td><?php echo $row['FailPercentage']; ?></td>
                    

                    </tr>

                    <?php

                    ++$i; 

                }
            }

            ?>
                <tr style="color: #f00;">
            <td colspan="2" style="vertical-align:middle; text-align:center">GRAND TOTAL / AVERAGE PERCENTAGE</td>
            <td><?php echo $totstu ?></td> 
            <td><?php echo $totappear ?></td>
            <td><?php echo $totpass ?></td>
            <td><?php echo $totfail ?></td>
            <td><?php echo substr($totpasspercentage, 0, 4) ?> %</td>
            <td><?php echo substr($totfailpercentage, 0, 4) ?> %</td>   
            </tr> 
        </div>
   <?php 
    }
    ?>  </tr>
        </tbody>
        </table>
         <?php include("includes/footer.php"); ?>
