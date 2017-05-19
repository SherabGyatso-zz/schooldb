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
    
    
    $schools = $school->get_school();
    
   
    include('includes/header.php');
    $dl_cond="";
    ?>

<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
<thead>
<tr>
<td colspan="25" align="center">

<?php
                    if(isset($_POST['dl']) && $_POST['dl'] !='') {
                        $dl_cond = $_POST['dl'];
                    }
                ?>
                 <form action="" method="POST" >
                    <label class="print_disable"> Select Date</label>
                    <select class="print_disable"name="dl" style="font-size: 18px;">
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
                  <h2>School Wise Class Enrolment As On <?php echo gmdate("F j, Y", strtotime($_POST['dl'])); ?> </h2>
</td>
</tr>
<tr>
<th style="vertical-align:middle; text-align:center">S.no</th>
<th colspan="1" style="vertical-align:middle; text-align:center">School Name</th>
<th >Pre-Primary </th>
<th style="vertical-align:middle; text-align:center">I </th>
<th style="vertical-align:middle; text-align:center">II </th>
<th style="vertical-align:middle; text-align:center">III</th>
<th style="vertical-align:middle; text-align:center">IV</th>
<th style="vertical-align:middle; text-align:center">V </th>
<th style="vertical-align:middle; text-align:center">VI</th>
<th style="vertical-align:middle; text-align:center" style="vertical-align:middle; text-align:center">VII</th>
<th style="vertical-align:middle; text-align:center">VIII </th>
<th style="vertical-align:middle; text-align:center">IX</th>
<th style="vertical-align:middle; text-align:center">X</th>
<th >XI Hum </th>
<th>XI Com</th>
<th>XI Sc</th>
<th>XI Voc</th>
<th>XII Hum</th>
<th>XII Com</th>
<th>XII Sc</th>
<th>XII Voc</th>
<th>SP. Class</th>
<th>OC</th>
<th style="color: #f00; vertical-align:middle; text-align:center">Total</th>
</tr>
</thead>
<tbody>
     <?php

           $h_student_data = $school->get_student_total_by_class($dl_cond);
           $schools = $sch->get_school_list();


           $i = 1; $totpre = 0;   $totone = 0; $tottwo = 0; $totthree = 0; $totfour = 0; $totfive = 0; $totsix = 0;         $totseven = 0; $toteight = 0; $totnine = 0; $totten = 0; $totelevensc = 0; $totelevencom = 0;  
                $totelevenhum = 0;  $totelevenvoc = 0;  $tottwelvesc = 0; $tottwelvecom = 0; $tottwelvehum = 0;  
                $tottwelvevoc = 0; $totspecial = 0; $totoc = 0; $totgt = 0;

           if (is_array($h_student_data) && count($h_student_data)) {
               foreach ($h_student_data as $row) {

                $pre = $row['PrePrimary'];
                 $one = $row['I'];
                 $two = $row['II'];
                 $three = $row['III'];
                 $four = $row['IV'];  
                 $five = $row['V'];
                 $six = $row['VI'];
                 $seven = $row['VII'];
                 $eight = $row['VIII'];
                 $nine = $row['IX'];
                 $ten = $row['X'];
                 $elevensc = $row['XI_Sc'];
                 $elevencom = $row['XI_Com'];
                 $elevenhum = $row['XI_Hum'];
                 $elevenvoc = $row['XI_Voc'];
                 $twelvecom = $row['XII_Com'];
                 $twelvehum = $row['XII_Hum'];
                 $twelvesc = $row['XII_Sc'];
                 $twelvevoc = $row['XII_Voc'];
                 $special = $row['Special_Class'];
                 $oc = $row['OC'];
                 $tot = $row['Grand Total'];


                $totpre += $pre;
                $totone += $one;
                $tottwo += $two;
                $totthree += $three;
                $totfour += $four;
                $totfive += $five;
                $totsix += $six;
                $totseven += $seven;
                $toteight += $eight;
                $totnine += $nine;
                $totten += $ten;
                $totelevensc += $elevensc;
                $totelevencom += $elevencom;
                $totelevenhum+= $elevenhum;
                $totelevenvoc += $elevenvoc;
                $tottwelvecom += $twelvecom;
                $tottwelvehum += $twelvehum;
                $tottwelvesc += $twelvesc; 
                $tottwelvevoc += $twelvevoc;
                $totspecial += $special;
                $totoc += $oc;
                $totgt += $tot;





                   ?>



                    <tr>

                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['SchoolName']; ?></td>
                        <td><?php echo $row['PrePrimary']; ?></td>
                        <td><?php echo $row['I']; ?></td>
                        <td><?php echo $row['II']; ?></td>
                        <td><?php echo $row['III']; ?></td>
                        <td><?php echo $row['IV']; ?></td>
                        <td><?php echo $row['V']; ?></td>
                        <td><?php echo $row['VI']; ?></td>
                        <td><?php echo $row['VII']; ?></td>
                        <td><?php echo $row['VIII']; ?></td>
                        <td><?php echo $row['IX']; ?></td>
                        <td><?php echo $row['X']; ?></td>
                        <td><?php echo $row['XI_Sc']; ?></td>
                        <td><?php echo $row['XI_Com']; ?></td>
                        <td><?php echo $row['XI_Hum']; ?></td>
                        <td><?php echo $row['XI_Voc']; ?></td>
                        <td><?php echo $row['XII_Com']; ?></td>
                        <td><?php echo $row['XII_Hum']; ?></td>
                        <td><?php echo $row['XII_Sc']; ?></td>
                        <td><?php echo $row['XII_Voc']; ?></td>
                        <td><?php echo $row['Special_Class']; ?></td>
                        <td><?php echo $row['OC']; ?></td>
                        <td style="color: #f00;"><?php echo $row['Grand Total']; ?></td>
                    </tr>

                    <?php

                    $i++; 


                }
            }

            ?>
           <?php
         
            ?>
            <tr style="color: #f00;">
            
            <td colspan="2" style="vertical-align:middle; text-align:center">GRAND TOTAL</td>
            <td><?php  echo  $totpre ?></td> 
            <td><?php  echo  $totone ?></td> 
            <td><?php  echo  $tottwo ?></td> 
            <td><?php  echo  $totthree ?></td> 
            <td><?php  echo  $totfour ?></td> 
            <td><?php  echo  $totfive ?></td>
            <td><?php  echo  $totsix ?></td>
            <td><?php  echo  $totseven ?></td>
            <td><?php  echo  $toteight ?></td> 
            <td><?php  echo  $totnine ?></td>
            <td><?php  echo  $totten ?></td>
            <td><?php  echo  $totelevensc ?></td>
            <td><?php  echo  $totelevencom ?></td>
            <td><?php  echo  $totelevenhum?></td>
            <td><?php  echo  $totelevenvoc ?></td>
            <td><?php  echo  $tottwelvecom ?></td>
            <td><?php  echo  $tottwelvehum ?></td>
            <td><?php  echo  $tottwelvesc ?></td>
            <td><?php  echo  $tottwelvevoc ?></td>
            <td><?php  echo  $totspecial ?></td>
            <td><?php  echo  $totoc ?></td>
            <td><?php  echo  $totgt ?></td>
            </tr>  
    
      <?php
      }
      ?>  
        </tr>
        </tbody>
        </table>
         <?php include("includes/footer.php"); ?>    

