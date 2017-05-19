<?php
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.result.php';

$db = new database();
$rec = new result($db);

if (isset($_GET['resultID']) && $_GET['resultID'] != '') {
    $resultID = $_GET['resultID'];
} else {
    $resultID = $_POST['resultID'];
}
if (isset($_GET['mainid']) && $_GET['mainid'] != '') {
    $mainid = $_GET['mainid'];
} elseif (isset($_POST['schooltype']) && $_POST['schooltype'] != '') {
    $mainid = $_POST['schooltype'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['savebt']) && $_POST['savebt'] == 'Edit') {
 
            $_data = array(
                'schooltype' => trim($mainid),
                'totstu' => trim($_POST['Totstu']),
                'stuappear' => trim($_POST['Stuappear']),
                'stupromoted' => trim($_POST['Stupromoted']),
                'sturetain' => trim($_POST['Sturetain'])                
            );

            if ($rec->update_result($_data, "resultid='{$resultID}'")) {
                $s_msg = "Record has been edit successfully";
            } else {
                $e_msg = "Record is not updated";
            }
 
    } elseif (isset($_POST['closebt']) && $_POST['closebt'] == 'Close') {
        header("Location:index.php?action=detail_entry&id=$mainid");
    }
}

include('includes/header1.php');

if (isset($s_msg)) {
    $_SESSION['s_msg'] = $s_msg;
}

if (isset($e_msg)) {
    $_SESSION['e_msg'] = $e_msg;
}
?>

<div class="col-sm-12 col-md-12">

    <?php
    if (isset($_SESSION['s_msg']) && $_SESSION['s_msg'] != '') {
        $s_msg = $_SESSION['s_msg'];
        unset($_SESSION['s_msg']);
        echo '<h3 style="text-align: center; color:green;"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;' . $s_msg . '</h3>';
    } elseif (isset($_SESSION['e_msg']) && $_SESSION['e_msg'] != '') {
        $e_msg = $_SESSION['e_msg'];
        unset($_SESSION['e_msg']);
        echo '<h3 style="text-align: center; color:red;"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;' . $e_msg . '</h3>';
    }

    $res = $rec->get_result($resultID, 'edit');
    ?>

    <div class="col-sm-12 col-md-12">
    <h3 style="text-align: center;"><i class="icon-large icon-ok-sign"></i><span id="msg"></span></h3>
      <form action="edit_result_form.php" method="post">
        <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
            <thead>
                <tr>    
                    <th>Total Student</th>
                    <th>Student Appeared</th>
                    <th>Student Promoted</th>                   
                    <th>Student Retain</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                <td><input type="text" name="Totstu" value="<?php echo $res[0]['totstu']; ?>" size="5" /></td>
                <td><input type="text" name="Stuappear" value="<?php echo $res[0]['stuappear']; ?>" size="5" /></td>
                <td><input type="text" name="Stupromoted" value="<?php echo $res[0]['stupromoted']; ?>" size="5" /></td>
                 <td><input type="text" name="Sturetain" value="<?php echo $res[0]['sturetain']; ?>" size="5" /></td>  
                    <input type="hidden" value="<?php echo $res[0]['schooltype']; ?>" id="sid" name="schooltype" />
                      <input type="hidden" value="<?php echo $res[0]['resultid']; ?>" id="sid" name="resultID" />
                
                    <td colspan="2">
                        <input type ="submit" name ="savebt" class="btn btn-info" value="Edit" />&nbsp;&nbsp;
                        <input type="submit" value="Close" name="closebt" class="btn btn-primary" /></td>
                </tr>

            </tbody>
        </table>     
    </form>
</div>

