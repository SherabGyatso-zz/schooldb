<?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.school.php';
require_once 'classes/class.schoolcat.php';

$db = new database();
$school = new school($db);
$schoolcat = new schoolcat($db);

$schools = $school->get_school();
$school_cats = $schoolcat->get_school_cat_list();



include_once 'includes/header1.php';

?>


<div class="col-sm-8 col-sm-offset-1 col-md-8 col-md-offset-1">

<div>
    <td>
    <!-- <div style="float:left; color:#f00;"><?php if(isset($_SESSION['myusername'])) echo "Welcome ".$_SESSION['myusername']; ?></div>-->
        <input type="button" value="Add New School" onclick="location='school_add.php'" class="btn btn-primary" /> </div>
            <table id="schoollist" class="table table-bordered table-striped table-hover table-condensed table-responsive">

                <thead>

                    <tr>
                        <th>S.no</th>
                        <th>School Name</th>
                        <th>School Category</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                     <tbody>

                        <?php
                            $i = 1;
                                 if (is_array($schools) && count($school)) {
                                      foreach ($schools as $row) {
                        ?>

                                        <tr>
                                            <!--<td><?php echo $row['sortby']; ?></td>-->
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['SchoolName']; ?></td>
                                            <td><?php echo $school_cats[$row['SchoolCategoryId']]; ?> </td> 
                                            <td><?php echo $row['status']; ?></td>
                                            <td><a href="school_edit.php?sid=<?php echo $row['SchoolID']; ?>">Edit</a></td>


                                        </tr>
                                                <?php
                                            ++$i;
                    }
            }
            ?>

        </tbody>

    </table>

</div>


