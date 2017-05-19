<?php
    include('includes/header1.php');
    ?>
        
		<ul class="menu">
              
              
                <?php if(@$_SESSION['id']!=1) { ?>
                <li><a href="userviewpro.php">Products</a></li>
                <?php } ?>
                <?php if(@$_SESSION['usertype']=='a'){ ?>
                 	

                <?php } ?>
                
                
                <?php if(@$_SESSION['usertype']=='b'){ ?>
                   <!-- <div class="drop decor3_2" style="width: 240px;">-->
                    <div class="sidebar ">
                   
                                    
            <a href="index.php?action=list_school">School List</a>
                                 <a href="index.php?action=list_school_category">School Category List</a>
                                    <a href="index.php?action=list_class">Class List</a>
                                     <a href="index.php?action=list_designation">Designation List</a>
                                     <a href="search.php">Search</a>
                                    <a href="latest.php">Lates Data</a>
                                    <a href="index.php?action=main_entry">Data Entry</a>
                                    <a href="index.php?action=main_list">Data Edition</a>
                                </div> 
                      
            
               
                <?php } ?>
                
                
                <?php if(@$_SESSION['id']!=1) { ?>
                 <li><a href="contacts.php">Contact</a></li>
            	<li><a href="registrationx.php">Sign up</a></li>
            	<?php } ?>
                <li><a href="signup.php">New User</a></li>
            	  <li><?php echo @$toplink; ?></li>
                            </ul>

</nav>