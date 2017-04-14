<?php
    
    if (!isset($_POST['lunch_time'])) {
        print "<select name=\"lunch_time\" id=\"lunch_time\">";
   
        } else if (($_POST['lunch_time']) == "1") {
        
                $error_array['lunch'] = 'error_lunch';
                print "<select name=\"lunch_time\" id=\"lunch_time_error\">";
                
            } else {
                print "<select name=\"lunch_time\" id=\"lunch_time\">";
            }                                    
        print "<option value=\"1\"></option>";
    
    
    $lunch = array (
        
        '00' => '0:00',
        '15' => '0:15',
        '30' => '0:30',
        '45' => '0:45',
        '60' => '1:00',
        '75' => '1:15',
        '90' => '1:30',
        '105' => '1:45',
        '120' => '2:00' );
    
    foreach ($lunch as $lunchs => $lunch) {
        
        $selected = "";
                                            
        if (isset($_POST['lunch_time'])) {
            if ($_POST['lunch_time'] == $lunchs) {
                $selected = "selected=\"selected\"";
            }
        }
        
        print "<option value=\"$lunchs\" $selected>$lunch</option>"; 
    }

print "</select>";

if (isset($_POST['lunch_time'])) {
        if (($_POST['lunch_time']) == "1") {
            
            print "<h5 class=\"error\" id=\"job_error\">Please enter your lunch time!!</h5>";   
        }
      }

?> 