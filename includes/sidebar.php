
<table width="100%">
    <tr>
        <td valign="top" width="100">
            <div id="sidebar">
                <a href="search.php" >Search</a>
                <a href="latest.php" >Latest Data</a>
                <a href="school_wise_student.php">School_Wise_Student</a>
                <a href="school_wise_staff.php">School_Wsie_Staff</a>
                <a href="school_wise_class.php">School_Wise_Class</a>
                <a href="school_wise_result.php">School_Wise_Result</a>
                <a href="class_wise_student.php">Class_Wise_Student</a>
                <a href="overall_school_category.php">Summary Of Student</a>
                <a href="overall_school_category_staff.php">Summary Of Staff</a>
                <a href="school_categorywise_details.php">School_Category_Wise</a>

                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] != "") {
                    ?>
                    


                    <?php  } else { ?>
                        <a href="login.php" >Login</a>

                        <?php
                    }


                    ?>
                    

                </div>
                
            </td>
            <!--main container starts here -->
            <td>
