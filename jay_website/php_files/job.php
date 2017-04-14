
<?php 

    if (!isset($_POST['job'])) {
        print "<select name=\"job\" id=\"job_list\">";
   
        } else if (($_POST['job']) == "0") {
                print "<select name=\"job\" id=\"job_list_1\">";
                
            } else {
                print "<select name=\"job\" id=\"job_list\">";
            }
    print "<option value=\"0\"></option>";

    $query = "SELECT `job_name`, `address` FROM `job` WHERE `active`= 'yes'";
    $query = mysqli_query($dbc, $query);
                                
    while($row = mysqli_fetch_array($query)) {
                                        
        $selected = "";
                                    
        $job_name = stripslashes($row['job_name']);
        $address = stripslashes($row['address']);
            if ($address != "") $job_name = $job_name . ", " . $address;
                                        
                if (isset($_POST['job'])) {
                                
                    if ($_POST['job'] == $job_name) {
                        $selected = "selected=\"selected\"";
                    }
                                
                }
                                        
        print "<option value=\"$job_name\" $selected>$job_name</option>";
    }
 
    print "</select>";
    
      if (isset($_POST['job'])) {
        if (($_POST['job']) == "0") {
            print "<h5 class=\"error\" id=\"job_error\">Please enter a job name!!</h5>";  
            $error_array['job'] = 'error_job';
        }
      }
?>