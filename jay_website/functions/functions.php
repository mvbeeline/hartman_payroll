<?php

function db_safe ($data, $dbc) {
        
        if(get_magic_quotes_gpc()) $data = stripslashes($data);
    
        return mysqli_real_escape_string($dbc, (trim(strip_tags($data))));
                
            
    } // end db_safe function

function sticky_form ($post) {
    
    if (isset ($_GET[$post])) {
        
        $value = $_GET[$post];
        $value = db_safe($value, $dbc);
        
        print " value=\"$value\" ";
    }
}

function check_cart($uid) { // function checks to see if there is anything in a cart
    
    $dbc = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);
    
    $qselect = "SELECT `sku` FROM `carts` WHERE `carts` . `user_session_id` = '$uid'";
    $q_select = mysqli_query($dbc, $qselect);
    $result = mysqli_num_rows($q_select);
    
    return $result; // returns number of items in a cart
    
}

function delete_cart ($uid) { // deletes cart by removing items from carts DB based on the user id
    
    $dbc = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);
    
    $qdelete = "DELETE FROM `carts` WHERE `user_session_id` = '$uid'";
    $qdelete = mysqli_query($dbc, $qdelete);
    
}


function insert_transactions ($o_id, $type, $amount, $response_code, $response_reason, $trans_id, $response) {
    
    // inserts information received from Authorize.net into the transactions table
    
    $dbc = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);
    
    
    $qinsert = "INSERT INTO `transactions`(`order_id`, `type`, `amount`, `response_code`, `response_reason`, `transaction_id`, `response`) VALUES ('$o_id','$type', '$amount',' $response_code',' $response_reason', '$trans_id', '$response')";
    
    $qinsert = mysqli_query($dbc, $qinsert);
    $c_id = (mysqli_insert_id($dbc));
    
    return $c_id;
    
    
}

function insert_customer ($email, $first_name, $last_name, $address, $city, $state, $zip, $phone) {
    
    // creates a new customer
    
    $dbc = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);
    
     $qinsert = "INSERT INTO `customers`(`email`, `first_name`, `last_name`, `address`, `city`, `state`, `zip`, `phone`) VALUES ('$email','$first_name','$last_name','$address','$city','$state','$zip','$phone')";
    
    $qinsert = mysqli_query($dbc, $qinsert);
    
    $c_id = (mysqli_insert_id($dbc));
    
    return $c_id;
    
}

function insert_order ($c_id, $total, $ship, $cc_n) {
    
    // creates a new order and returns the total cost of the order including shipping
    
    $dbc = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);
    
    $qinsert = "INSERT INTO `orders`(`customer_id`, `total`, `shipping`, `cc_number`) VALUES ('$c_id','$total', '$ship', '$cc_n')";
    
    $qinsert = mysqli_query($dbc, $qinsert);
    $order_id = (mysqli_insert_id($dbc));
    
    $query = "SELECT `total`, `shipping` FROM `orders` WHERE `orders` . `id` = '$order_id'";
    $queryselect = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($queryselect);
    
    $total = $row['total'];
    $shipping = $row['shipping'];
    
    $order_total = $total + $shipping;
    
    
    return array($order_id, $order_total);
    
}

function insert_order_contents ($order_id, $product_id, $qty, $order_date) {
    
    // inserts order items so the may be retrieved based on the order id and creates a totle price of that item
    
    $dbc = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);
    
    $price_id = substr($product_id,3 ,2);
    
    $qprice = "SELECT `price`,`frame_price`,`mat_price` FROM `size` WHERE `size` . `id` = '$price_id'";
    $qprice = mysqli_query($dbc, $qprice);
    $price_row = mysqli_fetch_array($qprice);
    
    $price = $price_row['price'];
    $frame_price = $price_row['frame_price'];
    $mat_price = $price_row['mat_price'];
    
    if (substr(product_id, 7,2) == '00') {
        $frame_price = 0;
        $mat_price = 0;
                
    } else {
        if (substr(product_id, 11,2) == '00') {
            $mat_price = 0;
            } 
    }
    
    $price_per = (($price + $frame_price + $mat_price) * $qty);
    
    
    $qinsert = "INSERT INTO `order_contents`(`order_id`, `product_id`, `quantity`, `price_per`) VALUES ('$order_id','$product_id','$qty','$prce_per')";
    
    $qinsert = mysqli_query($dbc, $qinsert);
    
}
    
   





