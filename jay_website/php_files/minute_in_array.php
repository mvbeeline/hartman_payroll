<?php

    if (!isset($_POST['minute_in'])) {
        print "<select name=\"minute_in\" id=\"minute_in\">";
   
        } else if (($_POST['minute_in']) == "1") {
        
                $error_array['minute_in'] = 'error_minute_in';
                print "<select name=\"minute_in\" id=\"minute_in_error\">";
                
            } else {
                print "<select name=\"minute_in\" id=\"minute_in\">";
            }                                    
        print "<option value=\"1\"></option>";
                                        
        $minute = array (
            
        '00' => '00',
        '15' => '15',
        '30' => '30',
        '45' => '45' );

            foreach ($minute as $minutes => $minute) {

                $selected = "1";
                                        
                if (isset($_POST['minute_in'])) {
                    if ($_POST['minute_in'] == $minutes) {
                        $selected = "selected=\"selected\"";
                    }
                }
                
                print "<option value=\"$minutes\" $selected>$minute</option>"; 
                                            
            }
print "</select>";

if (isset($_POST['minute_in'])) {
        if (($_POST['minute_in']) == "1") {
            print "<h5 class=\"error\" id=\"job_error\">Please enter your time-in minutes!!</h5>";   
        }
      }
?>