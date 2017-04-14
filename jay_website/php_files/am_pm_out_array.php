<?php

    if (!isset($_POST['am_pm_out'])) {
        print "<select name=\"am_pm_out\" id=\"am_pm_out\">";
   
        } else if (($_POST['am_pm_out']) == "1") {
        
                $error_array['am_pm_out'] = 'error_am_pm_out';
                print "<select name=\"am_pm_out\" id=\"am_pm_out_error\">";
                
            } else {
                print "<select name=\"am_pm_out\" id=\"am_pm_out\">";
            }                                    
        print "<option value=\"1\"></option>";
                                        
        $am_pm = array (
            
        'am' => 'am',
        'pm' => 'pm' );

            foreach ($am_pm as $am_pms => $am_pm) {

                $selected = "1";
                                        
                if (isset($_POST['am_pm_out'])) {
                    if ($_POST['am_pm_out'] == $am_pms) {
                        $selected = "selected=\"selected\"";
                    }
                }
                
                print "<option value=\"$am_pms\" $selected>$am_pm</option>"; 
                                            
            }
    print "</select>";

    if (isset($_POST['am_pm_out'])) {
        if (($_POST['am_pm_out']) == "1") {
            print "<h5 class=\"error\">Please enter AM or PM!!</h5>";   
        }
      }
?>