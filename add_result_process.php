<?php

require_once 'includes/config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.result.php';
require_once 'classes/class.utility.php';

$db = new database();
$result = new result($db);

//$_j = json_decode($_POST['_data']);
//print_r($_j);echo "Test";
//parse_str($_POST['_data'], $_data);
$params = array();

//convert json data in array
parse_str($_POST['_data'], $params);
//print_r($params);

if (isset($_POST)) {
    $data = array();
    $id = $params['schooltype'];
  
        if ($result->add_result($params)) {
            $data['success'] = true;
            $data['value'] = $id;
            $data['msg'] = "Add Successfully";
        } else {
            $data['success'] = false;
            $data['value'] = $id;
            $data['msg'] = "Error";
        }
    
    echo json_encode($data);
}