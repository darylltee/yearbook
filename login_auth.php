<?php
	

	// for temporary login
		
	include_once("core/init.php");

	if(Input::get("username") &&  Input::get("password"))
	{

		$username = Input::get("username");
		$password = Input::get("password");


		$db = PDO_Mine::getInstance();

		$data = $db->query("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' ")->results();

		if($data)
		{
			// check the user and redirect 


			header("location:admin_home.php");
		}
		else
		{
			header("location:index.php?login_attempt=>");
			echo "Invalid username/password";
		}




	}






?>