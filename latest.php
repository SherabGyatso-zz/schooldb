<?php session_start(); ?>
<!DOCTYPE">
<html>
    <head>
    <link rel="shortcut icon" type="image/x-icon" href="/schooldb/images/logo.jpeg" />

        <?php

        include("includes/connection.php");
        ?>
        <style type="text/css">
            <!--
            .class_col {color: #000000}
            -->
        </style>
        
        
    </head>
    <body>
        <?php include("includes/header.php"); ?>
        <div id="">


            <div align="center">

                <form name="school" method="post">

            
                    <input name="scl_button" type="submit" value="Click for latest Data" />
                </form>
            </div>
            <?php
//if(isset($_POST['year']))
            // {
            //$year = $_POST['year'];
            //query to find the latest reporting date and then display no. of staff in current year
            $student = "SELECT school.SchoolName, Sum((dboy+bboy+dgirl+bgirl)) AS stutot, Min(class.class) AS MinOfclass, " . "Max(class.class) AS MaxOfclass, staffhead.reportingperiod "
                    . "FROM class INNER JOIN (((SELECT staffhead.schoolid, "
                    . "MAX(staffhead.deadline) AS MaxOfdeadline FROM staffhead GROUP BY staffhead.schoolid) AS SQ INNER JOIN "
                    . "(school INNER JOIN staffhead ON school.SchoolID = staffhead.schoolid) ON (SQ.MaxOfdeadline = staffhead.deadline) "
                    . "AND (SQ.schoolid = staffhead.schoolid)) INNER JOIN studentstrength ON staffhead.schooltype = studentstrength.typeid) "
                    . "ON class.classid = studentstrength.class where school.status='A' GROUP BY school.SchoolName, staffhead.deadline order by school.sortby Asc";
            //echo $student;
            $stu_qry = mysqli_query($con, $student);

            $stu_array = array();
            while ($rec = mysqli_fetch_array($stu_qry)) {
                $stu_array[] = $rec;
            }



            $sql ="select school.sortby,school.SchoolName,truncate((sum(Female) + sum(Male)) / 2, 0) as 'Staff', 
staffhead.deadline from staffstrength inner join staffhead ON staffstrength.schoolinfo = staffhead.schooltype INNER JOIN school on school.SchoolID = staffhead.schoolid where staffhead.deadline= (select MAX(deadline) from staffhead) GROUP by school.SchoolName order by school.sortby ASC"; 

            $lst = mysqli_query($con, $sql);
            $staff_array = array();
            while ($row = mysqli_fetch_array($lst)) {
                $staff_array[] = $row;
            }
            ?>



            <br /> 

            <h3 style="text-align: center; color:#1856A9;">Latest Data</h3>

            <table class="table table-bordered table-striped table-hover table-condensed table-responsive" style="width:70%;"align="center">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>School(Class)</th>
                        <th>Student </th>
                        <th>Staff </th>
                        <th>Reporting Period </th>
                    </tr>
                </thead>
                <tbody>
<?php
$i = 0;
/* echo '<pre>';
  print_r($stu_array);
  echo '</pre>'; */
$stafftot = 0;
$stu_tot1 = 0;
for ($x = 0; $x < sizeof($stu_array); $x++) {
    ++$i;
    echo('<tr>');
    echo('<td >' . $i . '</td>');
    if ($stu_array[$x]['2'] == '(a)Pre-Primary')
        $stu_array[$x]['2'] = 'Pre-Primary';
    if ($stu_array[$x]['3'] == 'wIX')
        $stu_array[$x]['3'] = 'IX';
    echo('<td >' . $stu_array[$x]['0'] . " (<span class='class_col'>" . $stu_array[$x]['2'] . " - " . $stu_array[$x]['3'] . "</span>) " . '</td>');
    echo('<td >' . $stu_array[$x]['1'] . '</td>');
    echo('<td >' . number_format($staff_array[$x]['2']) . '</td>');
    echo('<td align="center">' . $stu_array[$x]['4'] . '</td>');
    echo('</tr>');
    $stafftot+=$staff_array[$x]['2'];
    $stu_tot1+=$stu_array[$x]['1'];
}
?>
                    <tr>
                        <td colspan="2">Grand Total</td>
                        <td><?php echo '<span class="class_col">' . $stu_tot1 . '</span>'; ?></td>
                        <td><?php echo '<span class="class_col">' . $stafftot . '</span>'; ?></td>
                        <td></td>
                    </tr>
                </tbody>   
            </table>


        </div>

<?php
//}//end of post if
include("includes/footer.php");
?>