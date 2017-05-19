<?php 
         $toplink="";
				if(isset($_SESSION['id'])){
						$toplink = '<a href="logout.php">Logout</a>';
							}
				 else {
					    $toplink = '<a href="login.php">Login</a>';
						    }
											
					?>

<!DOCTYPE html>
<html lang="en">
<head>
     <title>School | Sherig</title>
     <link rel="shortcut icon" type="image/x-icon" href="/schooldb/images/logo.jpeg" />
    <meta charset="utf-8">
   
     <link href="css/bootstrap.css" rel="stylesheet" />
     <link href="css/custom.css" rel="stylesheet" /> 
  
	
	<style type="text/css">
	
		#loginboxspe td{
			padding: 10px;
			font-size: 16pt;
			line-height: 30px;
			color: #fff;
		}
		
		#loginboxspe input[type="text"], #loginboxspe input[type="password"]{
			padding: 5px;
			width: 250px;
			font-size: 16pt;
			color: #888;
			background: #EEE;
			border: solid 1px #fff;
			border-radius: 10px;
		}
	
		
		#loginformspe{
			padding: 10px;
			padding-right: 20px;
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			background: #222;
			width: 400px;
			margin: 0 auto;
			margin-top: 100px;
			-webkit-box-shadow: #000 0px 0px 12px 3px;
		}
		.table{
			background-size:5% 5%;
		}

	</style>
</head>
<div class="row header">
            <div class="col-md-3 logo">
                <a href="search.php" onclick=""> <img src="/schooldb/images/logo.png" alt="Logo" height ="100"/></a>
            </div>
            
            <div class="col-md-8 title">
                <h1 style="color:#fff;">SCHOOL DATABASE MANAGEMENT SYSTEM</h1>
            </div>
        </div>

<body>    
<!-- content -->
 <table  class="table table-bordered table-striped table-hover table-condensed table-responsive"   background="/schooldb/images/logo.png" alt="Logo">
        <thead>		
            <tr>
            <td>
<form method="POST" action="checklogin.php" id="loginformspe">

<table id="loginboxspe">
<tr>
<td>Username</td>

<td><input type="text" required placeholder="Enter User Name" name="username"></td>
</tr>

<tr>
<td>Password</td>

<td><input type="password" required placeholder="Enter login password" name="password">
<br>
<?php 
if(isset($_GET['err']) && @$_GET['err']==1)
{
	echo "<span style='font-size:12pt;color:red'>Wrong Username or password</span>";
}
?>
</td>
</tr>     
<tr>
<td></td>
   <td><input type="submit" value="Login" class="btn btn-primary" action="" style="margin-top:10px;">
   
   <input type="reset" value="Reset" class="btn btn-primary" action="" style="margin-top:10px;"></td>

</tr>
 </table>

 </form> 
 </br>
 </br>
  </br>
 </br>
 </td> 
 </tr>
 </table>
</body>
</html>
 <?php include("includes/footer.php"); ?>

 





