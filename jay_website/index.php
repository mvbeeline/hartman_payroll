<?php

    include("php_files/config.php");
    include("mysqli/mysqli_connection.php");
    include("functions/functions.php"); 
    
    $_SESSION = array();
    session_destroy(); 

    session_start(); ?>


    <?php
        if (isset($_POST['forgot_password']))  {
        
            if (isset($_POST['user_id'])) {
                    $_SESSION['user_id'] = $_POST['user_id'];
            
            $location = BASE_URI_HTTPS .  'forgot.php';
            header("Location: $location");
            exit();
            }
            
           if (isset($_POST['password'])) {
                
                echo $_POST['password'];
            } 
        } 
    
        if (isset($_POST['user_id'])) {
            
            echo $_POST['user_id'];
            
            include("php_files/login.php");
        }

?>



    <?php include("html/header.html"); ?>

    <?php include("php_files/index_body.php"); ?>

    <?php include("html/footer.html"); ?>