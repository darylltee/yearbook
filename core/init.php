<?php

	// holds almost all the important classes and functions 

	
	session_start();
	define('yearbook_code', true);
	date_default_timezone_set('Asia/Manila');
	
	// three dimensional array

	//ex. array[ array[ array[], array[] ], array[ array[], array[] ]];

	$GLOBALS['config'] = array(
	
				// #######################################
				// # SET UP THE DATABASE PARAMETERS	     #
				// #######################################
				
				'mysql' => array(
						'host' => '127.0.0.1',
						'username' => 'root',
						'password' => '',
						'db' => 'yearbook',
						'default' => ':var'
				),
				
				// #############################################
				// # SET UP HOW LONG THE USER TO BE REMEBERED  #
				// #############################################
				
				'remember' => array(
						'cookie_name' => 'user_id',
						'cookie_expiry' => 604800,
				),
				
				// #######################################
				// #          SET UP THE USERS        	 #
				// #######################################
			
				'session' => array(
						'session_name' => 'user_id',
						'token_name' => 'token'
				),

				

				// #######################################
				// #         HTML Configurations         #
				// #######################################


				'head' => array(
						'meta_config' => "  <meta name= 'description' content=''>
											<meta name='keywords' content='Ateneo Yearbook '>
											<meta name='author' content='mine'>
											<meta charset='UTF-8'> "
				)
	);
	

// spl = standard php library

//#################################################################################
	/*
	/ SET NEEDED functions and classes 
	*/

	spl_autoload_register(function($class){

			if(stristr($class,"PHPExcel_"))
			{
				$dir = "";
				while($pos = stripos($class, "_"))
				{
				
					$to_add = substr($class, 0, $pos)."/";
					$new = substr($class,$pos + 1);
					$dir .= $to_add;
					$class = $new;
					
				}
				
				$class = str_ireplace("PHPExcel_", "", $class);
				require_once set_function_location('Class/'.$dir . '/'. $class . '.php');
				
			}
			else
			{
				require_once set_function_location('classes/' . $class . '.php');
			}
			
			
	});
		
	require_once set_function_location('functions_core/sanitize.php');

	//require_once set_function_location('database_relationships.php');

//#################################################################################



/*
 * Provide a more flexible function to get location of the other php files using include
 * @PARAMETERS "file_location"
 * limits / not tested in the online web server .
 * 		  / bugs must be met to ensure good output
 */


function set_function_location($file_location){

	$append_location = null;
	$new_location = null;

	$server_self = substr($_SERVER['REQUEST_URI'],1);
	$pos = substr_count($server_self,"/") ;

	if($pos){
		for($i = 0; $i < $pos - 1; $i++)
		{
			$append_location .= '../';
		}

		$new_location = $append_location.$file_location;

		
		return $new_location;
	}

}

?> 