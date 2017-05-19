<?php session_start();
                $toplink="";
				if(isset($_SESSION['id'])){
						$toplink = '<a href="logout.php">Logout</a>';
							}
				 else {
					    $toplink = '<a href="login.php">Login</a>';
						    }

					$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("school") or die(mysql_error());

$flag = 0;
$msg = "";

if(isset($_POST['usersubmit'])){
	$name=$_POST['hname'];
	$email = $_POST['hemailid'];
	$password = $_POST['hpassword'];
	$account = $_POST['acc'];
		if ($name==""  || $email==""  || $password=="" || $account=="" )
		{
		$flag = 0;
		$msg = "All fields must be entered!!!34";
	}
	else
	{
		$password =md5($password);
		$query="insert into users(email_id,password,name,acctype) 
		values('$email','$password','$name','$account')";
		try{
		$do=mysql_query($query);
		$flag = 1;
		if($do)
			$msg = "Registration Successful...";
		else
			$msg = "This email account already exist..";
		}catch(Exception $e)
		{
			
		}
		
		
	}
}

?>
					<?php
					include('includes/header1.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>School | Sherig</title>
	
	
	<style type="text/css">
			#loginboxspe td,th{
			padding: 10px;
			font-size: 14pt;
			line-height: 30px;
			color: #fff;
		}
		
		#loginboxspe input[type="text"], #loginboxspe input[type="password"]{
			padding: 5px;
			width: 350px;
			font-size: 16pt;
			color: #888;
			background: #EEE;
			border: solid 1px #000;
			border-radius: 10px;
		}
	
		
		#loginformspe{
			padding: 10px;
			padding-right: 20px;
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			background: #222;
			width: 500px;
			margin: 0 auto;
			margin-top: 100px;
			-webkit-box-shadow: #000 0px 0px 12px 3px;
		}
	</style>
	

</head>
<body id="page1">
	<!--==============================header=================================-->
  
    
<center><?php if($msg!=""){ echo '<span id="note">'. $msg. '</span>'; } ?></center>
<center>
<?php echo @$toplink; ?>	
<div class="formbox" style="border-right: solid 2px #000;">

<h3 style="font-size: 30pt; color: #000; margin-bottom: 10px;">USER LOGIN</h3>  
<form name="signup" method="POST" action="" id="loginformspe"> 
<table id="loginboxspe">
<tr>
<th> Name:</th>
 <td> <input type="text" name="hname" class="box" onblur="checkname();" placeholder="Enter only alphabets" pattern = "^[a-zA-Z ]{1,100}$" required ></td>
</tr>

<tr>
<th> E-mail ID:</th>
<td><input type="text" name="hemailid" class="box" onblur="checkemail();" required placeholder="Ex:-ashwani@gmail.com" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" /></td>
 <td><span class="error" id="hemail_error"></span></td>
 <!--<td><span class="error" id="emerr"><img src="images/callout.gif" width="9"><span id="hem_error"></span></span></td>
</tr>-->

<tr>
<th>Password </th>
<td><input type="password" name="hpassword" class="box"  required placeholder="Enter password"/></td>
</tr>
<tr>
 <th> Account Type:</th>
 <td> <input type="text" name="acc" class="box" onblur="checkacc();" required placeholder="Enter the Acoount Type" ></td>

</tr>



<tr>
<td></td>
<td> <input action="login.php" type="submit" name="usersubmit" class="btn btn-primary"  value="Register">
</td>
</tr>
</form>
</table>

</div>	


	

</center>


                  
                             