<?php
    
    if (!isset($_POST['hour_out'])) {
        print "<select name=\"hour_out\" id=\"hour_out\">";
   
        } else if (($_POST['hour_out']) == "0") {
        
                $error_array['hour_out'] = 'error_hour_out';
        
                print "<select name=\"hour_out\" id=\"hour_out_error\">";
                
            } else {
                print "<select name=\"hour_out\" id=\"hour_out\">";
            }                                    
        print "<option value=\"0\"></option>";
    
    
    $hour = array (
        
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '10' => '10',
        '11' => '11',
        '12' => '12' );
    
    foreach ($hour as $hours => $hour) {
        
        $selected = "";
                                            
        if (isset($_POST['hour_out'])) {
            if ($_POST['hour_out'] == $hours) {
                $selected = "selected=\"selected\"";
            }
        }
        
        print "<option value=\"$hours\" $selected>$hour</option>"; 
    }

print "</select>";

if (isset($_POST['hour_out'])) {
        if (($_POST['hour_out']) == "0") {
            print "<h5 class=\"error\" id=\"job_error\">Please enter your time-out hours!!</h5>";   
        }
      }

?> 