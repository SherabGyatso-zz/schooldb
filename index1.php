<?php session_start();
                $toplink="";
				if(isset($_SESSION['id'])){
						$toplink = '<a href="login.php">Logout</a>';
							}
				 else {
					    $toplink = '<a href="login.php">Login</a>';
						    }
											
					?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style1.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen"> 
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
    <script src="js/jquery.galleriffic.js" type="text/javascript"></script>
    <script src="js/jquery.opacityrollover.js" type="text/javascript"></script>      
	<style type="text/css">
		#messagebox{
			padding: 10px;
			margin-top: 40px;
		}
		
		#messagebox a{
			float: right;
			text-decoration: none;
			color: blue;
		}
		
		#messagebox h2{
			font-size: 18pt;''
			padding: 10px;
			background: #000;
			color: #fff;
		}
		
		.message{
			display: block;
			padding: 5px;
			margin-top: 10px;
			border-top: solid 1px #ccc;
			border-bottom: solid 1px #ccc;
			font-size: 12pt;
			
		}
	</style>
</head>
<body id="page1">
	<!--==============================header=================================-->
    <header>
    <div class="row-2">
        	
                	
                   
              
            </div>
    	
                	<div class="grid_12">
                    	

                       
                   </div>
                    </div>

            </div>

        </div>
        
        </div>    	
    </header>
    
<!-- content -->
   
    
	<!--==============================footer=================================-->
  
    
</body>
</html>
