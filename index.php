<html>
	<head>
		
		<link rel = "stylesheet" href = "css_core/materialize.min.css" media="screen,projection"> 
		<link rel = "stylesheet" href = "css_core/yearbook.css" media="screen,projection"> 
		<link rel = "stylesheet" href = "css_core/css.css"> 
    
    <meta name= 'description' content='Ateneo De Naga Yearbook'>
    <meta name='keywords' content='Ateneo Yearbook '>
    <meta name='author' content='mine'>
    <meta charset='UTF-8'>

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/> 
    <title>ADNU Yearbook</title>
	</head>

<body >
	


<?php

	/**
	 *   This software is developed by request. 
	 *    
	 *    
	 *
	 *
	 * 
	 */



	include_once("core/init.php");

	$db = PDO_Mine::getInstance();
?>



<div class = "container"  id = "container-main"	>
	

	<?php 

	
	 //include_once("layouts/login.php"); 
  include("home.php");




	?>






</div>
<br><br>









		







</body>
<script src = "js_core/jquery-2.1.1.min.js"></script>	
<script src = "js_core/materialize.min.js"></script>
<script src = "js_core/main.js"></script>
</html>