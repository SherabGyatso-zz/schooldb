<?php
session_start();
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.result.php';
require_once 'classes/class.staff.php';
require_once 'classes/class.student.php';

$db = new database();


$id = $_POST['delete_id'];
$tbl = $_POST['tbl'];

//for student table
if ($tbl == 'student') {
    $cond = 'detailid=' . $id;
    $stu_del = new student($db);
    if ($stu_del->delete_student($cond)) {
        $_SESSION['s_msg'] = "Record has been delete successfully";
    } else {
        $_SESSION['e_msg'] = "Error in deleting record";
    }
}


//for staff table
if ($tbl == 'staff') {
    $cond = 'ID=' . $id;
    $staff_del = new staff($db);
    if ($staff_del->delete_staff($cond)) {
        $_SESSION['s_msg'] = "Record has been delete successfully";
    } else {
        $_SESSION['e_msg'] = "Error in deleting record";
    }
}


//for result table
if ($tbl == 'genresult') {
    $cond = 'resultid=' . $id;
    $result_del = new result($db);
    if ($result_del->delete_result($cond)) {
        $_SESSION['s_msg'] = "Record has been delete successfully";
    } else {
        $_SESSION['e_msg'] = "Error in deleting record";
    }
}

//delete school

if($tbl == 'school') {
    
}

//delete class
if($tbl == 'class') {
    
}

//delete desingation 

if($tbl =='designation') {
    
}

//delete school category 
if($tbl =='school_cat') {
    
}
