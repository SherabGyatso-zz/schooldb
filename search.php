<?php
session_start();
//error_reporting(E_ALL);
?>
<!DOCTYPE>
<html>
    <head>
    <link rel="shortcut icon" type="image/x-icon" href="/schooldb/images/logo.jpeg" />
        <?php
        //include("includes/linkcss.php");
        include("includes/common_function.php");
        ?>
        <link href="includes/prject.css" rel="stylesheet" />
        <SCRIPT type="text/javascript">
            <!--
            function display(obj, id2)
            {
                txt = obj.options[obj.selectedIndex].value;
                document.getElementById(id2).style.visibility = 'hidden';
                if (txt.match(id2)) {
                    document.getElementById(id2).style.visibility = 'visible';
                }
            }

            //-->
        </SCRIPT>

    </head>
    <body>
        <?php include("includes/header.php"); ?>
        <div >
            <?php
            if (isset($msg) != "")
                echo '<span class="validationmessage">' . $msg . '</span>';
            ?>
            <h3 style="text-align: center">Search </h3>
            <form action="search.php" method="post">
                <table class="table table-bordered table-striped table-hover table-condensed table-responsive" style="width:50%;" align="center">

                    <tr>
                        <th style="font-size:16px; text-align: right;">School:&nbsp;&nbsp;&nbsp;</th>
                        <?php
                        include("includes/connection.php");
                        $sql = "select SchoolID, SchoolName from school order by SchoolName";
                        $result = mysqli_query($con, $sql);

                        $selected = '';
                        $subjid = '';
                        ?>
                        <th width="25%" style="font-size:16px;" >
                            <select id="school" name="school" >
                                <option value="all" selected="selected"><- -Select School- -></option>
                                <!--style="visibility:hidden;" -->
                                <?php
                                if (isset($_POST['school']) && $_POST['school'] != "")
                                    $_SESSION['schoolid'] = $_POST['school'];
                                if (isset($_SESSION['schoolid']) && $_SESSION['schoolid'] != "") {
                                    $subjid = $_SESSION['schoolid'];
                                    $_SESSION['schooln'] = $subjid;
                                    unset($_SESSION['schoolid']);
                                }
                                while ($row = mysqli_fetch_array($result)) {
                                    $selected = '';
                                    $schoolid = $row['SchoolID'];
                                    $schoolname = $row['SchoolName'];


                                    if ($row['SchoolID'] == $subjid) {
                                        $selected = 'selected';
                                        $schoolname1 = $row['SchoolName'];
                                    }
                                    echo "<option value=\"$schoolid\" $selected> $schoolname </option>";
                                }
                                ?>
                            </select>
                        </th>

                        <?php
                        if (isset($_POST['schoolcat'])) {
                            $opt = $_POST['schoolcat'];

                            switch ($opt) {
                                case 1:
                                    $select1 = "selected";
                                    break;
                                case 2:
                                    $select2 = "selected";
                                    break;
                                case 3:
                                    $select3 = "selected";
                                    break;
                                case 4:
                                    $select4 = "selected";
                                    break;
                                case 5:
                                    $select5 = "selected";
                                    break;
                            }
                        }
                        ?>

                        <td width="10%" style="font-size:16px;padding-top:5px;"><!--onclick="document.getElementById('school').style.visibility ='visible';" -->
                            <select name="schoolcat">
                                <option value="all" selected="selected"><- -Select Cat- -></option>
                                <option value="1" <?php isset($select1) ? $select1 : ''; ?>>TCV</option>
                                <option value="2" <?php isset($select2) ? $select2 : ''; ?>>CTSA</option>
                                <option value="3" <?php isset($select3) ? $select3 : ''; ?>>STSA</option>
                                <option value="4" <?php isset($select4) ? $select4 : ''; ?>>THF</option>
                                <option value="5" <?php isset($select5) ? $select5 : ''; ?>>Others</option>
                                <option value="6">Nepal</option>
                            </select></td>
                        <?php
                        if (isset($_POST['year']) and ! empty($_POST['year']))
                            $_SESSION['yeartxt'] = $_POST['year'];

                        $selected = '';

                        If (isset($_POST['ReportingDt'])) {
                            if ($_POST['ReportingDt'] == 1) {
                                $_SESSION['radioch1'] = 'checked';
                                // $ch1 = 'checked';
                            } elseif ($_POST['ReportingDt'] == 2) {
                                $_SESSION['radioch2'] = 'checked';
                                // $ch2 = 'checked';
                            }
                        }
                        $ch1 = isset($_SESSION['radioch1']) ? $_SESSION['radioch1'] : '';
                        $ch2 = isset($_SESSION['radioch2']) ? $_SESSION['radioch2'] : '';

                        if ($ch1 == '' && $ch2 == '')
                            $ch1 = 'checked';

                        $sqyear = "select distinct deadline as year from staffhead where deadline order by deadline desc";
                        $re = mysqli_query($con, $sqyear);
                        ?>

                        <th style="width:25; font-size:16px;">
                            <input name="ReportingDt" type="radio" value="1" <?php echo $ch1; ?>/>Reporting Period:</th>
                        <td style="font-size:16px;padding-top:5px;">

                            <select name="year">
                                <option value="all" selected="selected"><- -Select Date- -></option>

                                <?php
                                $subjid = isset($_SESSION['yeartxt']) ? $_SESSION['yeartxt'] : '';
                                unset($_SESSION['yeartxt']);


                                while ($row1 = mysqli_fetch_array($re)) {
                                    $selected = '';
                                    $deadline_d = $row1['year'];

                                    if ($row1['year'] == $subjid) {
                                        $selected = 'selected';
                                    }
                                    echo "<option value=\"$deadline_d\" $selected> $deadline_d </option>";
                                }
                                ?>
                            </select></td>

                        <td style="font-size:16px;"><input name="ReportingDt" type="radio" value="2" <?php echo $ch2; ?> />Latest Data</td>
                    </tr>
                    <tr>


                        <?php
                        unset($_SESSION['radioch1']);
                        unset($_SESSION['radioch2']);
                        $checked1 = 'CHECKED';
                        $checked2 = '';
                        $checked3 = '';
                        $checked4 = '';
                        if (isset($_POST['Group'])) {
                            if ($_POST['Group'] == 1) {
                                $stu_opt = "";
                                $checked1 = 'CHECKED';
                            } elseif ($_POST['Group'] == 2) {
                                $stu_opt = $_POST['stu'];
                                $checked2 = 'CHECKED';
                            } elseif ($_POST['Group'] == 3) {
                                $stu_opt = "";
                                $checked3 = 'CHECKED';
                            }
                        } else {
                            $checked1 = 'checked';
                        }
                        ?>   
                        <td colspan="7" style="font-size:16px;">
                            <input type="radio" name="Group" value="1" <?php echo $checked1; ?> />&nbsp;&nbsp;Individual School 
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:16px;" nowrap="nowrap">
                            <input name="Group" type="radio" value="2" <?php echo $checked2; ?> />&nbsp;&nbsp;Student</td>
                        <?php
                        if (isset($stu_opt) && $stu_opt != "") {
                            switch ($stu_opt) {
                                case 1:
                                    $boarder = "selected";
                                    break;
                                case 2:
                                    $days = "selected";
                                    break;
                                case 3:
                                    $tib = "selected";
                                    break;
                                case 4:
                                    $ntib = "selected";
                                    break;
                                case 5:
                                    $class = "selected";
                                    break;
                            }
                        }
                        ?>
                        <td><select name="stu" onchange="display(this, '5');">
                                <option value="1" <?php isset($boarder) ? $boarder : ''; ?> >boarder</option>
                                <option value="2" <?php isset($days) ? $days : ''; ?> >dayscholar</option>
                                <option value="3" <?php isset($tib) ? $tib : ''; ?> >Tibetan</option>
                                <option value="4" <?php isset($ntib) ? $ntib : ''; ?> >NonTibetan</option>
                                <option value="5" <?php isset($class) ? $class : ''; ?> >Class</option>
                            </select></td>

                        <td id="5" colspan="5" style="visibility:hidden;">Enter Class in numeric ( e.g 5 or 2 or 8) <input name="cls" type="text" size="7" />
                            <input name="exact" type="checkbox" />
                            exact</td>
                    </tr>
                    <tr>
                        <td style="font-size:16px;"><input type="radio" name="Group" value="3" <?php echo $checked3; ?> />&nbsp;&nbsp;Staff</td>
                        <td><?php
                            $q = "select ID, designation from designation";
                            $set = mysqli_query($con, $q);

                            if (isset($_POST['searchopt']))
                                $_SESSION['desgid'] = $_POST['searchopt'];


                            $did = isset($_SESSION['desgid']) ? $_SESSION['desgid'] : '';

                            unset($_SESSION['desgid']);
                            $select = '';
                            echo '<select name="searchopt">';

                            while ($des = mysqli_fetch_array($set)) {
                                $select = '';
                                $dsgid = $des['ID'];
                                $desig = $des['designation'];
                                if ($des['ID'] == $did) {
                                    $select = 'selected';
                                    $desig = $des['designation'];
                                } elseif ($did == 'teaching')
                                    $select = 'selected';

                                echo "<option value=\"$dsgid\" $select> $desig </option>";
                            }
                            echo '<option value="teaching" $select>Teaching Staff</option>';
                            ?></td>
                        <td></select>       </td>
                        <td colspan="4"></td>
                    </tr>


                    <tr>
                        <td></td>
                        <td><input class="button bg-success" name="submit" type="submit" value="Search" size="7"/></td><td colspan="4" ></td>
                    </tr>
                </table>

            </form>
            <br />
            <?php
