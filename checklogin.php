<?php
session_start();
ob_start();
 

// Connect to server and select databse.
$link = mysqli_connect("localhost", "root", "123", "school")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");

// Define $myusername and $mypassword 
$myusername=$_POST['username']; 
$mypassword=md5($_POST['password']); 

// To protect MySQL injection (mor e detail about MySQL injection)
//$myusername = stripslashes($myusername);
//$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($link,$myusername);
$mypassword = mysqli_real_escape_string($link,$mypassword);
$sql="SELECT * FROM users WHERE name='$myusername' and password='$mypassword'";
$result=mysqli_query($link,$sql);
$fetched = mysqli_fetch_array($result,MYSQLI_NUM);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
/*session_register("myusername");
session_register("mypassword"); */
$_SESSION['myusername'] = $_POST['username'];
$_SESSION['mypassword'] = $_POST['password'];
$_SESSION['id'] = 1;
//$_SESSION['usertype'] = $fetched['acctype'];
header('location:school_list.php');
}else {
//echo "Wrong Username or Password";
header('Location:login.php?err=1');
die();
}
ob_end_flush();
?>