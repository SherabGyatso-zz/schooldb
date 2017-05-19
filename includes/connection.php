<?php
$auth='false'; //for security
$dbserver='localhost';
$db='school';
$dbuser='root';
$dbpass='123';

$con = mysqli_connect('localhost',$dbuser,$dbpass, $db);
if(mysqli_connect_errno()) {
    echo("No connection to the database server" . mysql_error());
}

if(!mysqli_select_db($con, $db))
   {
    echo("Database is not be selected". mysql_error());
    
}?>