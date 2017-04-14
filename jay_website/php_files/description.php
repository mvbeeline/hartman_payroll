
    <?php 
                    
                        
        $description = "";
                            
        if (isset($_POST['description'])) {
            
            if (($_POST['description']) == "") { 
            
                $error_array['description'] = 'error_description ';
                
                print "<textarea name=\"description\" id=\"description_3\" cols=\"30\" rows=\"5\">Please enter a discription here!!</textarea>";
            
            } else if (($_POST['description']) == "Please enter a discription here!!") {
                
                $error_array['description'] = 'error_description ';
                
                print "<textarea name=\"description\" id=\"description_3\" cols=\"30\" rows=\"5\">Please enter a discription here!!</textarea>";
                
            } else {
                            
            $description = mysqli_real_escape_string($dbc, (trim(strip_tags($_POST['description']))));
                
            print "<textarea name=\"description\" cols=\"30\" rows=\"5\">$description</textarea>";    
            } 
        } else {
            
            print "<textarea name=\"description\" cols=\"30\" rows=\"5\">$description</textarea>"; 
            
        }
                    
        
        ?>
                        