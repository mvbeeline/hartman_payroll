
<?php 



$months = array (

'1' => 'January',
'2' => 'February',
'3' => 'March',
'4' => 'April',
'5' => 'May',
'6' => 'June',
'7' => 'July',
'8' => 'August',
'9' => 'September',
'10' => 'October',
'11' => 'November',
'12' => 'December'
); 
                      

                                    foreach ($months as $number => $months) {

                                       $selected = "";
                                        
                                        if (isset($_POST['month'])) {
                                             if ($_POST['month'] == $number) {
                                                 $selected = "selected=\"selected\"";
                                             }
                                         } elseif (isset($_POST['time_in'])) {
                                            $ts = $_POST['time_in'];
                                            $month = date('n', $ts);
                                            if ($number == $month) {
                                                $selected = "selected=\"selected\"";
                                            }
                                            
                                            
                                        } elseif ($number == date('n')) {
                                            $selected = "selected=\"selected\"";
                                         }
                                                                            

                                        print "<option value=\"$number\" $selected>$months</option>"; 
    
}?>