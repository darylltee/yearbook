<div class="pd-a-10 ">
	
	<form action="" method="post" >
		
		<h5 class='bk-header'>Student Data Entry</h5>
			<br><br>
			<div class="col s12 m8">
					<label for = "name"> Name: </label>


					<div class="row">
						<div class="col s12 m4 input-field">
							<input type = "text" class = 'summary-field validate' name = "firstname" id = "firstname"  data-dst = 'dst_fname' required>
							<label for = "student_id"> Firstname </label>
						</div>
						<div class="col s12 m4 input-field">
							<input type = "text" name = "middlename" id = "middlename" class = 'summary-field validate' data-dst = 'dst_mname'  required>
							<label for = "student_id"> Middlename </label>
						</div>
						<div class="col s12 m4 input-field">
							<input type = "text" name = "lastname" id = "lastname"  class = 'summary-field validate' data-dst = 'dst_lname'  required>
							<label for = "student_id"> Lastname </label>

						</div>

					</div>
					
					<div class="row">
						<div class="col s12 m6 ">
							 <label for = 'gender'>Gender : </label>
							 <br>		
						  	 <input name="group1" type="radio" id="gender1" value = "Male" class ='summary-field' data-dst = 'dst_gender'/>
      						 <label for="gender1">Male</label>
							<br>
      						<input name="group1" type="radio" id="gender2" value = "Female" class ='summary-field' data-dst = 'dst_gender'/>
      						<label for="gender2">Female</label>
							  
						</div>

						<div class="col s12 m6 input-field">
							<label for = "student_id"> Student ID No. </label>
							<input type = "text" name = "search_student_number" class = 'summary-field' data-dst='dst_student_no' id = "search_student_number">
						</div>



					</div>


				
					<div class="row">
						<div class="col s12 m6 ">
							 <label for = 'gender' data-error = 'Invalid Input' data-success = "OK">College and Email</label>	
						    <select id = 'college' name = 'college' class = 'browser-default validate summary-field' data-dst = 'dst_college' required>
						      <option value="" >Select College</option>
						      <option value="M">Male </option>
						      <option value="F">Female	</option>
						      
						    </select>
						   
							  
						</div>

						<div class="col s12 m6 input-field">
							<input type="email" name = "email" id = "email" class = 'summary-field validate' data-dst = 'dst_email' placeholder = "someone@email.com">
							<label for="email" data-error="Invalid e-mail" data-success = 'OK' class ='right'></label>
						</div>

						

					</div>


					<div class="file-field input-field">
				      <input class="file-path validate" type="text"/>
				      <div class="btn">
				        <span>File</span>
				        <input type="file" />
				      </div>
				    </div>
					
					<br>
					


					<button class="btn waves-effect waves-light right" type="submit" name="action">Submit
					    <i class="material-icons">send</i>
					  </button>
					

			</div>
			
			<div class="col s1 m1">
				<br>
			</div>

			<div class="col s12 m3 right">
				
				<h6 class = 'vertical-align  '><span class="badge ">Student Summary</span></h6><br>
				<div class="row ">
					<div class="col s12 m6 right ">
						<img src="image_core/resources/avatar.png" class = 'circle right responsive-img'alt="Profile Image">
					</div>
				</div>
				<div class="row">
					<div class="col s12 m3 ft_size_7">
						Name: 
					</div>
					<div class="col s4 m3 ft_size_7 ">

						<span id="dst_fname">
					
						</span>
					</div>
					<div class="col s4 m3 ft_size_7  ">
						<span id="dst_mname">
					
						</span>

					</div>
					<div class="col s4 m3 ft_size_7 ">
						<span id="dst_lname" class ='truncate'>
					
						</span>

					</div>
				</div>

				<div class="row">
					<div class="col s12 m6">Student No.</div>
					<div class="col s12 m6">
						<span id="dst_student_no" class ='truncate'>
					
						</span>
					</div>
				</div>

				<div class="row">
					<div class="col s12 m6">E-mail</div>
					<div class="col s12 m6">
						<span id="dst_email" class ='truncate'>
					
						</span>
					</div>
				</div>

				<div class="row">
					<div class="col s12 m6">College</div>
					<div class="col s12 m6">
						<span id="dst_college" class ="truncate">
					
						</span>
					</div>
				</div>

				<div class="row">
					<div class="col s12 m6">Gender</div>
					<div class="col s12 m6">
						<span id="dst_gender">
					
						</span>
					</div>
				</div>

				
				
			</div>

	</form>


</div>