<?php 

    date_default_timezone_set('America/New_York');
    
    $ts = time();
    $ts_start = mktime(0, 0, 0, 1, 1, 2017);
    
    $current_pay_period = ceil((($ts - $ts_start) / 1209600));
    $current_pay_week = ceil((($ts - $ts_start) / 604800));


    define('CURRENT_PAY_PERIOD', $current_pay_period);
    define('CURRENT_PAY_WEEK', $current_pay_week);

    define('CONTACT_EMAIL', 'garyscheller@yahoo.com');

    define('BASE_URI_HTTP' , 'http://localhost/jay_website/');
    define('BASE_URI_HTTPS' , 'http://localhost/jay_website/');
    //define('BASE_URI_HTTPS' , 'https://garyscheller.hostica.com/');
    //define('BASE_URI_HTTP' , 'http://garyscheller.hostica.com/'); 

    /* define("AUTHORIZENET_API_LOGIN_ID", "43Qqxw9C63");
    define("AUTHORIZENET_TRANSACTION_KEY", "3W2G99AC3fP4q4fB");
    define("AUTHORIZENET_SANDBOX", true); */
    
    session_start();    

   // error handling while in development
    ini_set ('display_errors', 1);
    error_reporting (E_ALL | E_STRICT); 

  //  use this script when site is live

    /*function system_problem($error, $message, $file, $line, $variables) {

	// error message:
	$note = "A problem happened in script '$file' on line $line:\n$message\n";
	
	// backtrace:
	$note .= "<pre>" .print_r(debug_backtrace(), 1) . "</pre>\n";
	
	
	
        // Send the problem in an email:
        error_log ($note, 1, CONTACT_EMAIL, 'From:photos@garyscheller.com');
		
        
        if ($error != E_NOTICE) { // if the problem is not a notice print this on screen
			echo '<div class="sticky_error">A problem has occured, we will fix the problem ASAP. Please try again soon.</div>';
		}

	
	
	return true; // So that PHP doesn't try to handle the error, too.

} 
set_error_handler('system_problem'); */