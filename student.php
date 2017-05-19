<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <title>Search</title>
        <link href="include/prject.css" rel="stylesheet" />
    </head>
    <body>
        <?php
        include("includes/header.php");
        include("includes/common_function.php");

        include("includes/connection.php");
        ?>

        <div>
            <?php
            if (!ini_get('date.timezone')) {
                date_default_timezone_set('GMT');
            }
            $typeid = $_GET['idstu'];
            $date1 = $_GET['repdate'];
            $school = $_GET['schoolname'];







//listing of student information

            $lst = "SELECT studentstrength.detailid, staffhead.reportingperiod, class.class, studentstrength.typeid, studentstrength.tboy, studentstrength.tgirl, studentstrength.nboy, studentstrength.ngirl, studentstrength.hboy, studentstrength.hgirl, studentstrength.dboy, studentstrength.dgirl, studentstrength.bboy, studentstrength.bgirl FROM (class INNER JOIN (staffhead INNER JOIN studentstrength ON staffhead.schooltype = studentstrength.typeid) ON class.classid = studentstrength.class) where deadline='" . $date1 . "' and typeid =" . $typeid . " ORDER BY studentstrength.detailid DESC;";
//echo $lst;
            $lstres = mysqli_query($con, $lst);
            $stunum = mysqli_num_rows($lstres);
// echo $lst;
            if ($stunum > 1) {
                ?>
                <h3 style="color:#CC0000; text-align:center">Information of <?php echo $school; ?> as per report dated on <?php echo gmdate("F j, Y", strtotime($_GET['repdate'])); ?></h3>

                <h3 style="text-align: center; color:#1856A9;">Student information</h3>

                <table class="table table-bordered table-striped table-hover table-condensed table-responsive" style="width:70%;"align="center">
                    <thead>
                        <tr>


                               <th  rowspan="2" width="7%" style="vertical-align:middle; text-align:center">S.no</th>
                            <th  rowspan="2"  width="7%" style="vertical-align:middle; text-align:center">Class</th>
                            <th align="center" colspan="2" style="text-align:center">Tibetan</th>
                            <th colspan="2" style="text-align:center">Non Tibetan </th>
                            <th colspan="2" style="text-align:center">Himalayan</th>
                            <th colspan="2" style="text-align:center">Dayscholar</th>
                            <th colspan="2" style="text-align:center">Boarder</th>
                             <th rowspan="2" width="7%" style="vertical-align:middle; text-align:center">Total</th>
                     
                        </tr>

                    
                
                   
                        <tr>    

                            <th width="7%" align="center">Boys </th>
                            <th width="7%" align="center">Girls </th>
                            <th width="7%" align="center">Boys</th>
                            <th width="7%" align="center">Girls</th>
                            <th width="7%" align="center">Boys</th>
                            <th width="7%" align="center">Girls</th>
                            <th width="7%" align="center">Boys</th>
                            <th width="7%" align="center">Girls</th>
                            <th width="7%" align="center">Boys</th>
                            <th width="7%" align="center">Girls</th>
                           

                        </tr>
                        <?php
                        $i = 0;
                        $tibtotb = 0;
                        $tibtotg = 0;
                        $ntibtotb = 0;
                        $ntibtotg = 0;
                        $htotb = 0;
                        $htotg = 0;
                        $daytotb = 0;
                        $daytotg = 0;
                        $boartotb = 0;
                        $boartotg = 0;
                        $otot = 0;
                        while ($row = mysqli_fetch_array($lstres)) {
                            $tibtotb = $tibtotb + $row['tboy'];
                            $tibtotg = $tibtotg + $row['tgirl'];
                            $ntibtotb = $ntibtotb + $row['nboy'];
                            $ntibtotg = $ntibtotg + $row['ngirl'];
                            $htotb = $htotb + $row['hboy'];
                            $htotg = $htotg + $row['hgirl'];
                            $daytotb = $daytotb + $row['dboy'];
                            $daytotg = $daytotg + $row['dgirl'];
                            $boartotb = $boartotb + $row['bboy'];
                            $boartotg = $boartotg + $row['bgirl'];

                            $stib = $row['tboy'] + $row['tgirl'];
                            $sntib = $row['nboy'] + $row['ngirl'];
                            $sh = $row['hboy'] + $row['hgirl'];
                            $tot = $stib + $sntib + $sh;
                            $otot = $otot + $tot;
                            ++$i;
                            echo('<tr>');
                            echo('<td align ="center">' . $i . '</td>');
                            echo('<td align ="center">' . $row['class'] . '</td>');
                            echo('<td  align ="center">' . $row['tboy'] . '</td>');
                            echo('<td  align ="center">' . $row['tgirl'] . '</td>');
                            echo('<td  align ="center">' . $row['nboy'] . '</td>');
                            echo('<td  align ="center">' . $row['ngirl'] . '</td>');
                            echo('<td  align ="center">' . $row['hboy'] . '</td>');
                            echo('<td  align ="center">' . $row['hgirl'] . '</td>');
                            echo('<td  align ="center">' . $row['dboy'] . '</td>');
                            echo('<td  align ="center">' . $row['dgirl'] . '</td>');
                            echo('<td  align ="center">' . $row['bboy'] . '</td>');
                            echo('<td  align ="center">' . $row['bgirl'] . '</td>');
                            echo('<td  align ="center">' . $tot . '</td>');
                            // echo('<td  align ="center">'.$row['Username'].'</td>');

                            echo('</tr>');
                        }
                        ?>
                         <tr>
                            <th colspan="2" style="text-align:center">Grand Total</th>
                            <th style="text-align:center"><?php echo $tibtotb; ?></th>
                            <th style="text-align:center"><?php echo $tibtotg; ?></th>
                            <th style="text-align:center"><?php echo $ntibtotb; ?></th>
                            <th style="text-align:center"><?php echo $ntibtotg; ?></th>
                            <th style="text-align:center"><?php echo $htotb; ?></th>
                            <th style="text-align:center"><?php echo $htotg; ?></th>
                            <th style="text-align:center"><?php echo $daytotb; ?></th>
                            <th style="text-align:center"><?php echo $daytotg; ?></th>
                            <th style="text-align:center"><?php echo $boartotb; ?></th>
                            <th style="text-align:center"><?php echo $boartotg; ?></th>
                            <th style="text-align:center"><?php echo $otot; ?></th>
                        </tr>
                
                    </tbody>
                </table>
                <?php
            } else {
                $msg = "there is no student records";
                echo '<span class="validationmessage">' . $msg . '</span>';
            }
