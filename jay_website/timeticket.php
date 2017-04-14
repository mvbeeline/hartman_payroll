<?php
    include("php_files/config.php");
    include("mysqli/mysqli_connection.php");
    include("functions/functions.php"); 
    include("php_files/session_check.php");
    include("html/header.html"); ?>

<?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {
            if (($_POST['submit']) == 'Submit') {

                echo 'test';

                $error_array = array();


                include("php_files/timeticket_body_2.php");



                include("html/footer.html");

                $echo = count($error_array);
                echo $echo;

                if (count($error_array) > 0) {

                echo " help";
                $echo = $error_array['description'];
                echo $echo;
                $echo = $error_array['minute_out'];
                echo $echo;
                $echo = $error_array['minute_in'];
                echo $echo;
                $echo = $error_array['lunch'];
                echo $echo;
                $echo = $error_array['hour_in'];
                echo $echo;
                $echo = $error_array['hour_out'];
                echo $echo;
                $echo = $error_array['am_pm_in'];
                echo $echo;
                $echo = $error_array['am_pm_out'];
                echo $echo; 
                $echo = $error_array['job'];
                echo $echo;
                }

                unset($error_array);


                exit();


            }
        }
   

        if (isset($_POST['enter'])) {
    
            $description = db_safe($_POST['description'], $dbc);
            $job = db_safe($_POST['job'], $dbc);
            $month = db_safe($_POST['month'], $dbc);
            $day = db_safe($_POST['day'], $dbc);
            $year = db_safe($_POST['year'], $dbc);
            $hour_in = db_safe($_POST['hour_in'], $dbc);
            $hour_out = db_safe($_POST['hour_out'], $dbc);
            $minute_in = db_safe($_POST['minute_in'], $dbc);
            $minute_out = db_safe($_POST['minute_out'], $dbc);
            $am_pm_in = db_safe($_POST['am_pm_in'], $dbc);
            $am_pm_out = db_safe($_POST['am_pm_out'], $dbc);
            $lunch = db_safe($_POST['lunch_time'], $dbc);
            
            if ($am_pm_in == 'pm') $hour_in = $hour_in + 12;
            
            $ts_in = mktime($hour_in, $minute_in, 0, $month, $day, $year);
            
            
            
            if ($am_pm_out == 'pm') $hour_out = $hour_out + 12;
            
            $ts_out = mktime($hour_out, $minute_out, 0, $month, $day, $year);
            
                       
            if (isset($_SESSION['id'])) {
                
                $id = $_SESSION['id'];
                
                if (($_POST['enter']) == 'ENTER') {
                
                $ts_start = mktime(0, 0, 0, 1, 1, 2017);
    
                $current_pay_period = ceil((($ts_in - $ts_start) / 1209600));
                $current_pay_week = ceil((($ts_in - $ts_start) / 604800));
                
                $query = "INSERT INTO `timeticket`(`employee`, `time_in`, `time_out`, `job`, `description`, `lunch`, `pay_period`, `pay_week` ) VALUES ('$id', '$ts_in' ,'$ts_out' , '$job', '$description', '$lunch', '$current_pay_period', '$current_pay_week')";
                $query = mysqli_query($dbc, $query) or die ('Could not insert data because: ' . mysqli_error($dbc)); 
                
                    
                    }
                
                if (($_POST['enter']) == 'SAVE CHANGES') {
                    
                    $id_edit = db_safe($_POST['edit_id'], $dbc);
                    
                    $up_query = "UPDATE `timeticket` SET `time_in`= '$ts_in',`time_out`='$ts_out',`job`='$job',`description`='$description',`lunch`='$lunch' WHERE `id` = '$id_edit'";
                    $up_query = mysqli_query($dbc, $up_query) or die ('Could not insert data because: ' . mysqli_error($dbc));
                    
                    
                    
                }
                

        print   '<table>
                    <tr>
                        <th class="day">Day</th>
                        <th class="date">Date</th>
                        <th class="time_in">Time In</th>
                        <th class="time_out">Time Out</th>
                        <th class="job">Job Name</th>
                        <th class="lunch">Lunch</th>
                        <th class="hours">Hours</th>
                        <th class="desc">Description</th>
                    </tr>'  ;
                    
                
                


                

        $current_pay_period = CURRENT_PAY_WEEK;
                
         
            $sel_query = "SELECT `id`, `time_in`, `time_out`, `job`, `description`, `lunch` FROM `timeticket` WHERE `employee` = '$id' AND `pay_week` = '$current_pay_period' ORDER BY `time_in`";
                $sel_query = mysqli_query($dbc, $sel_query);
                
                while($row = mysqli_fetch_array($sel_query)) {
                    
                    
                                        
                    $id = stripslashes($row['id']); 
                    $time_in = stripslashes($row['time_in']); 
                    $time_out = stripslashes($row['time_out']);
                    $job = stripslashes($row['job']);
                    $description = stripslashes($row['description']);
                    $lunch = stripslashes($row['lunch']);
                    $hour_in = date('g', $time_in);
                    $hour_out = date('g', $time_out);
                    $minute_in = date('i', $time_in);
                    $minute_out = date('i', $time_out);
                    $am_pm_in = date('a', $time_in);
                    $am_pm_out = date('a', $time_out);
                    
                        
                    $day = date('l', $time_in);
                    $date = date('M. j, Y', $time_in);
                    $lunch_time = ($lunch / 60);
                    $total_hours = ((($time_out - $time_in) /3600) - $lunch_time);
                    
                    $time_in_date = date('g:iA', $time_in);
                    $time_out_date = date('g:iA', $time_out);
                    
                    
                    print "
                        <form action=\"timeticket.php\" method=\"post\">
                            <input type=\"hidden\" name=\"edit_id\" value=\"$id\" />
                            <input type=\"hidden\" name=\"time_in\" value=\"$time_in\" />
                            <input type=\"hidden\" name=\"hour_in\" value=\"$hour_in\" />
                            <input type=\"hidden\" name=\"hour_out\" value=\"$hour_out\" />
                            <input type=\"hidden\" name=\"minute_in\" value=\"$minute_in\" />
                            <input type=\"hidden\" name=\"minute_out\" value=\"$minute_out\" />
                            <input type=\"hidden\" name=\"am_pm_in\" value=\"$am_pm_in\" />
                            <input type=\"hidden\" name=\"am_pm_out\" value=\"$am_pm_out\" />
                            <input type=\"hidden\" name=\"job\" value=\"$job\" />
                            <input type=\"hidden\" name=\"description\" value=\"$description\" />
                            <input type=\"hidden\" name=\"lunch_time\" value=\"$lunch\" />
                            <tr>
                                <td class=\"day\">$day</td>
                                <td class=\"date\">$date </td>
                                <td class=\"time_in\">$time_in_date </td>
                                <td class=\"time_out\">$time_out_date </td>
                                <td class=\"job\">$job </td>
                                <td class=\"lunch\">$lunch_time Hrs</td>
                                <td class=\"hours\">$total_hours Hrs</td>
                                <td class=\"desc\"><textarea cols=\"25\" rows=\"5\">$description </textarea></td>
                                <td class=\"submit_edit\"><input type=\"submit\" name=\"edit\" value=\"Edit\" /><br /><input type=\"submit\" name=\"delete\" value=\"Delete\" /></td>
                            </tr>
                        </form>";
   }
                
                


            
            } else {
                
                print '<h4>There has been a system error, please contact the TimeTicket Admin!!</h4>';
                
            }
            
            include("html/footer.html");
            exit();
            
            
            
            
            
        
        }
    
    

