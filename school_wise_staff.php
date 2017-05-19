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
    error_reporting(E_ALL);
    $dl_cond="";
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
                    <input type="submit" value="Choose" class="print_disable"/>
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
                <th rowspan="3" colspan="2" style="vertical-align:middle">School Name</th>
                <th colspan="22" rowspan="1" style="vertical-align:middle; text-align:center">Teaching Staff</th>
                <th rowspan="3" style="vertical-align:middle; text-align:center">Non Teaching Staff</th>
                <th colspan="2" rowspan="1" style="vertical-align:middle; text-align:center">Staff </th>
                <th colspan="3" rowspan="3" style="color: #f00; vertical-align:middle; text-align:center">Total</th>
             

</tr>
<tr>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Princ</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Rect</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Dir</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >H.M</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >PGT</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >TGT</th>
    <th rowspan="1" colspan="2" style="vertical-align:middle; text-align:center" >TLT</th> 
    <th rowspan="2" style="vertical-align:middle; text-align:center" >PRT</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >PPRT</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Cult</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Comp</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >W/C</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Tail</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >PT</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Arts</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >D/M</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Lib</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Counslr</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Sup</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Chin Lang</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Rel</th> 
     <th rowspan="2" style="vertical-align:middle; text-align:center" >Tib staff</th>
    <th rowspan="2" style="vertical-align:middle; text-align:center" >Non Tib staff</th> 
</tr>
<tr> 
<th>PGT</th>
<th>TGT</th>
    </tr>
</thead>
<tbody>
     <?php

           $h_student_data = $school->get_staff_total_by_staff($dl_cond);
           $schools = $sch->get_school_list();

           $i = 1;  $totprin = 0; $totrec = 0; $totdi = 0; $tothead = 0; $totpgtnt = 0; $tottgtnt = 0; $totpgt = 0;        $tottgt = 0; $totprt = 0; $totpprt = 0; $totcul = 0; $totcom = 0; $totwood = 0; $tottail = 0; $totpt = 0;     $totart = 0; $totmusic = 0; $totlib = 0; $totcc = 0; $totsup = 0; $totchin = 0; $totrel = 0;
            $totnteachs = 0; $totts = 0; $totnts = 0; $totgt = 0;

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

                     $totprin += $prin;
                     $totrec += $rec;
                     $totdi += $di;
                     $tothead += $head;
                     $totpgtnt += $pgtnt;
                     $tottgtnt += $tgtnt;
                     $totpgt += $pgt;
                     $tottgt += $tgt;
                     $totprt += $prt;
                     $totpprt += $pprt;
                     $totcul += $cul;
                     $totcom += $com;
                     $totwood += $wood;
                     $tottail += $tail;
                     $totpt += $pt;
                     $totart += $art;
                     $totmusic += $music;
                     $totlib += $lib;
                     $totcc += $cc;
                     $totsup += $sup;
                     $totchin += $chin;
                     $totrel += $rel;
                     $totnteachs += $nteachs;
                     $totts += $ts;
                     $totnts += $nts;
                     $totgt += $gt;

                   ?>


                 <tr>

                        <td><?php echo $i; ?></td>
                        <td colspan="2" ><?php echo $row['SchoolName']; ?></td>
                        <td><?php echo $row['Princ']; ?></td>
                        <td><?php echo $row['Rect']; ?></td>
                        <td><?php echo $row['Dir']; ?></td>
                        <td><?php echo $row['Headm']; ?></td>
                        <td><?php echo $row['PGTNTibLang']; ?></td>
                        <td><?php echo $row['TGTNTibLang']; ?></td>
                        <td><?php echo $row['PGTTibLang']; ?></td>
                        <td><?php echo $row['TGTTibLang']; ?></td>
                        <td><?php echo $row['PRT']; ?></td>
                        <td><?php echo $row['PrePriTeacher']; ?></td>
                        <td><?php echo $row['Cultural']; ?></td>
                        <td><?php echo $row['Computer']; ?></td>
                        <td><?php echo $row['WoodCraft']; ?></td>
                        <td><?php echo $row['Tailoring']; ?></td>
                        <td><?php echo $row['PhysicalEducation']; ?></td>
                        <td><?php echo $row['Drawing']; ?></td>
                        <td><?php echo $row['DanceMusic']; ?></td>
                       
                        <td><?php echo $row['Librarian']; ?></td>
                        <td><?php echo $row['CareerCounselor']; ?></td>
                        <td><?php echo $row['Supervisor']; ?></td>
                        <td><?php echo $row['ChineseLang']; ?></td>
                        <td><?php echo $row['Religion']; ?></td>
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
            <td colspan="3">GRAND TOTAL</td>
            <td><?php echo $totprin ?></td> 
            <td><?php echo $totrec ?></td>
            <td><?php echo $totdi ?></td>
            <td><?php echo $tothead ?></td>
            <td><?php echo $totpgtnt ?></td>
            <td><?php echo $tottgtnt?></td>
            <td><?php echo $totpgt ?></td>
            <td><?php echo $tottgt ?></td>
            <td><?php echo $totprt ?></td>
            <td><?php echo $totpprt ?></td>
            <td><?php echo $totcul ?></td>
            <td><?php echo $totcom ?></td>
            <td><?php echo $totwood ?></td>
            <td><?php echo $tottail ?></td>
            <td><?php echo $totpt ?></td>
            <td><?php echo $totart ?></td>
            <td><?php echo $totmusic ?></td>
            <td><?php echo $totlib ?></td>
            <td><?php echo $totcc ?></td>
            <td><?php echo $totsup ?></td>
            <td><?php echo $totchin ?></td>
            <td><?php echo $totrel ?></td>
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
