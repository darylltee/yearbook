
<br><br><br>
<div id = "form_login valign-wrapper" class = " row "  >

	<div class = "col s12 m6  card-panel z-depth-1 "> 


		<div class = " card-panel " id = "handle" style = 'background:#369;'>  <span class="white-text text-darken-2">Login</span></div>
		

		<form method = "POST" action = "login_auth" class = "" >
			
			<label for = "username" class = " ">  <i class="material-icons dp48">assignment_ind</i> Username 
				<input type = "text" name = "username" id = "username" placeholder = "eg. firstname.lastname" required>
			</label>
				
			<label for = "password" class = " "> <i class="material-icons dp48">lock</i> Password
				<input type = "password" name = "password" id = "password" placeholder = "***********" required>
			</label>
	
			<br>

			
				<input type="hidden" name="token"  value = '<?php //echo Token::generate();?>'>
				<span  >
					<span class="left">
						<?php
							$valid_login = (isset($_GET['login_attempt']) && !empty($_GET['login_attempt'])) ? true : false;

							if($valid_login)
								echo "<span > Invalid username or password </span>";
							else
								//nothing

						?>



					</span>
					<input type = "submit" name = "login_user" value = "Login" class = 'right '>
					
				</span>
				<br>
				
			
			

		</form>
	
	</div>
	

	<div class="col s12 m1"><br></div>

	<div class = "col s12 m5  relative"> 
		<h2>ADNU Yearbook!<span class = 'badge align-right yellow darken-2  relative'>BETA</span></h2>
		

		<span class = " blue-grey-text lighten-5 col s12 m12 offset-m1">
			Web application develop for automated transaction of students Yearbook and etc....
		</span>
		
		


	</div>


	

</div>


<?php include_once("layouts/footer.html"); ?>