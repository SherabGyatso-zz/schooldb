1.	<?php   
2.	    include_once('dbFunction.php');  
3.	    if($_POST['welcome']){  
4.	        // remove all session variables  
5.	        session_unset();   
6.	  
7.	        // destroy the session   
8.	        session_destroy();  
9.	    }  
10.	    if(!($_SESSION)){  
11.	        header("Location:index.php");  
12.	    }  
13.	?>  
14.	<!DOCTYPE html>  
15.	 <html lang="en" class="no-js">  
16.	 <head>  
17.	        <meta charset="UTF-8" />  
18.	        <title>Login and Registration Form with HTML5 and CSS3</title>  
19.	        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
20.	        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />  
21.	        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />  
22.	        <meta name="author" content="Codrops" />  
23.	        <link rel="shortcut icon" href="../favicon.ico">   
24.	        <link rel="stylesheet" type="text/css" href="css/demo.css" />  
25.	        <link rel="stylesheet" type="text/css" href="css/style2.css" />  
26.	        <link rel="stylesheet" type="text/css" href="css/animate-custom.css" />  
27.	    </head>  
28.	    <body>  
29.	        <div class="container">  
30.	              
31.	              
32.	            <header>  
33.	                <h1>Welcome Form  </h1>  
34.	            </header>  
35.	            <section>               
36.	                <div id="container_demo" >  
37.	                     
38.	                    <a class="hiddenanchor" id="toregister"></a>  
39.	                    <a class="hiddenanchor" id="tologin"></a>  
40.	                    <div id="wrapper">  
41.	                        <div id="login" class="animate form">  
42.	                           <form name="login" method="post" action="">  
43.	                                <h1>Welcome </h1>   
44.	                                <p>   
45.	                                    <label for="emailid" class="uname"   > Your Name </label>  
46.	                                   <?=$_SESSION['username']?>  
47.	                  
48.	                                </p>  
49.	                                <p>   
50.	                                    <label for="email" class="youpasswd"  > Your Email </label>  
51.	                                    <?=$_SESSION['email']?>  
52.	                                </p>  
53.	                                   
54.	                                <p class="login button">   
55.	                                    <input type="submit" name="welcome" value="Logout" />   
56.	                                </p>  
57.	                                   
58.	                            </form>  
59.	                        </div>  
60.	  
61.	                          
62.	                    </div>  
63.	                </div>    
64.	            </section>  
65.	        </div>  
66.	    </body>  
67.	</html>  
