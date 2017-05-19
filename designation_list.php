<?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.designation.php';

$db = new database();
$designation = new designation($db);

$designations = $designation->get_designation();

include_once 'includes/header1.php';
?>

<div class="col-sm-8 col-sm-offset-1 col-md-8 col-md-offset-1">
<div><td><input type="button" value="Add New Designation" onclick="location='designation_add.php'" class="btn btn-primary" /> </div>
    <?php
       if(isset($_GET['msg']) && $_GET['msg'] != '') {
           echo '<h3 style="text-align:center; color:red;">'. $_GET['msg'] . '</h3>';
       }
    ?>
    <table  class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>		
            <tr>
                <th>S.no</th>
                <th>Designation</th>
                <th>Action</th>

            </tr>
        </thead>

        <tbody>
            <?php
            $i = 1;
            if (is_array($designations) && count($designations)) {
                foreach ($designations as $row) {
                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>                   
                        <td><?php echo $row['designation']; ?></td>
                        <td><a href="designation_edit.php?sid=<?php echo $row['ID']; ?>">Edit</a></td>
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