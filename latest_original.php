<?php
/* entry for student, staff and result record */

require_once 'includes/config.php';
require_once 'classes/class.main.php';
require_once 'classes/class.db.php';
require_once 'classes/class.school.php';
require_once 'classes/class.class.php';
require_once 'classes/class.main.php';
require_once 'classes/class.student.php';




$db = new database();
$school = new school($db);
$sch = new school($db);


include('includes/header.php');
?>
<div id="" class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
    <h2 style="text-align: center;"> Latest Data </h2>
    <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>
            <tr>



            </thead>
            <tbody>
                <tr>
                    <th>S.no</th>
                    <th>Name of the Schools</th>
                    <th colspan="" align="center">Student</th>
                    <th colspan="" align="center">Staff</th>
                    <th colspan="" align="center">Reporting Period</th>
                </tr>
            </thead>

          

                <?php

                $h_latest_data_student = $school->get_latest_data_student();
                $h_latest_data_staff = $school->get_latest_data_staff();
                $schools = $sch->get_school_list();
                $i = 1;
                 /*<?php
                        foreach ($h_latest_data_staff as $row) {
                            ?>*/
                            if (is_array($h_latest_data_student) && count($h_latest_data_student)) {
                                foreach ($h_latest_data_student as $row) {


                                    ?> 


                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['SchoolName']; ?></td>
                                        <td><?php echo $row['Student']; ?></td>
                                        <td><?php echo $row['Staff']; ?></td>
                                        <td><?php echo $row['reporting']; ?></td>



                                    </tr>

                                    <?php
                                    $i++;


                                }  

                            }

                            ?>
                     
                    </tbody>
                </tr>
            </thead>
        </table>
    </div>
     
         <?php include("includes/footer.php"); ?>




