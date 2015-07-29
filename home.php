

<br>
<style>
	body
	{
		background: #f1f1f1 !important;
	}
</style>

<?php 
	include_once("layouts/home_header.php");
?>

<div class="row relative" id = "main_home" style = 'margin-bottom:-10px !important;'>
	<div  class="s12 m12 card-panel page-height z-depth-2 ">
		
		<?php
			$action = $_GET['adnu_action'];

			if($action == "add_entry")
			{
				include_once("layouts/add_entry.php");
			}



		?>



	</div>
</div>

<span class="ft_size_3 ft_grey">
	 2015 © <i class ='blue-text'><b>fp</b></i> ANDU Yearbook 
</span>



