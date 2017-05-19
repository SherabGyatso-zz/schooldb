<?php
/* entry for student, staff and result record */

require_once 'includes/config.php';
require_once 'classes/class.main.php';
require_once 'classes/class.db.php';
require_once 'classes/class.school.php';
require_once 'classes/class.class.php';
require_once 'classes/class.main.php';
require_once 'classes/class.student.php';




$db = new database();
$school = new school($db);
$sch = new school($db);


include('includes/header.php');
?>
    
    <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>


            <tr><h2 style="color:#00f"  align="center"> Central Tibetan Schools Administration(CTSA)</h2></tr>
            </thead>
            <tbody>
                <tr>
                <th colspan="30" >Number Of Students</th>
                </tr>
                <tr>
                <th rowspan="2" >S.no</th>
                <th colspan="3" rowspan="2" align="center">School Name</th>
                <th colspan="3" align="center">Tibetan</th>
                <th colspan="3" align="center">Indian </th>
                <th colspan="3" align="center">Himalayan </th>
                <th colspan="3" align="center">Dayscholar </th>
                <th colspan="3" align="center">Boarder</th>
                <th colspan="3" align="center">Grand Total</th>
                <!--<th rowspan="2" width="9%">Dead Line</th>-->

            </tr>
            <tr>   

                <th>Boys </th>
                <th>Girls </th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total</th>
                <th>Boys</th>
                <th>Girls</th>
                <th style="color: #f00;">Total</th>

            </tr>
        
            </thead>

          

                <?php


                $h_latest_data_student = $school->get_schoolcategory_2();
                $schools = $sch->get_school_list();
                $i = 1;  $tboy = 0;
                     $totboy = 0; $totgirl = 0; $totaltib = 0; $tothboy = 0; $tothgirl = 0; $totalhim = 0; $totiboy = 0;
                     $totigirl = 0; $totindian = 0; $totdboy = 0; $totdgirl = 0; $totday = 0; $totbboy = 0;
                     $totbgirl = 0; $totboard = 0; $totalboy = 0; $totalgirl = 0; $grandtot = 0;$tgirl = 0; $tottib = 0;    $hboy = 0;  $hgirl = 0; $tothim = 0; $iboy = 0;$igirl = 0; $totind = 0; $dboy = 0; $dgirl = 0;
                     $totd = 0; $bboy = 0; $bgirl = 0; $totb = 0; $totby = 0; $totgl = 0;  $gtot = 0;
                 /*<?php
                        foreach ($h_latest_data_staff as $row) {
                            ?>*/
                            if (is_array($h_latest_data_student) && count($h_latest_data_student)) {
                                foreach ($h_latest_data_student as $row) {
                    
                     $tboy = $row['tibetanboys'];
                     $tgirl = $row['tibetangirls'];
                     $tottib = $row['total1'];
                     $hboy = $row['himalayanboys'];
                     $hgirl = $row['himalayangirls'];
                     $tothim = $row['total2'];
                     $iboy = $row['Indianboys'];
                     $igirl = $row['Indiangirls'];
                     $totind = $row['total3'];
                     $dboy = $row['Dayboys'];
                     $dgirl = $row['Daygirls'];
                     $totd = $row['total4'];
                     $bboy = $row['boardingboys'];
                     $bgirl = $row['boardinggirls'];
                     $totb = $row['total5'];
                     $totby = $row['TotalBoy'];
                     $totgl = $row['TotalGirl'];
                     $gtot = $row['Grand Total'];


                     $totboy += $tboy;
                     $totgirl += $tgirl;
                     $totaltib += $tottib;
                     $tothboy += $hboy;
                     $tothgirl += $hgirl;
                     $totalhim += $tothim;
                     $totiboy += $iboy;
                     $totigirl += $igirl;
                     $totindian += $totind;
                     $totdboy += $dboy;
                     $totdgirl += $dgirl;
                     $totday += $totd;
                     $totbboy += $bboy;
                     $totbgirl += $bgirl;
                     $totboard += $totb;
                     $totalboy += $totby;
                     $totalgirl += $totgl;
                     $grandtot += $gtot;


                                    ?> 


                                    
                    <tr>

                        <td><?php echo $i; ?></td>

                        <td colspan="3"><?php echo $row['SchoolName']; ?></td>
                        <td><?php echo $row['tibetanboys']; ?></td>
                        <td><?php echo $row['tibetangirls']; ?></td>
                        <td><?php echo $row['total1']; ?></td>
                        <td><?php echo $row['himalayanboys']; ?></td>
                        <td><?php echo $row['himalayangirls']; ?></td>
                        <td><?php echo $row['total2']; ?></td>
                        <td><?php echo $row['Indianboys']; ?></td>
                        <td><?php echo $row['Indiangirls']; ?></td>
                        <td><?php echo $row['total3']; ?></td>
                        <td><?php echo $row['Dayboys']; ?></td>
                        <td><?php echo $row['Daygirls']; ?></td>
                        <td><?php echo $row['total4']; ?></td>
                        <td><?php echo $row['boardingboys']; ?></td>
                        <td><?php echo $row['boardinggirls']; ?></td>
                        <td><?php echo $row['total5']; ?></td>
                        <td><?php echo $row['TotalBoy']; ?></td>
                        <td><?php echo $row['TotalGirl']; ?></td>
                        <td style="color: #f00;"><?php echo $row['Grand Total']; ?></td>
                        <!--<td><?php //echo $row['deadline']; ?></td>-->

                    </tr>


                                    <?php
                                    $i++;


                                }  

                            }

                            ?>

                   <tr style="color: #f00;">
            <td colspan="4">GRAND TOTAL</td>
            <td><?php echo $totboy ?></td> 
            <td><?php echo $totgirl ?></td>
            <td><?php echo $totaltib ?></td>
            <td><?php echo $tothboy?></td>
            <td><?php echo $tothgirl ?></td>
            <td><?php echo $totalhim ?></td>
            <td><?php echo $totiboy ?></td>
            <td><?php echo $totigirl ?></td>
            <td><?php echo $totindian ?></td>
            <td><?php echo $totdboy ?></td>
            <td><?php echo $totdgirl ?></td>
            <td><?php echo $totday ?></td>
            <td><?php echo $totbboy ?></td>
            <td><?php echo $totbgirl ?></td>
            <td><?php echo $totboard ?></td>
            <td><?php echo $totalboy ?></td>
            <td><?php echo $totalgirl ?></td>
            <td><?php echo $grandtot ?></td>
                     
                    </tbody>
                </tr>
            </thead>
        </table>



   <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>
               <tr><h2 style="color:#00f"  align="center">Tibetan Homes Foundation(THF)</h2></tr>
            </thead>
            <tbody>
                  <tr>
                <th colspan="30" >Number Of Students</th>
                </tr>

            </thead>
            <tbody>
                <tr>

                <th rowspan="2" >S.no</th>
                <th colspan="3" rowspan="2" align="center">School Name</th>
                <th colspan="3" align="center">Tibetan</th>
                <th colspan="3" align="center">Indian </th>
                <th colspan="3" align="center">Himalayan </th>
                <th colspan="3" align="center">Dayscholar </th>
                <th colspan="3" align="center">Boarder</th>
                <th colspan="3" align="center">Grand Total</th>
                <!--<th rowspan="2" width="9%">Dead Line</th>-->

            </tr>
            <tr>   

                <th>Boys </th>
                <th>Girls </th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total</th>
                <th>Boys</th>
                <th>Girls</th>
                <th style="color: #f00;">Total</th>

            </tr>
        
            </thead>

          

                <?php


                $h_latest_data_student = $school->get_schoolcategory_4();
                $schools = $sch->get_school_list();
                $i = 1;
                 /*<?php
                        foreach ($h_latest_data_staff as $row) {
                            ?>*/
                            if (is_array($h_latest_data_student) && count($h_latest_data_student)) {
                                foreach ($h_latest_data_student as $row) {
                    


                                    ?> 


                                    
                    <tr>

                        <td><?php echo $i; ?></td>

                        <td colspan="3"><?php echo $row['SchoolName']; ?></td>
                        <td><?php echo $row['tibetanboys']; ?></td>
                        <td><?php echo $row['tibetangirls']; ?></td>
                        <td><?php echo $row['total1']; ?></td>
                        <td><?php echo $row['himalayanboys']; ?></td>
                        <td><?php echo $row['himalayangirls']; ?></td>
                        <td><?php echo $row['total2']; ?></td>
                        <td><?php echo $row['Indianboys']; ?></td>
                        <td><?php echo $row['Indiangirls']; ?></td>
                        <td><?php echo $row['total3']; ?></td>
                        <td><?php echo $row['Dayboys']; ?></td>
                        <td><?php echo $row['Daygirls']; ?></td>
                        <td><?php echo $row['total4']; ?></td>
                        <td><?php echo $row['boardingboys']; ?></td>
                        <td><?php echo $row['boardinggirls']; ?></td>
                        <td><?php echo $row['total5']; ?></td>
                        <td><?php echo $row['TotalBoy']; ?></td>
                        <td><?php echo $row['TotalGirl']; ?></td>
                        <td style="color: #f00;"><?php echo $row['Grand Total']; ?></td>
                        <!--<td><?php //echo $row['deadline']; ?></td>-->

                    </tr>


                                    <?php
                                    $i++;


                                }  

                            }

                            ?>

                   <tr style="color: #f00;">
            <td colspan="4">GRAND TOTAL</td>
            <td><?php echo $totboy ?></td> 
            <td><?php echo $totgirl ?></td>
            <td><?php echo $totaltib ?></td>
            <td><?php echo $tothboy?></td>
            <td><?php echo $tothgirl ?></td>
            <td><?php echo $totalhim ?></td>
            <td><?php echo $totiboy ?></td>
            <td><?php echo $totigirl ?></td>
            <td><?php echo $totindian ?></td>
            <td><?php echo $totdboy ?></td>
            <td><?php echo $totdgirl ?></td>
            <td><?php echo $totday ?></td>
            <td><?php echo $totbboy ?></td>
            <td><?php echo $totbgirl ?></td>
            <td><?php echo $totboard ?></td>
            <td><?php echo $totalboy ?></td>
            <td><?php echo $totalgirl ?></td>
            <td><?php echo $grandtot ?></td>
                     
                    </tbody>
                </tr>
            </thead>
        </table>

