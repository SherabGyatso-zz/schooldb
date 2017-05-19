<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>ཤེས་རིག་ལས་ཁུངས་ | DOE</title>
        <!-- for printing report -->
        <link rel="shortcut icon" type="image/x-icon" href="/schooldb/images/logo.jpeg" />
          <link href="css/side.css" rel="stylesheet" />
           <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet" />

         <!-- Custom styles for this template -->
        <link href="css/custom.css" rel="stylesheet" />
          <link href="css/datepicker.css" rel="stylesheet" />
     
       
        
        <link rel="stylesheet" media="print" href="css/print.css">
        <!-- data table styles for this template -->
        <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" />
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>


    </head>
  <script>
        $(document).ready(function () {

            //sortable table for search result page
            $('#schoollist').dataTable({
                "iDisplayLength": 100
            });

            // date picker for main entry
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy"
            });

            //by default add button is disable
            $('#add_stu').attr("disabled", true);

            //adding student records 
            $('#stu_form').submit(function (e) {
                e.preventDefault();

                var _ser = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'add_stu_process.php',
                    data: {'_data': _ser},
                    // dataType: 'Json', //return data type is Json and J should be capital
                    success: function (data) {
                        // alert("testing");
                        console.log(data);
                        var _j = jQuery.parseJSON(data);
                        if (_j.success) {
                            $('#msg').html(_j.msg);
                            $('#msg').css('color', 'green');
                            // alert(_j.msg);
                            window.location.href = "main_info.php?id=" + _j.value;
                        } else {
                            $('#msg').html(_j.msg);
                            $('#msg').css('color', 'red');

                        }
                    }
                });
            });

            //validating sum of both side is same or not
            function total() {
                var tboy = parseInt($('#tboy').val());
                var tgirl = parseInt($('#tgirl').val());
                var ntboy = parseInt($('#nboy').val());
                var ntgirl = parseInt($('input[name=ngirl]').val());
                var himboy = parseInt($('input[name=hboy]').val());
                var himgirl = parseInt($('input[name=hgirl]').val());

                var t1 = $("#tot1").val(tboy + tgirl + ntboy + ntgirl + himboy + himgirl);

                var bboy = parseInt($('input[name=bboy]').val());
                var bgirl = parseInt($('input[name=bgirl]').val());
                var dboy = parseInt($('input[name=dboy]').val());
                var dgirl = parseInt($('input[name=dgirl]').val());

                var t2 = $("#tot2").val(bboy + bgirl + dboy + dgirl);
                console.log(t1.val());
                if ((t1.val() === t2.val()) && (t1.val() != 0 && t2.val() != 0)) {
                    $('#tot1').removeClass('error');
                    $('#tot2').removeClass('error');
                    $('#tot1').addClass("success");
                    $('#tot2').addClass("success");
                    $('#add_stu').attr("disabled", false);
                } else {
                    $('#tot1').removeClass('success');
                    $('#tot2').removeClass('success');
                    $('#tot1').addClass("error");
                    $('#tot2').addClass("error");
                    $('#add_stu').attr("disabled", true);
                }

            }

            $(document).on("change, keyup", "#tgirl", total);
            $(document).on("change, keyup", "#tboy", total);
            $(document).on("change, keyup", "#nboy", total);
            $(document).on("change, keyup", "input[name=ngirl]", total);
            $(document).on("change, keyup", "input[name=hboy]", total);
            $(document).on("change, keyup", "input[name=hgirl]", total);

            $(document).on("change, keyup", "input[name=bboy]", total);
            $(document).on("change, keyup", "input[name=bgirl]", total);
            $(document).on("change, keyup", "input[name=dboy]", total);
            $(document).on("change, keyup", "input[name=dgirl]", total);


            //to add staff record

            //by default add button is disable
            //$('#add_staff').attr("disabled", true);

            //adding staff records 
            $('#staff_form').submit(function (e) {
                e.preventDefault();
                
                var male = parseInt($('input[name=male]').val());
                var female = parseInt($('input[name=female]').val());

                if (male === 0 && female === 0) {
                    alert("Both male and female is zero value");
                    $('#msg').html("Both male and female is zero value");
                    e.preventDefault();
                } else {
                    var _ser_staff = $(this).serialize();

                    $.ajax({
                        type: 'POST',
                        url: 'add_staff_process.php',
                        data: {'_data': _ser_staff},
                        // dataType: 'Json', //return data type is Json and J should be capital
                        success: function (data) {
                            // alert("testing");
                            console.log(data);
                            var _j = jQuery.parseJSON(data);
                            if (_j.success) {
                                $('#msg').html(_j.msg);
                                $('#msg').css('color', 'green');
                                // alert(_j.msg);
                                window.location.href = "main_info.php?id=" + _j.value;
                            } else {
                                $('#msg').html(_j.msg);
                                $('#msg').css('color', 'red');

                            }
                        }
                    });
                }
            });

                        //adding staff records 
            $('#result_form').submit(function (e) {
                e.preventDefault();
                
                var total = parseInt($('input[name=Totstu]').val());
                var appeared = parseInt($('input[name=Stuappear]').val());
                var promoted = parseInt($('input[name=Stupromoted]').val());
                var retain = parseInt($('input[name=Sturetain]').val());

                if (total === 0 && appeared === 0 && promoted === 0) {
                    alert("Value should not be zero value");
                    $('#msg').html("Value should not be zero value");
                    e.preventDefault();
                } else {
                    var _ser_staff = $(this).serialize();

                    $.ajax({
                        type: 'POST',
                        url: 'add_result_process.php',
                        data: {'_data': _ser_staff},
                        // dataType: 'Json', //return data type is Json and J should be capital
                        success: function (data) {
                            // alert("testing");
                            console.log(data);
                            var _j = jQuery.parseJSON(data);
                            if (_j.success) {
                                $('#msg').html(_j.msg);
                                $('#msg').css('color', 'green');
                                // alert(_j.msg);
                                window.location.href = "main_info.php?id=" + _j.value;
                            } else {
                                $('#msg').html(_j.msg);
                                $('#msg').css('color', 'red');

                            }
                        }
                    });
                }

        }); //end of document ready

//delete records
           
            $(".del").click(function () {
                if (!confirm("Are you sure you want to delete")) {
                    return false;
                }else {
                    var del_id = $(this).attr('id'); // id of genresult table
                    var main_id = $(this).attr('data-id'); // id of staffhead id
                    var tbl = $(this).attr('data-table');  // table to delete
                    $.ajax({
                        type:'POST',
                        url:'delete_records.php',
                        data:'delete_id='+del_id+'&main_id='+main_id+'&tbl='+tbl,
                        success:function(data) {
                          if(data) {   // DO SOMETHING
                             // alert("success");
                              console.log(data);
                              
                              window.location.href = "main_info.php?id="+main_id;
                              
                            } else {
                               // alert("error");
                                console.log(data);                       
                                window.location.href = "main_info.php?id="+main_id;
                            }
                        }
                     }); // ajax end
  
                    }  //end of else
                });  // del click end
                
   }); //end of document ready

    </script>

    
 <div class="row header">
            <div class="col-md-3 logo">
                <img src="/schooldb/images/logo.png" alt="Logo" height ="100"/>
            </div>
            
            <div class="col-md-8 title">
                <h1 style="color:#fff;">SCHOOL DATABASE MANAGEMENT SYSTEM</h1>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
            
                <?php include_once 'sidebar1.php'; ?>
               
    
   
                   