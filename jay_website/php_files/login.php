<?php
    $login_errors = array();
    
    if(preg_match('/^[a-zA-Z0-9_*?$%]{5,}$/', $_POST['user_id'])) { 
        
        $user_id = db_safe ($_POST['user_id'], $dbc);
        echo $user_id;
    
    } else {
        
        $login_errors['id'] = '<p>Please enter your userID!</p>';
    }

    if (!empty($_POST['password'])) {
        
        $pass = $_POST['password'];
        
    } else {
        
        $login_errors['password'] = '<p>Please enter a password!</p>';
    }


    if (empty($login_errors)) {
        
        $query = "SELECT `id`, `first_name`, `last_name`, `user_id`, `active`, `type` FROM `employee` WHERE `user_id`= '$user_id'";
        $query = mysqli_query($dbc, $query); 
        if(mysqli_num_rows($query) == 1) {
        $query = mysqli_fetch_array($query, MYSQLI_ASSOC); 
            
            if (/*password_verify($pass, $query['pass'])*/$user_id == $query['user_id']) {
            
            
                if ($query['type'] == 'admin') {
                    session_regenerate_id(true);
                    $_SESSION['user_admin'] = true;
                }
                
                $_SESSION['id'] = $query['id'];
                $_SESSION['user_id'] = $query['user_id'];
                $_SESSION['first_name'] = $query['first_name'];
                $_SESSION['active'] = $query['active'];
                if ($query['active'] == 'yes') $_SESSION['active'] = true;
                
                $location = BASE_URI_HTTPS .  'timeticket.php';
                header("Location: $location");
                exit();
                
                            
            } else {
                $login_errors['login'] = 'The password and/or userId you have entered do not match any employee! Please try again.';
            }
        } else {
                $login_errors['login'] = 'The password and/or userId you have entered do not match any employee! Please try again.';
            }
    }

    
        

    


