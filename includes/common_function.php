<?php

//$url = 'http://' . $_SERVER['SERVER_NAME'];
function save_session() {
    $_SESSION['schoolid'] = $_POST['school'];
    $_SESSION['daterep'] = $_POST['daterep'];
    $_SESSION['repoff'] = $_POST['repoff'];
    $_SESSION['repplace'] = $_POST['repplace'];
}

function unsetState($key) {
    unset($_SESSION[$key]);
}

function getStateAndUnset($key, $array) {
    $value = "";
    if (isset($_SESSION[$key])) {
        $value = $_SESSION[$key];
        unset($_SESSION[$key]);
    } else {
        if (isset($array[$key])) {
            $value = $array[$key];
        }
    }
    return $value;
}

function getStateAndUnset1($key, $array) {
    $value = "0";
    if (isset($_SESSION[$key])) {
        $value = $_SESSION[$key];
        unset($_SESSION[$key]);
    } else {
        if (isset($array[$key])) {
            $value = $array[$key];
        }
    }
    return $value;
}

function where_cond($post) {
    $wh = "(school.status='A')";
    if ($_POST['ReportingDt'] == 1)
        $wh = "deadline ='" . $_POST['year'] . "'";
    if ($post['school'] != 'all') {
        $school = "staffhead.schoolid='" . $_POST['school'] . "'";
        if ($wh != "")
            $wh = $wh . " and " . $school;
        else
            $wh.=$school;
    }elseif ($post['schoolcat'] != 'all') {
        $school_cat = "school.SchoolCategoryId=" . $_POST['schoolcat'];
        if ($wh != "")
            $wh = $wh . " and " . $school_cat;
        else
            $wh = $school_cat;
    }
    if ($post['Group'] == 3 and $post['searchopt'] == 'teaching') {
        $teach = "staffstrength.designationid<>18 AND staffstrength.designationid<>19 "
                . "AND staffstrength.designationid<>20 AND staffstrength.designationid<>3";
        $wh = $wh . " and " . $teach;
    }
    if ($wh != "")
        $wh = " where " . $wh;
    return $wh;
}

function get_school_name($schoolid) {
    $dbserver='localhost';
$db='school';
$dbuser='root';
$dbpass='root';
    $con = mysqli_connect($dbserver, $dbuser, $dbpass, $db);
    if (mysqli_connect_errno()) {
        echo("No connection to the database server" . mysql_error());
        exit();
    }

    if (!mysqli_select_db($con, $db)) {
        echo("Database is not be selected" . mysql_error());
        exit();
    }
    $sql = "select SchoolName from school where SchoolID='" . $schoolid . "'";
   // echo $sql;
    $rs = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($rs);
    $schoolname = $row['SchoolName'];

    return $schoolname;
}

?>