<?php
    /* entry for student, staff and result record */
    
    require_once 'includes/config.php';
    require_once 'classes/class.main.php';
    require_once 'classes/class.db.php';
    require_once 'classes/class.school.php';
    //require_once 'classes/class.student.php';
    //require_once 'classes/class.class.php';
    
    
    $db = new database();
    $school = new school($db);
    
    $sch_head = new main_class($db);
    $sch = new school($db);
    $dls = $sch_head->get_deadline();
    
    
    $schools = $school->get_school();
    
    //include('includes/header.php');
    include('includes/header.php');
    $dl_cond="";
    error_reporting(E_ALL);
    ?>

<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
<thead>
<tr>
<td colspan="29" align="center">

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
                    <input type="submit" value="Choose" vertical-align="bottom" class="print_disable"/>
                </form>

                <?php
                    if(isset($_POST['dl']) && $_POST['dl'] !='') {
                        $dl_cond = $_POST['dl'];
                   ?>
                    <h2>School Wise Staff Enrolment As On <?php echo gmdate("F j, Y", strtotime($_POST['dl'])); ?> </h2>
</td>
</tr>
<tr>
                <th rowspan="3" style="vertical-align:middle; text-align:center" >S.no</th>
                <th rowspan="2" colspan="" style="vertical-align:middle">School Category</th>
                <th colspan="" rowspan="2" style="vertical-align:middle; text-align:center">Teaching Staff</th>
                <th rowspan="2" style="vertical-align:middle; text-align:center">Non Teaching Staff</th>
                <th colspan="2" rowspan="1" style="vertical-align:middle; text-align:center">Staff </th>
                <th colspan="3" rowspan="3" style="color: #f00; vertical-align:middle; text-align:center">Total</th>
</tr>

<tr> 
<th>Tibetan</th>
<th>Non Tibetan</th>
    </tr>
</thead>
<tbody>
     <?php

           $h_student_data = $school->get_overall_school_category_staff_result($dl_cond);
           $schools = $sch->get_school_list();

           $i = 1;  $totprin = 0; $totrec = 0; $totdi = 0; $tothead = 0; $totpgtnt = 0; $tottgtnt = 0; $totpgt = 0;        $tottgt = 0; $totprt = 0; $totpprt = 0; $totcul = 0; $totcom = 0; $totwood = 0; $tottail = 0; $totpt = 0;     $totart = 0; $totmusic = 0; $totlib = 0; $totcc = 0; $totsup = 0; $totchin = 0; $totrel = 0;
            $totnteachs = 0; $totts = 0; $totnts = 0; $totgt = 0; $totteachsfin = 0;

           if (is_array($h_student_data) && count($h_student_data)) {
               foreach ($h_student_data as $row) {


                     $prin = $row['Princ'];
                     $rec = $row['Rect'];
                     $di = $row['Dir'];
                     $head = $row['Headm'];
                     $pgtnt = $row['PGTNTibLang'];
                     $tgtnt = $row['TGTNTibLang'];
                     $pgt = $row['PGTTibLang'];
                     $tgt = $row['TGTTibLang'];
                     $prt = $row['PRT'];
                     $pprt = $row['PrePriTeacher'];
                     $cul = $row['Cultural'];
                     $com = $row['Computer'];
                     $wood = $row['WoodCraft'];
                     $tail = $row['Tailoring'];
                     $pt = $row['PhysicalEducation'];
                     $art = $row['Drawing'];
                     $music = $row['DanceMusic'];
                     $lib = $row['Librarian'];
                     $cc = $row['CareerCounselor'];
                     $sup = $row['Supervisor'];
                     $chin = $row['ChineseLang'];
                     $rel = $row['Religion'];
                     $nteachs = $row['NonTeachingStaff'];
                     $ts = $row['Tibetstaff'];
                     $nts = $row['NonTibetanStaff'];
                     $gt = $row['Grand Total'];

                     $totteachs = $prin + $rec + $di + $head +$pgtnt + $tgtnt + $pgt + $tgt + $prt + $pprt + $cul + $com + $wood + $tail + $pt + $art + $music + $lib + $cc + $sup + $chin + $rel;
                     
                     $totteachsfin += $totteachs;
                     $totnteachs += $nteachs;
                     $totts += $ts;
                     $totnts += $nts;
                     $totgt += $gt;

                   ?>


                 <tr>

                        <td><?php echo $i; ?></td>
                        <td colspan="" ><?php echo $row['SchoolCategoryName']; ?></td>
                        <td><?php echo $totteachs; ?></td>
                         <td><?php echo $row['NonTeachingStaff']; ?></td>
                        <td><?php echo $row['Tibetstaff']; ?></td>
                        <td><?php echo $row['NonTibetanStaff']; ?></td>
                        <td style="color: #f00;"><?php echo $row['Grand Total']; ?></td>
                    </tr>

                    <?php

                    $i++; 

                }

            }
            ?>


            <tr style="color: #f00;">
            <td colspan="2" >GRAND TOTAL</td>
            <td><?php echo $totteachsfin ?></td>
            <td><?php echo $totnteachs ?></td>
            <td><?php echo $totts ?></td>
            <td><?php echo $totnts ?></td>
            <td><?php echo $totgt ?></td>


            </tr> 
            
<?php
}
?>
  </tr>
        </tbody>
        </table>
         <?php include("includes/footer.php"); ?>