//listing of staff information
            $lst = "SELECT staffstrength.ID, staffstrength.designationid, designation.designation, staffhead.reportingperiod, staffstrength.schoolinfo, staffstrength.Female, staffstrength.Male FROM ((staffhead INNER JOIN staffstrength ON staffhead.schooltype = staffstrength.schoolinfo) INNER JOIN designation ON staffstrength.designationid = designation.ID) where deadline='" . $date1 . "' and schoolinfo =" . $typeid . " ORDER BY staffstrength.designationid ASC;";

            $lstres = mysqli_query($con, $lst);
            $stunum = mysqli_num_rows($lstres);
// echo $lst;

            if ($stunum > 1) {
                ?>
               
                <h3 style="text-align: center; color:#1856A9;">Staff Information</h3>

                <table class="table table-bordered table-striped table-hover table-condensed table-responsive" style="width:70%;"align="center">
                    <thead>

                        <tr>    
                            <th width="9%" style="text-align:center">S.no</th>
                            <th width="37%" >Designation</th>
                            <th width="13%" style="text-align:center">Male</th>
                            <th width="13%" style="text-align:center">Female</th>
                            <th width="12%" style="text-align:center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $totmale = 0;
                        $totfemale = 0;
                        $overall = 0;
                        while ($row = mysqli_fetch_array($lstres)) {
                            $totmale = $totmale + $row['Male'];
                            $totfemale = $totfemale + $row['Female'];
                            $sbor = $row['Male'] + $row['Female'];
                            $tot = $sbor;
                            $overall = $overall + $tot;
                            ++$i;
                            echo('<tr>');
                            echo('<td align ="center">' . $i . '</td>');
                            echo('<td align ="left">' . $row['designation'] . '</td>');
                            echo('<td  align ="center">' . $row['Male'] . '</td>');
                            echo('<td  align ="center">' . $row['Female'] . '</td>');
                            echo('<td  align ="center">' . $tot . '</td>');
                            // echo('<td  align ="center">'.$row['Username'].'</td>');
                            echo('</tr>');
                        }
                        ?>
                        <tr>
                            <th colspan="2" style="text-align:center"> Grand Total </th>
                            <th style="text-align:center"> <?php echo ($totmale / 2); ?> </th>
                            <th style="text-align:center"> <?php echo ($totfemale / 2); ?> </th>
                            <th style="text-align:center"> <?php echo ($overall / 2); ?> </th>
                        </tr>
                    </tbody>
                </table>
                <?php
            } else {
                $msg = "there is no staff records";
                echo '<span class="validationmessage">' . $msg . '</span>';
            }

//listing of result information
            $lst = "SELECT genresult.totstu, genresult.stupromoted, genresult.sturetain, staffhead.reportingperiod, genresult.stuappear, genresult.schooltype FROM (genresult INNER JOIN staffhead ON genresult.schooltype = staffhead.schooltype) where deadline='" . $date1 . "' and genresult.schooltype = " . $typeid . ";";
            $rptres = mysqli_query($con, $lst);
            $rptnum = mysqli_num_rows($lstres);
// echo $lst;

            if ($rptnum > 1) {
                ?>
               
                <h3 style="text-align: center; color:#1856A9;">Result</h3>

                <table class="table table-bordered table-striped table-hover table-condensed table-responsive" style="width:70%;"align="center">
                    <thead>
                        <tr>    <th width="9%" style="text-align:center">S.no</th>
                            <th width="9%" style="text-align:center">Total</th>
                            <th width="37%" style="text-align:center">Appeared</th>
                            <th width="13%" style="text-align:center">Promoted</th>
                            <th width="13%" style="text-align:center">Retain</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;

                        while ($row = mysqli_fetch_array($rptres)) {

                            ++$i;
                            echo('<tr>');
                            echo('<td align ="center">' . $i . '</td>');
                            echo('<td align ="center">' . $row['totstu'] . '</td>');
                            echo('<td  align ="center">' . $row['stuappear'] . '</td>');
                            echo('<td  align ="center">' . $row['stupromoted'] . '</td>');
                            echo('<td  align ="center">' . $row['sturetain'] . '</td>');
                            //echo('<td  align ="center">'.$row['Username'].'</td>');
                            echo('</tr>');
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                $msg = "there is no staff records";
                echo '<span class="validationmessage">' . $msg . '</span>';
            }
            ?>


        </div>
        <?php include("includes/footer.php"); ?>