<br/>
<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>
               <tr><h2 style="color:#00f"  align="center">Snow Lion Foundation, Nepal</h2></tr>
            </thead>
            <tbody>
            
                <tr>
                <th colspan="30" >Number Of Students</th>
                </tr>  



            </thead>
            <tbody>
                <tr>

                <th rowspan="2" >S.no</th>
                <th colspan="3" rowspan="2" align="center">School Name</th>
                <th colspan="3" align="center">Tibetan</th>
                <th colspan="3" align="center">Indian </th>
                <th colspan="3" align="center">Himalayan </th>
                <th colspan="3" align="center">Dayscholar </th>
                <th colspan="3" align="center">Boarder</th>
                <th colspan="3" align="center">Grand Total</th>
                <!--<th rowspan="2" width="9%">Dead Line</th>-->

            </tr>
            <tr>   

                <th>Boys </th>
                <th>Girls </th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total</th>
                <th>Boys</th>
                <th>Girls</th>
                <th style="color: #f00;">Total</th>

            </tr>
        
            </thead>

          

                <?php


                $h_latest_data_student = $school->get_schoolcategory_6();
                $schools = $sch->get_school_list();
                $i = 1;
                 /*<?php
                        foreach ($h_latest_data_staff as $row) {
                            ?>*/
                            if (is_array($h_latest_data_student) && count($h_latest_data_student)) {
                                foreach ($h_latest_data_student as $row) {
                     $tboy = $row['tibetanboys'];
                     $tgirl = $row['tibetangirls'];
                     $tottib = $row['total1'];
                     $hboy = $row['himalayanboys'];
                     $hgirl = $row['himalayangirls'];
                     $tothim = $row['total2'];
                     $iboy = $row['Indianboys'];
                     $igirl = $row['Indiangirls'];
                     $totind = $row['total3'];
                     $dboy = $row['Dayboys'];
                     $dgirl = $row['Daygirls'];
                     $totd = $row['total4'];
                     $bboy = $row['boardingboys'];
                     $bgirl = $row['boardinggirls'];
                     $totb = $row['total5'];
                     $totby = $row['TotalBoy'];
                     $totgl = $row['TotalGirl'];
                     $gtot = $row['Grand Total'];


                     $totboy += $tboy;
                     $totgirl += $tgirl;
                     $totaltib += $tottib;
                     $tothboy += $hboy;
                     $tothgirl += $hgirl;
                     $totalhim += $tothim;
                     $totiboy += $iboy;
                     $totigirl += $igirl;
                     $totindian += $totind;
                     $totdboy += $dboy;
                     $totdgirl += $dgirl;
                     $totday += $totd;
                     $totbboy += $bboy;
                     $totbgirl += $bgirl;
                     $totboard += $totb;
                     $totalboy += $totby;
                     $totalgirl += $totgl;
                     $grandtot += $gtot; 
                   


                                    ?> 


                                    
                    <tr>

                        <td><?php echo $i; ?></td>

                        <td colspan="3"><?php echo $row['SchoolName']; ?></td>
                        <td><?php echo $row['tibetanboys']; ?></td>
                        <td><?php echo $row['tibetangirls']; ?></td>
                        <td><?php echo $row['total1']; ?></td>
                        <td><?php echo $row['himalayanboys']; ?></td>
                        <td><?php echo $row['himalayangirls']; ?></td>
                        <td><?php echo $row['total2']; ?></td>
                        <td><?php echo $row['Indianboys']; ?></td>
                        <td><?php echo $row['Indiangirls']; ?></td>
                        <td><?php echo $row['total3']; ?></td>
                        <td><?php echo $row['Dayboys']; ?></td>
                        <td><?php echo $row['Daygirls']; ?></td>
                        <td><?php echo $row['total4']; ?></td>
                        <td><?php echo $row['boardingboys']; ?></td>
                        <td><?php echo $row['boardinggirls']; ?></td>
                        <td><?php echo $row['total5']; ?></td>
                        <td><?php echo $row['TotalBoy']; ?></td>
                        <td><?php echo $row['TotalGirl']; ?></td>
                        <td style="color: #f00;"><?php echo $row['Grand Total']; ?></td>
                        <!--<td><?php //echo $row['deadline']; ?></td>-->

                    </tr>


                                    <?php
                                    $i++;


                                }  

                            }

                            ?>

                   <tr style="color: #f00;">
            <td colspan="4">GRAND TOTAL</td>
            <td><?php echo $totboy ?></td> 
            <td><?php echo $totgirl ?></td>
            <td><?php echo $totaltib ?></td>
            <td><?php echo $tothboy?></td>
            <td><?php echo $tothgirl ?></td>
            <td><?php echo $totalhim ?></td>
            <td><?php echo $totiboy ?></td>
            <td><?php echo $totigirl ?></td>
            <td><?php echo $totindian ?></td>
            <td><?php echo $totdboy ?></td>
            <td><?php echo $totdgirl ?></td>
            <td><?php echo $totday ?></td>
            <td><?php echo $totbboy ?></td>
            <td><?php echo $totbgirl ?></td>
            <td><?php echo $totboard ?></td>
            <td><?php echo $totalboy ?></td>
            <td><?php echo $totalgirl ?></td>
            <td><?php echo $grandtot ?></td>
                     
                    </tbody>
                </tr>
            </thead>
        </table>



         <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>
               <tr><h2 style="color:#00f"  align="center"> Sambhota Tibetan Schools Society(STSS)</h2></tr>
            </thead>
            <tbody>
              
               
                <tr>
                <th colspan="30" >Number Of Students</th>
                </tr>



            </thead>
            <tbody>
                <tr>

                <th rowspan="2" >S.no</th>
                <th colspan="3" rowspan="2" align="center">School Name</th>
                <th colspan="3" align="center">Tibetan</th>
                <th colspan="3" align="center">Indian </th>
                <th colspan="3" align="center">Himalayan </th>
                <th colspan="3" align="center">Dayscholar </th>
                <th colspan="3" align="center">Boarder</th>
                <th colspan="3" align="center">Grand Total</th>
                <!--<th rowspan="2" width="9%">Dead Line</th>-->

            </tr>
            <tr>   

                <th>Boys </th>
                <th>Girls </th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total</th>
                <th>Boys</th>
                <th>Girls</th>
                <th style="color: #f00;">Total</th>

            </tr>
        
            </thead>

          

                <?php


                $h_latest_data_student = $school->get_schoolcategory_3();
                $schools = $sch->get_school_list();
                $i = 1;
                 /*<?php
                        foreach ($h_latest_data_staff as $row) {
                            ?>*/
                            if (is_array($h_latest_data_student) && count($h_latest_data_student)) {
                                foreach ($h_latest_data_student as $row) {
                    
                   


                                    ?> 


                                    
                    <tr>

                        <td><?php echo $i; ?></td>

                        <td colspan="3"><?php echo $row['SchoolName']; ?></td>
                        <td><?php echo $row['tibetanboys']; ?></td>
                        <td><?php echo $row['tibetangirls']; ?></td>
                        <td><?php echo $row['total1']; ?></td>
                        <td><?php echo $row['himalayanboys']; ?></td>
                        <td><?php echo $row['himalayangirls']; ?></td>
                        <td><?php echo $row['total2']; ?></td>
                        <td><?php echo $row['Indianboys']; ?></td>
                        <td><?php echo $row['Indiangirls']; ?></td>
                        <td><?php echo $row['total3']; ?></td>
                        <td><?php echo $row['Dayboys']; ?></td>
                        <td><?php echo $row['Daygirls']; ?></td>
                        <td><?php echo $row['total4']; ?></td>
                        <td><?php echo $row['boardingboys']; ?></td>
                        <td><?php echo $row['boardinggirls']; ?></td>
                        <td><?php echo $row['total5']; ?></td>
                        <td><?php echo $row['TotalBoy']; ?></td>
                        <td><?php echo $row['TotalGirl']; ?></td>
                        <td style="color: #f00;"><?php echo $row['Grand Total']; ?></td>
                        <!--<td><?php //echo $row['deadline']; ?></td>-->

                    </tr>


                                    <?php
                                    $i++;


                                }  

                            }

                            ?>

                   <tr style="color: #f00;">
            <td colspan="4">GRAND TOTAL</td>
            <td><?php echo $totboy ?></td> 
            <td><?php echo $totgirl ?></td>
            <td><?php echo $totaltib ?></td>
            <td><?php echo $tothboy?></td>
            <td><?php echo $tothgirl ?></td>
            <td><?php echo $totalhim ?></td>
            <td><?php echo $totiboy ?></td>
            <td><?php echo $totigirl ?></td>
            <td><?php echo $totindian ?></td>
            <td><?php echo $totdboy ?></td>
            <td><?php echo $totdgirl ?></td>
            <td><?php echo $totday ?></td>
            <td><?php echo $totbboy ?></td>
            <td><?php echo $totbgirl ?></td>
            <td><?php echo $totboard ?></td>
            <td><?php echo $totalboy ?></td>
            <td><?php echo $totalgirl ?></td>
            <td><?php echo $grandtot ?></td>
                     
                    </tbody>
                </tr>
            </thead>
        </table>



         <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>
               <tr><h2 style="color:#00f"  align="center"> Tibetan Children's Village(TCV)</h></tr>
            </thead>
            <tbody>
                
                  <tr>
                <th colspan="30" >Number Of Students</th>
                </tr>



            </thead>
            <tbody>
                <tr>

                <th rowspan="2" >S.no</th>
                <th colspan="3" rowspan="2" align="center">School Name</th>
                <th colspan="3" align="center">Tibetan</th>
                <th colspan="3" align="center">Indian </th>
                <th colspan="3" align="center">Himalayan </th>
                <th colspan="3" align="center">Dayscholar </th>
                <th colspan="3" align="center">Boarder</th>
                <th colspan="3" align="center">Grand Total</th>
                <!--<th rowspan="2" width="9%">Dead Line</th>-->

            </tr>
            <tr>   

                <th>Boys </th>
                <th>Girls </th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total</th>
                <th>Boys</th>
                <th>Girls</th>
                <th style="color: #f00;">Total</th>

            </tr>
        
            </thead>

          

                <?php


                $h_latest_data_student = $school->get_schoolcategory_1();
                $schools = $sch->get_school_list();
                $i = 1;
                 /*<?php
                        foreach ($h_latest_data_staff as $row) {
                            ?>*/
                            if (is_array($h_latest_data_student) && count($h_latest_data_student)) {
                                foreach ($h_latest_data_student as $row) {
                    
           

                                    ?> 


                                    
                    <tr>

                        <td><?php echo $i; ?></td>

                        <td colspan="3"><?php echo $row['SchoolName']; ?></td>
                        <td><?php echo $row['tibetanboys']; ?></td>
                        <td><?php echo $row['tibetangirls']; ?></td>
                        <td><?php echo $row['total1']; ?></td>
                        <td><?php echo $row['himalayanboys']; ?></td>
                        <td><?php echo $row['himalayangirls']; ?></td>
                        <td><?php echo $row['total2']; ?></td>
                        <td><?php echo $row['Indianboys']; ?></td>
                        <td><?php echo $row['Indiangirls']; ?></td>
                        <td><?php echo $row['total3']; ?></td>
                        <td><?php echo $row['Dayboys']; ?></td>
                        <td><?php echo $row['Daygirls']; ?></td>
                        <td><?php echo $row['total4']; ?></td>
                        <td><?php echo $row['boardingboys']; ?></td>
                        <td><?php echo $row['boardinggirls']; ?></td>
                        <td><?php echo $row['total5']; ?></td>
                        <td><?php echo $row['TotalBoy']; ?></td>
                        <td><?php echo $row['TotalGirl']; ?></td>
                        <td style="color: #f00;"><?php echo $row['Grand Total']; ?></td>
                        <!--<td><?php //echo $row['deadline']; ?></td>-->

                    </tr>


                                    <?php
                                    $i++;


                                }  

                            }

                            ?>

                   <tr style="color: #f00;">
            <td colspan="4">GRAND TOTAL</td>
            <td><?php echo $totboy ?></td> 
            <td><?php echo $totgirl ?></td>
            <td><?php echo $totaltib ?></td>
            <td><?php echo $tothboy?></td>
            <td><?php echo $tothgirl ?></td>
            <td><?php echo $totalhim ?></td>
            <td><?php echo $totiboy ?></td>
            <td><?php echo $totigirl ?></td>
            <td><?php echo $totindian ?></td>
            <td><?php echo $totdboy ?></td>
            <td><?php echo $totdgirl ?></td>
            <td><?php echo $totday ?></td>
            <td><?php echo $totbboy ?></td>
            <td><?php echo $totbgirl ?></td>
            <td><?php echo $totboard ?></td>
            <td><?php echo $totalboy ?></td>
            <td><?php echo $totalgirl ?></td>
            <td><?php echo $grandtot ?></td>
                     
                    </tbody>
                </tr>
            </thead>
        </table>
 <br/>