//list of school report

            if (isset($_POST['submit']) and ! empty($_POST['submit'])) {
                $option = $_POST['Group'];
                $grp_by = "school.sortby";
                $deadline = $_POST['year'];
                $_SESSION['reporting_time'] = $_POST['ReportingDt'];
                //if we select all school then no need of schoolid;

                $text = "Search Result";
                $ch = where_cond($_POST);

                switch ($option) {

                    case 1:  //display detail record of each school
                        if ($_POST['ReportingDt'] == 1)
                            $record = "SELECT distinct school.SchoolName, school.sortby, staffhead.reportingperiod, staffhead.reportingofficer, staffhead.place, staffhead.schoolid, staffhead.schooltype, YEAR(staffhead.deadline) AS YEAR,  staffhead.deadline FROM ((school INNER JOIN staffhead ON school.SchoolID = staffhead.schoolid) INNER JOIN (staffstrength INNER JOIN designation ON staffstrength.designationid = designation.ID) ON staffhead.schooltype = staffstrength.schoolinfo) INNER JOIN schoolcategory ON school.SchoolCategoryId = schoolcategory.SchoolCategoryId " . $ch . " order by " . $grp_by . ";";
                        else
                            $record = "SELECT school.SchoolName, staffhead.deadline, staffhead.reportingperiod, staffhead.reportingofficer, staffhead.place, staffhead.schooltype FROM (SELECT staffhead.schoolid, MAX(staffhead.deadline) AS MaxOfdeadline FROM staffhead GROUP BY staffhead.schoolid) AS SQ INNER JOIN (school INNER JOIN staffhead ON school.SchoolID = staffhead.schoolid) ON (SQ.schoolid = staffhead.schoolid) AND (SQ.MaxOfdeadline = staffhead.deadline) " . $ch . " order by schoolname;";


                        $lst = mysqli_query($con, $record);
                        $num = mysqli_num_rows($lst);
                        //echo $num;
                        if ($num >= 1) {
                            ?>
                            <div class="main-content" style="text-align: center;">
                                <h3> 
                                    <?php
                                    if (isset($_POST['school']) && $_POST['school'] == 'all') {
                                        echo 'LIST OF SCHOOLS';
                                    } else {
                                        $sch_name = get_school_name($_POST['school']);
                                        echo $sch_name;
                                    }
                                    ?>

                                </h3> 
                            </div>

            <table class="table table-bordered table-striped table-hover table-condensed table-responsive" style="width:95%" align="center">

                                <thead><tr>	
                                        <th width="7%">S.no</th>
                                        <th width="21%">Reporting Period</th>
                                        <th width="20%">Officer</th>
                                        <th width="10%">Place</th>
                                        <?php
                                        if ($_POST['school'] == 'all')
                                            echo '<th width=\"80%\"> School </th>';
                                        ?>
                                        <th width="20%">Detail</th>

                                    </tr></thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    //$row3 = mysql_fetch_array($lst);
                                    ;
                                    while ($row3 = mysqli_fetch_array($lst)) {
                                        //print_r($row3);
                                        ++$i;
                                        echo('<tr>');
                                        echo('<td >' . $i . '</td>');
                                        echo('<td>' . $row3['reportingperiod'] . '</td>');
                                        echo('<td>' . $row3['reportingofficer'] . '</td>');
                                        echo('<td>' . $row3['place'] . '</td>');
                                        if ($_POST['school'] == 'all') {
                                            echo '<td width=\"100\">' . $row3['SchoolName'] . '</td>';
                                            $schoolname1 = $row3['SchoolName'];
                                            $_SESSION['schooln'] = isset($schoolname1) ? $schoolname1 : 'all';
                                        }
                                        echo '<td><a href="student.php' . '?idstu=' . $row3['schooltype'] . '&repdate=' . $row3['deadline'] . '&schoolname=' . $schoolname1 . '">>>Detail</a></td>';
                                        echo('</tr>');
                                        // $_SESSION['sID'] = $row3['reportingperiod'];
                                    }
                                    ?></tbody>
                            </table>

                            <?php
                        } else {
                            $msg = "there is no records";
                            echo '<span class="validationmessage">' . $msg . '</span>';
                        }

                        break;
                    case 2:

                        $choice = $_POST['stu'];

                        //if the choice is other than class
                        if ($choice != 5) {
                            switch ($choice) {
                                case 1:
                                    $boy = 'bboy';
                                    $girl = 'bgirl';
                                    $res = "Boarder";
                                    break;
                                case 2:
                                    $boy = 'dboy';
                                    $girl = 'dgirl';
                                    $res = "Dayscholar";
                                    break;
                                case 3:
                                    $boy = 'tboy';
                                    $girl = 'tgirl';
                                    $res = "Tibetan";
                                    break;
                                case 4:
                                    $boy = 'nboy';
                                    $girl = 'ngirl';
                                    $res = "Non Tibetan";
                                    break;
                            } //inner switch ends
                            if ($_POST['ReportingDt'] == 1) {
                                $qu = "select school.SchoolName, staffhead.deadline, sum(" . $boy . ") as Boy, sum(" . $girl . ") as Girl FROM (staffhead INNER JOIN school ON staffhead.schoolid = school.SchoolID) INNER JOIN studentstrength ON staffhead.schooltype = studentstrength.typeid " . $ch . " Group by " . $grp_by . ";";
                            } else {
                                $qu = "SELECT school.SchoolName, sum(" . $boy . ") as Boy, sum(" . $girl . ") as Girl, staffhead.deadline
FROM ((SELECT staffhead.schoolid,MAX(staffhead.deadline) AS MaxOfdeadline FROM staffhead GROUP BY staffhead.schoolid) qryMaxDeadlinesForSchoolIDs INNER JOIN (school INNER JOIN staffhead ON school.SchoolID = staffhead.schoolid) ON (qryMaxDeadlinesForSchoolIDs.MaxOfdeadline = staffhead.deadline) AND (qryMaxDeadlinesForSchoolIDs.schoolid = school.SchoolID)) INNER JOIN studentstrength ON staffhead.schooltype = studentstrength.typeid " . $ch . "
GROUP BY school.SchoolName, staffhead.deadline, school.sortby ORDER BY school.sortby;";
                            }
                            //echo $qu;
                            $q2 = mysqli_query($con, $qu);
                            ?>
                            <table width="50%" align="center"><tr><th colspan="5" align="center"> <h2><?php $text ?> of <?php $res ?> Student </h2></th></tr>
                                <tr><th>S.no</th><th>School</th><th>Boys</th><th>Girls</th><th>Total</th><th>Deadline</th></tr>
                                <?php
                                //display total boarder boys and girls with school name
                                $x = 0;
                                $tot_boy = 0;
                                $tot_girl = 0;
                                $sub_tot = 0;
                                while ($lst = mysqli_fetch_array($q2)) {
                                    echo('<tr>');
                                    ++$x;
                                    echo('<td >' . $x . '</td>');
                                    echo('<td>' . $lst['SchoolName'] . '</td>');
                                    echo('<td>' . $lst['Boy'] . '</td>');
                                    echo('<td>' . $lst['Girl'] . '</td>');
                                    $sub = $lst['Boy'] + $lst['Girl'];
                                    echo('<td>' . $sub . '</td>');
                                    echo('<td >' . $lst['deadline'] . '</td>');
                                    echo('</tr>');
                                    $tot_boy +=$lst['Boy'];
                                    $tot_girl+=$lst['Girl'];
                                    $sub_tot+=$sub;
                                }//end of while >
                                echo('<tr>');
                                echo('<td colspan="2">Grand Total</td>');
                                echo('<td >' . $tot_boy . '</td>');
                                echo('<td >' . $tot_girl . '</td>');
                                echo('<td >' . $sub_tot . '</td>');

                                echo('</tr>');
                                echo '</table>';
                            }//end of chioce if
                            //if the choice is class
                            else {

                                $ex = isset($_POST['exact']) ? $_POST['exact'] : '';
                                $cl = isset($_POST['cls']) ? $_POST['cls'] : '';
                                if ($ex == 'on')
                                    $cond = $ch . " and class.ClassNum =" . $cl;
                                elseif ($cl != "")
                                    $cond = $ch . " and class.ClassNum >=" . $cl;
                                else
                                    $cond = $ch;

                                $qw = "SELECT school.SchoolName, SUM(bboy+dboy) AS Boy, SUM(bgirl+dgirl) AS Girl, staffhead.deadline, class.class, class.sortby, school.sortby 
FROM class INNER JOIN 
(((SELECT staffhead.schoolid,MAX(staffhead.deadline) AS MaxOfdeadline FROM staffhead GROUP BY staffhead.schoolid) AS qryMaxDeadlinesForSchoolIDs INNER JOIN (school INNER JOIN staffhead ON school.SchoolID = staffhead.schoolid) ON (qryMaxDeadlinesForSchoolIDs.MaxOfdeadline = staffhead.deadline) AND (qryMaxDeadlinesForSchoolIDs.schoolid = school.SchoolID)) INNER JOIN studentstrength ON staffhead.schooltype = studentstrength.typeid) ON class.classid = studentstrength.class " . $cond . " GROUP BY school.SchoolName, staffhead.deadline, class.class, class.sortby, school.sortby, school.sortby ORDER BY school.sortby, class.sortby ";
                                /* $qw ="SELECT  school.SchoolName, class.classid, studentstrength.tboy, studentstrength.nboy, studentstrength.tgirl, studentstrength.ngirl, class.class FROM ((school INNER JOIN staffhead ON school.SchoolID = staffhead.schoolid) INNER JOIN studentstrength ON staffhead.schooltype = studentstrength.typeid) INNER JOIN class ON studentstrength.class = class.classid".$cond." order by school.sortby, class.sortby"; */

                                $clqry = mysqli_query($con, $qw);
                                ?>
                                <table width="50%" align="center"><tr><th colspan="6" align="center"><h2><?php $text ?> </h2></th></tr>
                                    <tr><th>S.no</th><th>School Name</th><th>Class</th><th> Boys</th><th>Girls</th><th>Total</th></tr>
                                    <?php
                                    $rec = array();
                                    $tboy = 0;
                                    $tgirl = 0;
                                    $ttot = 0;
                                    $gtboy = 0;
                                    $gtgirl = 0;
                                    $gttot = 0;
                                    while ($clr = mysqli_fetch_assoc($clqry)) {
                                        $tboy = $clr['Boy'];
                                        $tgirl = $clr['Girl'];
                                        $ttot = $tboy + $tgirl;

                                        $rec[$clr['SchoolName']][$clr['class']] = array('tboy' => $tboy, 'tgirl' => $tgirl, 'tot' => $ttot);
                                    }//while end
                                    // echo '<pre>';
                                    //  print_r($rec);
                                    //to hide duplicate;
                                    $y = 1;
                                    foreach ($rec as $key => $val) {
                                        echo '<tr>';
                                        echo '<td>' . $y . '</td>';
                                        echo '<th colspan="5">' . $key . '</th>';
                                        echo '</tr>';
                                        $gtot = 0;
                                        $totboy = 0;
                                        $totgirl = 0;
                                        foreach ($val as $class => $num) {
                                            echo '<tr>';
                                            echo '<td></td>';
                                            echo '<td></td>';
                                            echo '<td>' . $class . '</td>';
                                            echo '<td>' . $num['tboy'] . '</td>';
                                            echo '<td>' . $num['tgirl'] . '</td>';
                                            echo '<td>' . $num['tot'] . '</td>';
                                            echo '</tr>';
                                            $gtot = $num['tot'] + $gtot;
                                            $totboy +=$num['tboy'];
                                            $totgirl+=$num['tgirl'];
                                        }
                                        ++$y;
                                        echo '<tr>';
                                        echo '<td colspan="2"><td>Grand Total</td><td>' . $totboy . '</td><td>' . $totgirl . '</td></td><td>' . $gtot . '</td>';
                                        echo '</tr>';
                                        $gtboy+=$totboy;
                                        $gtgirl+=$totgirl;
                                        $gttot+=$gtot;
                                    }
                                    echo '<tr>';
                                    echo '<th colspan="3"> Grand Total</th><th>' . $gtboy . '</th><th>' . $gtgirl . '</th></th><th>' . $gttot . '</th>';
                                    echo '</tr>';
                                    echo '</table>';
                                } //end of else

                                break;
                            case 3:
                                $staffsearch = $_POST['searchopt'];

                                if ($staffsearch == 'teaching') {
                                    $staffsql = "SELECT school.SchoolName, sum(staffstrength.Female) as Female, sum(staffstrength.Male) as Male, staffhead.deadline AS MaxOfdeadline "
                                            . "FROM ((staffhead INNER JOIN school ON staffhead.schoolid = school.SchoolID) INNER JOIN "
                                            . "staffstrength ON staffhead.schooltype = staffstrength.schoolinfo) INNER JOIN "
                                            . "(SELECT staffhead.schoolid,MAX(staffhead.deadline) AS MaxOfdeadline FROM staffhead GROUP BY staffhead.schoolid) AS qryMaxDeadlinesForSchoolIDs ON"
                                            . "(qryMaxDeadlinesForSchoolIDs.MaxOfdeadline = staffhead.deadline) AND (school.SchoolID = qryMaxDeadlinesForSchoolIDs.schoolid) "
                                            . $ch . " group by schoolname";

                                    $staffsearch = 'Teaching Staff';
                                } else {
                                    $staffsql = "SELECT designation.designation, staffstrength.designationid, staffstrength.Female, staffstrength.Male, school.SchoolName, staffhead.deadline AS MaxOfdeadline
FROM ((staffhead INNER JOIN school ON staffhead.schoolid = school.SchoolID) INNER JOIN (designation INNER JOIN staffstrength ON designation.ID = staffstrength.designationid) ON staffhead.schooltype = staffstrength.schoolinfo) INNER JOIN (SELECT staffhead.schoolid,MAX(staffhead.deadline) AS MaxOfdeadline FROM staffhead GROUP BY staffhead.schoolid) AS qryMaxDeadlinesForSchoolIDs ON (qryMaxDeadlinesForSchoolIDs.MaxOfdeadline = staffhead.deadline) AND (school.SchoolID = qryMaxDeadlinesForSchoolIDs.schoolid) 
" . $ch . " and staffstrength.designationid = $staffsearch group by schoolname, designationid, male, female, deadline";
                                }
                                //echo $staffsql;
                                $staffsql2 = mysqli_query($con, $staffsql);
                                ?>
                                <table width="50%" align="center"><tr><th colspan="5" align="center"> <h2><?php $text ?> of <?php $staffsearch ?></h2></th></tr>
                                    <tr><th>S.no</th><th>Schoool</th><th>Male</th><th>Female</th><th>Total</th><th>Reporting Period</th></tr>
                                    <?php
                                    $n = mysqli_num_rows($staffsql2);
                                    if ($n >= 1) {
                                        //display total boarder boys and girls with school name
                                        $s = 0;
                                        $totboy = 0;
                                        $totgirl = 0;
                                        $gtot = 0;
                                        while ($sql3 = mysqli_fetch_array($staffsql2)) {
                                            echo('<tr>');
                                            ++$s;
                                            echo('<td >' . $s . '</td>');
                                            echo('<td>' . $sql3['SchoolName'] . '</td>');
                                            echo('<td>' . $sql3['Male'] . '</td>');
                                            echo('<td>' . $sql3['Female'] . '</td>');

                                            $subt = $sql3['Female'] + $sql3['Male'];

                                            echo('<td>' . $subt . '</td>');
                                            echo('<td>' . $sql3['MaxOfdeadline'] . '</td>');
                                            $totboy+=$sql3['Male'];
                                            $totgirl+=$sql3['Female'];
                                            $gtot+=$subt;
                                            echo('</tr>');
                                        }//end of while
                                    }//end if
                                    else {
                                        echo('<tr>');
                                        echo('<td colspan ="5" align="center"> There is no Records </td>');
                                        echo('</tr>');
                                    }
                                    echo '<tr>';
                                    echo '<td colspan="2">Grand Total</td><td>' . $totboy . '</td><td>' . $totgirl . '</td></td><td>' . $gtot . '</td>';
                                    echo '</tr>';
                                    echo '</table>';
                                    // for staff
                                    break;
                            }//end of switch
                        } //end of post if
                        ?>
                        </div>
                        <?php include("includes/footer.php"); ?>
