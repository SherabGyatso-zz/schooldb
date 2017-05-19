<?php
session_start();
require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.student.php';
require_once 'classes/class.class.php';
require_once 'classes/class.utility.php';

$db = new database();
$student = new student($db);

//$_j = json_decode($_POST['_data']);
//print_r($_j);echo "Test";
//parse_str($_POST['_data'], $_data);
//$params = array();

//convert json data in array
parse_str($_POST['_data'], $params);
//print_r($params);

if (isset($_POST)) {
    $data = array();
    $id = $params['typeid'];
    if ($params['class'] != 'all') {
        if ($student->add_student($params)) {
            $data['success'] = true;
            $data['value'] = $id;
            $data['msg'] = "Add Successfully";
        } else {
            $data['success'] = false;
            $data['value'] = $id;
            $data['msg'] = "Error";
        }
    } else {
        $data['success'] = false;
        $data['value'] = $id;
        $data['msg'] = "Select the Class";
    }
    echo json_encode($data);
}


