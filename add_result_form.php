<div class="col-sm-12 col-md-12">
    <form id="result_form" action="add_result_process.php" method="post">
        <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
            <thead>
                <tr>	
                    <th>Total Student</th>
                    <th>Student Appeared</th>
                    <th>Student Promoted </th>                   
                    <th>Student Retain</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" placeholder="0" name="Totstu" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0"  name="Stuappear" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0"  name="Stupromoted" value="0" size="5" /></td>
                    <td><input type="text" placeholder="0"  name="Sturetain" value="0" size="5" /></td>

                    <input type="hidden" value="<?php echo $_GET['id']; ?>" id="sid" name="schooltype" />
            
                    <td><input type ="submit" id="add_result" class="btn btn-info" value="Add" /></td>
                </tr>

            </tbody>
        </table>     
    </form>
</div>
