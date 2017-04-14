<?php

    if (!isset($_POST['minute_out'])) {
        print "<select name=\"minute_out\" id=\"minute_out\">";
   
        } else if (($_POST['minute_out']) == "1") {
        
                $error_array['minute_out'] = 'error_minute_out';
                print "<select name=\"minute_out\" id=\"minute_out_error\">";
                
            } else {
                print "<select name=\"minute_out\" id=\"minute_out\">";
            }                                    
        print "<option value=\"1\"></option>";
                                        
        $minute = array (
            
        '00' => '00',
        '15' => '15',
        '30' => '30',
        '45' => '45' );

            foreach ($minute as $minutes => $minute) {

                $selected = "1";
                                        
                if (isset($_POST['minute_out'])) {
                    if ($_POST['minute_out'] == $minutes) {
                        $selected = "selected=\"selected\"";
                    }
                }
                
                print "<option value=\"$minutes\" $selected>$minute</option>"; 
                                            
            }
print "</select>";

if (isset($_POST['minute_out'])) {
        if (($_POST['minute_out']) == "1") {
            print "<h5 class=\"error\" id=\"job_error\">Please enter your time-out minutes!!</h5>";   
        }
      }
?>