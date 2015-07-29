<?php


	// function to sanitize string 

		function escape($raw_input) { 
    		return htmlspecialchars($raw_input, ENT_QUOTES | ENT_HTML401, 'UTF-8');     // important! don't forget to specify ENT_QUOTES and the correct encoding 
		}

	// function to get the current url
		function url($url_to)
		{
			$var_pos = strpos($url_to,"=");

			$value = substr($url_to, $var_pos + 1);

			

			$var = substr($url_to, 0, $var_pos );



			$var_length = strlen($var) + 1;

			$url = $_SERVER['REQUEST_URI'];

			$exists = strpos($url, $var);

			$pos  = strpos($url, "?");


			$current_url = substr($url, $pos);
			

//?fc_action=grading_sheet&gid=268&stid=3072
//?fc_action=grading_sheet&gid=268
			
			if(!empty($exists) && $url_var_pos = strpos($current_url, $var) + $var_length)
			{
				
				$final_pos =  $url_var_pos ;
				

				$url = substr($current_url, 0,$final_pos) . $value;
				//echo $url;
				return $url;

			}else
			{
				
				return $current_url ."&". $url_to;
			}

			
		}
	//?fc_action=grading_sheet&gid=268

?>