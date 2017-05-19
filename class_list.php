<?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.class.php';

$db = new database();

$cl = new school_class($db);

$cls = $cl->get_class();

include('includes/header1.php');

?>
<div class="col-sm-8 col-sm-offset-1 col-md-8 col-md-offset-1">
    <?php
       if(isset($_GET['msg']) && $_GET['msg'] != '') {
           echo '<h3 style="text-align:center; color:red;">'. $_GET['msg'] . '</h3>';
       }
    ?>
    <table id="schoollist" class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>		
            <tr>
                <th>S.no</th>
                <th>Class</th>
                <th>Class in Numeric</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (is_array($cls) && count($cls)) {
                foreach ($cls as $row) {
                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['class']; ?></td>  
                        <td><?php echo $row['ClassNum']; ?></td>
                        <td><a href="class_edit.php?sid=<?php echo $row['classid']; ?>">Edit</a></td>
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

