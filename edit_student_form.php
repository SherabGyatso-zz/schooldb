<?php
//session_start();
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.student.php';
require_once 'classes/class.class.php';

$db = new database();
$rec = new student($db);

$class = new school_class($db);

if (isset($_GET['studentid']) && $_GET['studentid'] != '') {
    $studid = $_GET['studentid'];
} else {
    $studid = $_POST['detailid'];
}
if (isset($_GET['mainid']) && $_GET['mainid'] != '') {
    $mainid = $_GET['mainid'];
} elseif (isset($_POST['typeid']) && $_POST['typeid'] != '') {
    $mainid = $_POST['typeid'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['savebt']) && $_POST['savebt'] == 'Edit') {
          
      if($_POST['tot1'] == $_POST['tot2']) { 

            $_data = array(
                'class' => trim($_POST['class']),
                'typeid' => trim($mainid),
                'tboy' => trim($_POST['tboy']),
                'tgirl' => trim($_POST['tgirl']),
                'nboy' => trim($_POST['nboy']),
                'ngirl' => trim($_POST['ngirl']),
                'hboy' => trim($_POST['hboy']),
                'hgirl' => trim($_POST['hgirl']),
                'bboy' => trim($_POST['bboy']),
                'bgirl' => trim($_POST['bgirl']),
                'dboy' => trim($_POST['dboy']),
                'dgirl' => trim($_POST['dgirl'])
                
            );

            if ($rec->update_student($_data, "detailid='{$studid}'")) {
                $s_msg = "Record has been edit successfully";
            } else {
                $e_msg = "Record is not updated";
            }
      } else {
          $e_msg = "Sum of both side is not same";
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

    $res = $rec->get_student($studid, 'edit');

    $tot1 = $res[0]['tboy'] + $res[0]['tgirl'] + $res[0]['nboy'] + $res[0]['ngirl'] + $res[0]['hboy'] + $res[0]['hgirl'];
    $tot2 = $res[0]['bboy'] + $res[0]['bgirl'] + $res[0]['dboy'] + $res[0]['dgirl'];
    ?>

    <div class="col-sm-12 col-md-12">
        <h3 style="text-align: center;"><i class="icon-large icon-ok-sign"></i><span id="msg"></span></h3>
        <form id="stu_form11" action="edit_student_form.php" method="post">
            <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
                <thead>
                    <tr>    
                        <th>Class</th>
                        <th>Tib Boys </th>
                        <th>Tib Girls </th>
                        <th>Non Tib Boys</th>
                        <th>Non Tib Girls</th>
                        <th>Himalayan Boys</th>
                        <th>Himalayan Girls</th>
                        <th>Total</th>
                        <th>BBoys</th>
                        <th>BGirls</th>
                        <th>Days Boys</th>
                        <th>Days Girls</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>                 
                            <select name="class">
                                <option value="all">Select Class</option>
                                <?php
                                $s_classes = $class->get_class();
                                //echo count($s_classes)."test";
                                if (is_array($s_classes) && count($s_classes)) {
                                    foreach ($s_classes as $s_class) {
                                        if ($s_class['classid'] == $res[0]['class']) {
                                            echo "<option selected='selected' value='{$s_class['classid']}'>{$s_class['class']}</option>";
                                        } else {
                                            echo "<option value='{$s_class['classid']}'>{$s_class['class']}</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>

                        </td>
                        <td><input type="text"  id="tboy" name="tboy" value="<?php echo $res[0]['tboy']; ?>" size="3" /></td>
                        <td><input type="text" id="tgirl" name="tgirl" value="<?php echo $res[0]['tgirl']; ?>" size="3" /></td>
                        <td><input type="text" id="nboy" name="nboy" value="<?php echo $res[0]['nboy']; ?>" size="3" /></td>
                        <td><input type="text"  name="ngirl" value="<?php echo $res[0]['ngirl']; ?>" size="3" /></td>
                        <td><input type="text" name="hboy" value="<?php echo $res[0]['hboy']; ?>" size="3" /></td>
                        <td><input type="text" name="hgirl" value="<?php echo $res[0]['hgirl']; ?>" size="3" /></td>
                        <td><input class="success" type="text" name="tot1" id="tot1" value="<?php echo $tot1; ?>" size="3" readonly="readonly"/></td>
                        <td><input type="text" name="bboy" value="<?php echo $res[0]['bboy']; ?>" size="3" /></td>
                        <td><input type="text"  name="bgirl" value="<?php echo $res[0]['bgirl']; ?>" size="3" /></td>
                        <td><input type="text" name="dboy" value="<?php echo $res[0]['dboy']; ?>" size="3" /></td>
                        <td><input type="text" name="dgirl" value="<?php echo $res[0]['dgirl']; ?>" size="3" />
                            <input type="hidden" value="<?php echo $mainid; ?>" id="sid" name="typeid" />
                            <input type="hidden" value="<?php echo $studid; ?>" name="detailid" /></td>
                        <td><input class="success" type="text" name="tot2" id="tot2" value="<?php echo $tot2; ?>" size="3" readonly="readonly" /></td>
                        <td colspan="2"><input disabled type ="submit" id="add_stu" name ="savebt" class="btn btn-info" value="Edit" />&nbsp;&nbsp;
                            <input type="submit" value="Close" name="closebt" class="btn btn-primary" /></td>
                    </tr>

                </tbody>
            </table>     
        </form>
    </div>

