<?php
    
    if (!isset($_POST['hour_in'])) {
        print "<select name=\"hour_in\" id=\"hour_in\">";
   
        } else if (($_POST['hour_in']) == "0") {
        
                $error_array['hour_in'] = 'error_hour_in';
                print "<select name=\"hour_in\" id=\"hour_in_error\">";
                
            } else {
                print "<select name=\"hour_in\" id=\"hour_in\">";
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
                                            
        if (isset($_POST['hour_in'])) {
            if ($_POST['hour_in'] == $hours) {
                $selected = "selected=\"selected\"";
            }
        }
        
        print "<option value=\"$hours\" $selected>$hour</option>"; 
    }

print "</select>";

if (isset($_POST['hour_in'])) {
        if (($_POST['hour_in']) == "0") {
            print "<h5 class=\"error\" id=\"job_error\">Please enter your time-in hours!!</h5>";   
        }
      }

?> 