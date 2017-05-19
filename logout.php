<?php 
session_start();

$con = mysql_connect("localhost","root","root");
$db = mysql_select_db("school");
$username=$_SESSION['emailid'];
session_unset();
session_destroy();
?>
<?php 
echo "You have Successfully Logout";
?>