function create_sku ($photo_id) {
    
    // creates a sku number by taking the information from "photo_build_query" and parsing the info together, this creates the ability t take apart the sku and know exactly what was ordered
       
     $dbc = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);

    if (!$dbc)
        {
            die('Could not connect to the database host because:' . mysqli_error($dbc));
        } 


    $queryselect = "SELECT `image`,`size`,`finish`,`frame_style`,`frame_color`,`mat_color_1` FROM `photo_build_query` WHERE `photo_build_query` . `id` = '$photo_id'";
                    
    $queryselect = mysqli_query($dbc, $queryselect);
    $row = mysqli_fetch_array($queryselect);
                        
        $image_id = stripslashes($row['image']);
        $size = stripslashes($row['size']);
        $finish = stripslashes($row['finish']);
        $frame = stripslashes($row['frame_style']);
        $frame_color = stripslashes($row['frame_color']);
        $mat_color_1 = stripslashes($row['mat_color_1']);
        
        
    if ($size != '00') {
        $sizeselect = "SELECT `id` FROM `size` WHERE `size` . `name` = '$size'";
        $sizeselect = mysqli_query($dbc, $sizeselect);
        $size = mysqli_fetch_array($sizeselect);
        
        $size_id = stripslashes($size['id']);
            
    } else { 
           $size_id = '00';
    }


    
    if ($finish != '00') {
        $finishselect = "SELECT `id` FROM `finish_photo` WHERE `finish_photo` . `name` = '$finish'";
        $finishselect = mysqli_query($dbc, $finishselect);
        $finish = mysqli_fetch_array($finishselect);
        
        $finish_id = stripslashes($finish['id']);
    
    } else { 
            $finish_id = '00';
    }
    
    
        
    if ($frame != '00') {
        $frameselect = "SELECT `id` FROM `frame_style` WHERE `frame_style` . `name` = '$frame'";
        $frameselect = mysqli_query($dbc, $frameselect);
        $frame = mysqli_fetch_array($frameselect);
        
        $frame_id = stripslashes($frame['id']);
     
    } else { 
            $frame_id = '00';
    }
        
    
    if ($frame_color != '00') {
        $frame_colorselect = "SELECT `id` FROM `frame_color` WHERE `frame_color` . `name` = '$frame_color'";
        $frame_colorselect = mysqli_query($dbc, $frame_colorselect);
        $frame_color = mysqli_fetch_array($frame_colorselect);
        
        $frame_color_id = stripslashes($frame_color['id']);
        
    } else { 
            $frame_color_id = '00';
    }

    
    if ($mat_color_1 != '00') {
        $mat_color_1select = "SELECT `id` FROM `matting_color` WHERE `matting_color` . `name` = '$mat_color_1'";
        $mat_color_1select = mysqli_query($dbc, $mat_color_1select);
        $mat_color_1 = mysqli_fetch_array($mat_color_1select);
        
        $mat_color_1_id = stripslashes($mat_color_1['id']);
        
    } else { 
            $mat_color_1_id = '00';
    }

    
    
            
    $sku = ("$image_id" . "$size_id" . "$finish_id" . "$frame_id" . "$frame_color_id" . "$mat_color_1_id");



    return $sku;
    
  }


