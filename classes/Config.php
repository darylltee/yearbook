<?php
	
	
	// medyo nalibong ako :)
	
	// used for array with two or more dimensions.
	/* given that it loops until the given string is 
	   found in the array.

	   the string is represented as 
	   firstdimension/seconddimension/etc
		
	   the string is converted into an array
	   using the explode function

	   then the loop checks for the sting availability
	   and return the value of the array if it is found
	   else it returns an error

	   Mine ^^ 2:48 	02/14/14

	*/

	class Config{
			
			public static function get($path = null,$array = null)
			{


					if($path)
					{
						if($array === null) $config = $GLOBALS['config'];
						else $config = $array;
						
						$path = explode('/',$path);
						
						foreach($path as $bit){
							if(isset($config[$bit]))
								{
									$config = $config[$bit];
								}
							else{
									return false;
							}
						}
						
						return $config;
						
					}
				
			}
		
		
	}






?>