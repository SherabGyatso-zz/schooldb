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
    
    /*$sch_heads = $sch_head->get_main_detail($_GET['id']);*/
    
    $schools = $sch->get_school_names();
    
    include('includes/header.php');
    ?>


<!-- STUDENT INFORMATION -->

<?php
    $student = new student($db);
    $students = $student->get_student($_GET['id']);
    
    //$schools = $sch->get_school_names();
   //$class = new school_class($db);
   // $classes = $class->get_class_list();
    
    //if (count($students)) {
    if (count($schools))
        ?>

<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
<h2 style="text-align: center;"> School Wise Students Enrolment </h2>
<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
<thead>
<tr>
<!--<td colspan="3">&nbsp;</td>-->
<th colspan="2"></th>
<th colspan="3" align="center">Tibetan</th>
<th colspan="3" align="center">Himalayan </th>
<th colspan="3" align="center">Indian </th>
<th colspan="3" align="center">Dayscholar </th>
<th colspan="3" align="center">Boarder</th>
<th colspan="3" align="center">Grand Total</th>
<!--<th>&nbsp;</th>-->

</tr>
</thead>
<tbody>
<tr>
<th>S.no</th>
<!--<th>Class</th>-->
<th>School</th>
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
    $htotb = 0;
    $htotg = 0;
    $htot = 0;
    $itotb = 0;
    $itotg = 0;
    $itot = 0;
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
    if(is_array($students) && count($students)) {
       foreach ($students as $row) {
    
    //if (is_array($schools) && count($schools)) {
        //foreach ($schools as $row)
        {
            $tibtotb += $row['tboy'];
            $tibtotg += $row['tgirl'];
            
            $htotb += $row['nboy'];
            $htotg += $row['ngirl'];
            $itotb += $row['hboy'];
            $itotg += $row['hgirl'];
            $daytotb += $row['dboy'];
            $daytotg += $row['dgirl'];
            $boartotb += $row['bboy'];
            $boartotg += $row['bgirl'];
            
            $tibtot = $tibtotb + $tibtotg;
            $tibtotr = $row['tboy'] + $row['tgirl'];
            $htot = $htotb + $htotg;
            $htotr = $row['nboy'] + $row['ngirl'];
            $itot = $itotb + $itotg;
            $itotr = $row['hboy'] + $row['hgirl'];
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
<td><?php echo $row['SchoolName']; ?></td>
<td><?php echo $row['tboy']; ?></td>
<td><?php echo $row['tgirl']; ?></td>
<td><?php echo $tibtotr; ?></td>
<td><?php echo $row['nboy']; ?></td>
<td><?php echo $row['ngirl']; ?></td>
<td><?php echo $htotr; ?></td>
<td><?php echo $row['hboy']; ?></td>
<td><?php echo $row['hgirl']; ?></td>
<td><?php echo $itotr; ?></td>
<td><?php echo $row['dboy']; ?></td>
<td><?php echo $row['dgirl']; ?></td>
<td><?php echo $daytotr; ?></td>
<td><?php echo $row['bboy']; ?></td>
<td><?php echo $row['bgirl']; ?></td>
<td><?php echo $boartotr; ?></td>
<td><?php echo $gtotb; ?></td>
<td><?php echo $gtotg; ?></td>

<td><?php echo $tot; ?></td>
</tr>

<?php
    ++$i;
    }
    ?>
<!--<tr>
<th colspan="2" align="center">Total</th>
<th align="center"><?php echo $tibtotb; ?></th>
<th align="center"><?php echo $tibtotg; ?></th>
<th align="center"><?php echo $tibtot; ?></th>
<th align="center"><?php echo $htotb; ?></th>
<th align="center"><?php echo $htotg; ?></th>
<th align="center"><?php echo $htot; ?></th>
<th align="center"><?php echo $itotb; ?></th>
<th align="center"><?php echo $itotg; ?></th>
<th align="center"><?php echo $itot; ?></th>
<th align="center"><?php echo $daytotb; ?></th>
<th align="center"><?php echo $daytotg; ?></th>
<th align="center"><?php echo $daytot; ?></th>
<th align="center"><?php echo $boartotb; ?></th>
<th align="center"><?php echo $boartotg; ?></th>
<th align="center"><?php echo $boartot; ?></th>
<th align="center"><?php echo $grtotb; ?></th>
<th align="center"><?php echo $grtotg; ?></th>

<th align="center"><?php echo $otot; ?></th>
</tr>-->
<?php }
    ?>
</tbody>
</table>
</div>
}

<?php } ?>



<?php include_once 'includes/footer.php'; ?>
