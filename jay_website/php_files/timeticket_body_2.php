    <div class="header_1">
        <div id="header_4">
            <div class="ticket">
                <form action="<?php echo BASE_URI_HTTPS . 'timeticket.php'?>" method="post">
                    <?php include ("timeticket_body_1.php"); 
                           
                      if (count($error_array) > 0) { 
                    
                        print '<input type="submit" name="submit" id="time_submit" value="Submit" />';
                    
                    }  else {
                          
                          
                        print '<h4>Please review the information entered and make any changes.<br />
                        Then hit Enter to add a line item to your timeticket. <br /></h4>';
                            
                        print '<input type="submit" name="enter" id="time_enter" value="ENTER" />';
                          
                      }
                    
                    
                    
                    ?>         
                </form>
            </div>
        </div>
    </div>