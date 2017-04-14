<?php

    if (!isset($_POST['am_pm_in'])) {
        print "<select name=\"am_pm_in\" id=\"am_pm_in\">";
   
        } else if (($_POST['am_pm_in']) == "1") {
        
                $error_array['am_pm_in'] = 'error_am_pm_in';
                print "<select name=\"am_pm_in\" id=\"am_pm_in_error\">";
                
            } else {
                print "<select name=\"am_pm_in\" id=\"am_pm_in\">";
            }                                    
        print "<option value=\"1\"></option>";
                                        
        $am_pm = array (
            
        'am' => 'am',
        'pm' => 'pm' );

            foreach ($am_pm as $am_pms => $am_pm) {

                $selected = "1";
                                        
                if (isset($_POST['am_pm_in'])) {
                    if ($_POST['am_pm_in'] == $am_pms) {
                        $selected = "selected=\"selected\"";
                    }
                }
                
                print "<option value=\"$am_pms\" $selected>$am_pm</option>"; 
                                            
            }
    print "</select>";

    if (isset($_POST['am_pm_in'])) {
        if (($_POST['am_pm_in']) == "1") {
            print "<h5 class=\"error\">Please enter AM or PM!!</h5>";   
        }
      }
?>