function form_input($name, $type, $errors = array(), $values = 'POST', $options = array()) {
    
    // creates a sticky form input
    
	$value = false;

	
	if ($values == 'SESSION') {
		
		if (isset($_SESSION[$name])) $value = htmlspecialchars($_SESSION[$name], ENT_QUOTES, 'UTF-8');
		
	} elseif ($values == 'POST') {
		
		if (isset($_POST[$name])) $value = htmlspecialchars($_POST[$name], ENT_QUOTES, 'UTF-8');
		
		if ($value && get_magic_quotes_gpc()) $value = stripslashes($value);

	}

	
	if ( ($type == 'text') || ($type == 'password') ) { 
		
		
		echo '<input type="' . $type . '" name="' . $name . '" id="' . $name . '"';

		
		if ($value) echo ' value="' . $value . '"';

		
		if (!empty($options) && is_array($options)) {
			foreach ($options as $k => $v) {
				echo " $k=\"$v\"";
			}
		}
        
        	
		if (array_key_exists($name, $errors)) {
			echo 'class="error" /> <br /> <span class="error">' . $errors[$name] . '</span>';
		} else {
			echo ' />';		
		}
		
	} elseif ($type == 'select') { 
		
		if (($name == 'state') || ($name == 'cc_state')) { 
			
			$data = array('start' => ' ', 'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming');
			
		} elseif ($name == 'cc_exp_month') { 

			$data = array(0 => ' ', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',  'September', 'October', 'November', 'December');
			
		} elseif ($name == 'cc_exp_year') { 
			
			$data = array();
			$start = date('Y'); 
			for ($i = $start; $i <= $start + 6; $i++) { 
				$data[$i] = $i;
			}
			
		} 
		
		
		echo '<select name="' . $name  . '"';
	
		
		if (array_key_exists($name, $errors)) echo ' class="error"';

		
		echo '>';		
	
		
		foreach ($data as $k => $v) {
			echo "<option value=\"$k\"";
			
			
			if ($value == $k) echo ' selected="selected"';
			
			echo ">$v</option>\n";
			
		} 
	
		
		echo '</select>';
		
		
		if (array_key_exists($name, $errors)) {
			echo '<br /><span class="error">' . $errors[$name] . '</span>';
		}
		
	} elseif ($type == 'textarea') { 

		
		if (array_key_exists($name, $errors)) echo ' <span class="error">' . $errors[$name] . '</span><br />';

		
		echo '<textarea name="' . $name . '" id="' . $name . '" rows="5" cols="50"';

		
		if (array_key_exists($name, $errors)) {
			echo ' class="error">';
		} else {
			echo '>';		
		}

		
		if ($value) echo $value;

		
		echo '</textarea>';

	} 

}

function admin_form_input($name, $type, $errors = array(), $values = 'POST', $options = array()) {
    
    // creates a sticky form input just for the admin login
    
	$value = false;

	
	if ($values == 'SESSION') {
		
		if (isset($_SESSION[$name])) $value = htmlspecialchars($_SESSION[$name], ENT_QUOTES, 'UTF-8');
		
	} elseif ($values == 'POST') {
		
		if (isset($_POST[$name])) $value = htmlspecialchars($_POST[$name], ENT_QUOTES, 'UTF-8');
		
		if ($value && get_magic_quotes_gpc()) $value = stripslashes($value);

	}

	
	if ( ($type == 'text') || ($type == 'password') ) { 
		
		
		echo '<input type="' . $type . '" name="' . $name . '" id="' . $name . '"';

		
		if ($value) echo ' value="' . $value . '"';

		
		if (!empty($options) && is_array($options)) {
			foreach ($options as $k => $v) {
				echo " $k=\"$v\"";
			}
		}
        
        	
		if (array_key_exists($name, $errors)) {
			echo 'class="error" /> <span class="error">' . $errors[$name] . '</span>';
		} else {
			echo ' />';		
		}
		
	} 

}

function frame_rgb($frame_color) {
    $dbc = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);
    
    $queryselect = "SELECT `rgb` FROM `frame_color` WHERE `frame_color` . `name` = '$frame_color'";
                    
    $queryselect = mysqli_query($dbc, $queryselect);
    $row = mysqli_fetch_array($queryselect);
                        
    $frame_rgb = stripslashes($row['rgb']);
    return $frame_rgb;
}
?>