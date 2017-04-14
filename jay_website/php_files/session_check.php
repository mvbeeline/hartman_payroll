<?php 
    if (!isset ($_SESSION['user_id'])) {
    
            $location = BASE_URI_HTTPS .  'index.php';
            header("Location: $location");
            exit();   
        
    }
?>