<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
        <thead>
               <tr><h2 style="color:#00f"  align="center">Private Tibetan Communities</h2></tr>
            </thead>
            <tbody>
                
                <tr>
                <th colspan="30" >Number Of Students</th>
                </tr>



            </thead>
            <tbody>
                <tr>

                <th rowspan="2" >S.no</th>
                <th colspan="3" rowspan="2" align="center">School Name</th>
                <th colspan="3" align="center">Tibetan</th>
                <th colspan="3" align="center">Indian </th>
                <th colspan="3" align="center">Himalayan </th>
                <th colspan="3" align="center">Dayscholar </th>
                <th colspan="3" align="center">Boarder</th>
                <th colspan="3" align="center">Grand Total</th>
                <!--<th rowspan="2" width="9%">Dead Line</th>-->

            </tr>
            <tr>   

                <th>Boys </th>
                <th>Girls </th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total </th>
                <th>Boys</th>
                <th>Girls</th>
                <th>Total</th>
                <th>Boys</th>
                <th>Girls</th>
                <th style="color: #f00;">Total</th>

            </tr>
        
            </thead>

          

                <?php


                $h_latest_data_student = $school->get_schoolcategory_5();
                $schools = $sch->get_school_list();
                $i = 1;
                 /*<?php
                        foreach ($h_latest_data_staff as $row) {
                            ?>*/
                            if (is_array($h_latest_data_student) && count($h_latest_data_student)) {
                                foreach ($h_latest_data_student as $row) {
                     $tboy = $row['tibetanboys'];
                     $tgirl = $row['tibetangirls'];
                     $tottib = $row['total1'];
                     $hboy = $row['himalayanboys'];
                     $hgirl = $row['himalayangirls'];
                     $tothim = $row['total2'];
                     $iboy = $row['Indianboys'];
                     $igirl = $row['Indiangirls'];
                     $totind = $row['total3'];
                     $dboy = $row['Dayboys'];
                     $dgirl = $row['Daygirls'];
                     $totd = $row['total4'];
                     $bboy = $row['boardingboys'];
                     $bgirl = $row['boardinggirls'];
                     $totb = $row['total5'];
                     $totby = $row['TotalBoy'];
                     $totgl = $row['TotalGirl'];
                     $gtot = $row['Grand Total'];


                     $totboy += $tboy;
                     $totgirl += $tgirl;
                     $totaltib += $tottib;
                     $tothboy += $hboy;
                     $tothgirl += $hgirl;
                     $totalhim += $tothim;
                     $totiboy += $iboy;
                     $totigirl += $igirl;
                     $totindian += $totind;
                     $totdboy += $dboy;
                     $totdgirl += $dgirl;
                     $totday += $totd;
                     $totbboy += $bboy;
                     $totbgirl += $bgirl;
                     $totboard += $totb;
                     $totalboy += $totby;
                     $totalgirl += $totgl;
                     $grandtot += $gtot; 
                   


                                    ?> 


                                    
                    <tr>

                        <td><?php echo $i; ?></td>

                        <td colspan="3"><?php echo $row['SchoolName']; ?></td>
                        <td><?php echo $row['tibetanboys']; ?></td>
                        <td><?php echo $row['tibetangirls']; ?></td>
                        <td><?php echo $row['total1']; ?></td>
                        <td><?php echo $row['himalayanboys']; ?></td>
                        <td><?php echo $row['himalayangirls']; ?></td>
                        <td><?php echo $row['total2']; ?></td>
                        <td><?php echo $row['Indianboys']; ?></td>
                        <td><?php echo $row['Indiangirls']; ?></td>
                        <td><?php echo $row['total3']; ?></td>
                        <td><?php echo $row['Dayboys']; ?></td>
                        <td><?php echo $row['Daygirls']; ?></td>
                        <td><?php echo $row['total4']; ?></td>
                        <td><?php echo $row['boardingboys']; ?></td>
                        <td><?php echo $row['boardinggirls']; ?></td>
                        <td><?php echo $row['total5']; ?></td>
                        <td><?php echo $row['TotalBoy']; ?></td>
                        <td><?php echo $row['TotalGirl']; ?></td>
                        <td style="color: #f00;"><?php echo $row['Grand Total']; ?></td>
                        <!--<td><?php //echo $row['deadline']; ?></td>-->

                    </tr>


                                    <?php
                                    $i++;


                                }  

                            }

                            ?>

                   <tr style="color: #f00;">
            <td colspan="4">GRAND TOTAL</td>
            <td><?php echo $totboy ?></td> 
            <td><?php echo $totgirl ?></td>
            <td><?php echo $totaltib ?></td>
            <td><?php echo $tothboy?></td>
            <td><?php echo $tothgirl ?></td>
            <td><?php echo $totalhim ?></td>
            <td><?php echo $totiboy ?></td>
            <td><?php echo $totigirl ?></td>
            <td><?php echo $totindian ?></td>
            <td><?php echo $totdboy ?></td>
            <td><?php echo $totdgirl ?></td>
            <td><?php echo $totday ?></td>
            <td><?php echo $totbboy ?></td>
            <td><?php echo $totbgirl ?></td>
            <td><?php echo $totboard ?></td>
            <td><?php echo $totalboy ?></td>
            <td><?php echo $totalgirl ?></td>
            <td><?php echo $grandtot ?></td>
                     
                    </tbody>
                </tr>
            </thead>
        </table>