if (isset($_POST['edit'])) {
    
    ?>
        <div class="header_1">
                <div id="header_4">
                    <div class="ticket">
                        <form action="<?php echo BASE_URI_HTTPS . 'timeticket.php'?>" method="post">

                            <?php include ('php_files/timeticket_body_1.php'); ?>

                            <input type="hidden" name="edit" value="edit"/>
                            <input type="hidden" name="edit_id" value="<?php echo $_POST['edit_id'];?>"/>
                            <input type="submit" name="enter" id="time_submit" value="SAVE CHANGES" />
                        </form>
                    </div>
                </div>
            </div>

                
<?php               
  

        
    include("html/footer.html");
    exit();
    
    }
}


 /*
 
 if (array_key_exists($name, $errors)) echo ' class="error"';
 
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
     if (is_numeric($_POST['year'])) {
         
         
         
         if (is_numeric($_POST['month'])) {
             
             if (is_numeric($_POST['day'])) {
                 
                 if (is_numeric($_POST['job'])) {
                     
                     if (is_numeric($_POST['description'])) {
                         
                         if (is_numeric($_POST['hour_in'])) {
                             
                             if (is_numeric($_POST['minute_in'])) {
                                 
                                 if (is_numeric($_POST['am_pm_in'])) {
                                     
                                     if (is_numeric($_POST['hour_out'])) {
                                         
                                         if (is_numeric($_POST['minute_out'])) {
                                             
                                             if (is_numeric($_POST['am_pm_out'])) {
                                                 
                                                 if (is_numeric($_POST['lunch_time'])) {
                                                     
                                                     
                                                 } 
                                             }
                                         }
                                     }
                                 }
                             }
                         }
                     }
                 }
             }
         }
     }
} 
*/ 

?>



    <?php include("php_files/timeticket_body.php"); ?>

    <?php include("html/footer.html"); ?>