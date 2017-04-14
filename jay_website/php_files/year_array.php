
<?php 

if (isset($_POST['year'])) {
    
    if (($_POST['year']) == "") {
    
    $error_array['year'] = 'error';
    
    }
}


$years = array (

    '2017' => '2017',
    '2018' => '2018',
    '2019' => '2019',
    '2020' => '2020',
    '2021' => '2021',
    ); 
                      

                                    foreach ($years as $number => $years) {

                                       $selected = "";
                                        
                                        if (!isset($_POST['year'])) {
                                            if ($number == date('Y')) {
                                            $selected = "selected=\"selected\"";
                                         }
                                        }


                                         if (isset($_POST['year'])) {
                                             if ($_POST['year'] == $number) {
                                                 $selected = "selected=\"selected\"";
                                             }
                                         }

                                        print "<option value=\"$number\" $selected>$years</option>";
                                        
                                        
    
}?>