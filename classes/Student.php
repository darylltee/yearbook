<?php

	
/**
 * Class for Student 
 */


class Student 
{
	public $db ;

	// student data  format
	//  firstname, middlename, lastname, student number, email, suffix, picture
	public $std_data =  array(
							"firstname"      => '',
							"middlename"    => '',
							"lastname"      => '',
							"student_number" => '',
							"email"			=> '',
							"suffix"		=> '',
							"picture"	    => ''
						);
	
	

	// Student Constructor
	public function __construct($is_new = false,$std_data = array())
	{


		$this->db = PDO_Mine::getInstance();

		//creation of new student
		if($is_new )
		{	

			
			
			$this->std_data = (object)$this->std_data;

			$this->std_data->firstname = $std_data['firstname'];
			$this->std_data->middlename = $std_data['middlename'];
			$this->std_data->lastname = $std_data['lastname'];
			$this->std_data->student_number = $std_data['student_no'];
			$this->std_data->email = $std_data['email'];
			$this->std_data->suffix = $std_data['suffix'];
			$this->std_data->picture = $std_data['picture'];


			
			$this->new_std();
			$this->insert_std_data();

		 	
		

		}



	}


	public function new_std()
	{
		// validate student data 
		
		//var_dump($this->std_data);

	}

	public function std_data_validate()
	{

	}

	public function insert_std_data()
	{
		$array_keys  =  array_keys((array)$this->std_data);
		$array_keys = $this->db->array_field_convertion($array_keys);
		$array_values = array_values((array)$this->std_data);
		$array_values = $this->db->array_data_convertion($array_values);
		

		$query = "INSERT INTO `student` ( $array_keys) VALUES ( $array_values) ";
		

		if($this->db->query($query))
		{
			echo "Inserted";
		}


	}

}

