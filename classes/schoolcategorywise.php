<?php
/* entry for student, staff and result record */

require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.student.php';
require_once 'classes/class.school.php';


include('includes/header1.php');
$db = new database();
$sch = new school($db);

$student = new student($db);
$schools = $sch->get_school_list();

$sql = "SELECT SchoolName, class, SUM( bboy ) + SUM( bgirl ) + SUM( dboy ) + SUM( dgirl ) AS total
FROM (studentstrength inner join staffhead on staffhead.schooltype = studentstrength.typeid) inner join school on school.schoolid=staffhead.SchoolID 
where deadline= '2015-12-31'
GROUP BY SchoolName, class 
order by sortby,class;";

$school_class_wise = $student->complex_query_for_reporting($sql);

$final_array = array(); // array for pivot 
//$test_arrau = array();

$x = 1;

$school_pre = '';
$class_pre = 0;

foreach ($school_class_wise as $school) {

    $class = $school['class']; //echo $x . ' test' .$class_pre. '<br />';
    $school_n = $school['SchoolName'];

    if ($x == 20) {       //for new row
        $x = $class;
        $i = 1;
        //echo $class.'<br />';
        while ($i < $class_pre) {          //   If primary class is not present for next school
            $final_array[$school_n][$i] = 0;
            ++$i;
        }
    } elseif ((($class - $class_pre) == 1 ) && strcmp($school_pre, $school_n) != 0) {    //when next school class 
        $i = $class;                                                                 //is continue with previous school class but without primary school                                                                               //when secondary school is not present       
        while ($i < 20) {
            $final_array[$school_pre][$i] = 0;
            ++$i;
        }
    }
    if (($class - $class_pre) > 1 && $class_pre != 0) {   //if in between class is missing
        $m = $class_pre + 1;
        while ($m < $class) {
            $final_array[$school_n][$m] = 0;
            ++$m;
        }
    }



    while ($x < 20) {     //loop till class XII and if there is no secondary or higher school then store 0 value
        //echo 'X'. $x .' class ' . $class. 'school '. $school_n. ' '.$class_pre.'<br />';  
        if ($x == $class) {
            if (strcmp($school_pre, $school_n) != 0) {  //when next school class is continue with previous school class but without primary school
                $i = 1;
                while ($i < $class) {
                    $final_array[$school_n][$i] = 0;
                    ++$i;
                }
            }
            $final_array[$school_n][$class] = $school['total'];
            ++$x;
            break;
        } else {
            if ($school_pre == '') {  // for the first school and there is no class primary class
                $final_array[$school_n][$x] = 0;
                ++$x;
            } else {
                $final_array[$school_pre][$x] = 0;          //if there is no secondary school
                ++$x;
            }
        }
    } //end while

    if ($school_pre != '') {  //for the first loop where previous school is not there
        if (strcmp($school_pre, $school_n) != 0) {
            $final_array[$school_n][$class] = $school['total'];   //total value of next school to store before moving on next record.
        }
    }
    $school_pre = $school['SchoolName'];
    $class_pre = $school['class'];
    //print('<pre>');
//print_r($final_array);
    //  print('</pre>');
} //end of foreach

?>

<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
    <thead>
        <tr>    
            <th>S.no</th>
            <th>School</th>
            <th>Primary</th>
            <th>I</th>
            <th>II</th>
            <th>III</th>
            <th>IV</th>
            <th>V</th>
            <th>VI</th>
            <th>VII</th>
            <th>VIII</th>
            <th>IX</th>
            <th>X</th>
            <th>XI Sc.</th>
            <th>XI Com.</th>
            <th>XI Hum</th>
            <th>XI Voc</th>
            <th>XII Com.</th>
            <th>XII Art</th>
            <th>XII Sc.</th>
            <th>XII Voc</th>
            <th>spe. Class</th>
            <th>OC</th>
            <th>Total</th>

        </tr>
    </thead>
    <tbody>
<?php
$y = 1;
$colsum = array();
foreach ($final_array as $row => $vals) {
    $rowtot = 0;
    ?>

            <tr>
                <td> <?php echo $y; ?> </td>
                <td> <?php echo $row; ?></td>

    <?php foreach ($vals as $i => $tot) { ?>
                <td>
                    <?php
                    echo $tot;
                    $rowtot += $tot;   //row sum
                    $colsum[$i] = isset($colsum[$i]) ? $colsum[$i] + $tot : $tot; //column sum
                    ?>
                </td>
                    <?php } ?>
                <td style="color:#000; font-weight:bold"> <?php echo $rowtot; ?> </td>
            </tr>
                <?php
                ++$y;
            }
            ?> <!-- printing column sum row -->
        <tr>
            <td colspan="2" style="color:#000; font-weight:bold"> Total</td>
            
        <?php 
           $grandtotal = 0;
           foreach ($colsum as $coltot) { 
               ?>
            <td style="color:#000; font-weight:bold"> 
                <?php 
                   $grandtotal += $coltot;
                   echo $coltot; 
                ?> 
            </td>            
        <?php } ?>
            <td style="color:#000; font-weight:bold"> <?php echo $grandtotal; ?> </td>
        </tr>
    </tbody>
</table>

