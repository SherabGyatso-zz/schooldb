<?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.schoolcat.php';

$db = new database();
$schoolcat = new schoolcat($db);

$school_cats = $schoolcat->get_school();

include_once 'includes/header1.php';
?>

<div class="col-sm-8 col-sm-offset-1 col-md-8 col-md-offset-1">
<div>
<td><input type="button" value="Add School Category" onclick="location='school_category_add.php'" class="btn btn-primary" /> </div>
    <?php
       if(isset($_GET['msg']) && $_GET['msg'] != '') {
           echo '<h3 style="text-align:center; color:red;">'. $_GET['msg'] . '</h3>';
       }
    ?>
    <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>		
            <tr>
                <th>S.no</th>
                <th>School Category</th>
                <th>Full Form</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (is_array($school_cats) && count($school_cats)) {
                foreach ($school_cats as $row) {
                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['SchoolCategoryName']; ?></td>  
                        <td><?php echo $row['schoolcatname']; ?></td>
                        <td><a href="school_category_edit.php?sid=<?php echo $row['SchoolCategoryId']; ?>">Edit</a></td>
                   </tr>


        <?php
        ++$i;
    }
}
?>
        </tbody>            
    </table>
</div>

<?php include_once 'includes/footer.php'; ?>