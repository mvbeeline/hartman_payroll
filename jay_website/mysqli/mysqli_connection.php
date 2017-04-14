<?php

   /* define('HOST', 'mysql4.hostica.com');
    define('USER', 'GAS007_admin');
    define('PASSWORD', 'Ab2xxx');
    define('DB_NAME', 'GAS007_pics_for_sale'); */
    
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'hartman');
    

    $dbc = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);

    if (!$dbc)
        {
            die('Could not connect to the database host because:' . mysqli_error($dbc));
        }

    mysqli_set_charset($dbc, 'utf8');    