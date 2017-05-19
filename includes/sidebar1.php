<?php 
                $toplink="";
                if(isset($_SESSION['id'])){
                        $toplink = '<a href="index.php">Logout</a>';
                            }
                 else {
                        $toplink = '<a href="login.php">Login</a>';
                            }
                                            
                    ?>
<table width="100%">
    <tr>
        <td valign="top" width="100">
            <div id="sidebar">
                <a href="index.php?action=list_school" >List School</a>
                <a href="index.php?action=list_school_category">List School Category</a>
                <a href="index.php?action=list_class">List Class</a>
                <a href="index.php?action=list_designation">List Designation</a>
               


                <a href="index.php?action=main_entry">New Data Entry</a>
                <a href="main_list.php">List_Data_for_Edition</a>
              
               
              <?php echo @$toplink; ?>

            </div>

<div class="col-sm-2 col-md-2 sidebar">
    
</div>

            
        </td>
        <!--main container starts here -->
        <td>


