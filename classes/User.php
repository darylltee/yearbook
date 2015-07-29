<?php
	
/**
 *  CLASS User 
 *  	/ includes all general function for users
 *  	/ e.g. login , create and etc
 *  	
 */


class User
{
	//***********************
	// variable declarations
		public $db,
				$data,
				$session_name,
				$cookie_name,
				$is_logged_in,
				$is_validated,
				$user_type,
				$user_id,
				$user_identifier;

	// define user types
	public $user_types = array
						 (
						 	0 => "admin",
						 	1 => "faculty",
						 	2 => "student",
						 	99 => "it"
						 );
	//***********************


	// -- CONSTRUCTOR
	public function __construct( $user = null)
	{

		// initialize the Database Handler class
		$this->db = PDO_Mine::getInstance();

		// get the names for session and cookie 
		$this->session_name = Config::get('session/session_name');
		$this->cookie_name  = Config::get('remember/cookie_name');



		// check if the user is has the same token
		
		
		if(Cookie::exists(Config::get('remember/cookie_name')))
		{

			if($session_data = $this->db->get('user_sessions',array('hash','=',Cookie::get(Config::get('remember/cookie_name'))))->first())
			{
				$this->is_validated = true;
				
				if($session_data->user_type != "student")
				{
					$acc_data = $this->db->get('admin_accounts',array('admin_account_id','=',$session_data->user_id))->first();
				}else
				{
					$acc_data = $this->db->get('student_accounts',array('student_id','=',$session_data->user_id))->first();
				}

				if(isset($acc_data))
				{
					if($this->find($acc_data->username))
					{
						$this->is_logged_in = true;
					}
					else
					{
						$this->is_logged_in = false;
					}
				}
				else
				{
					include_once("login.php");
				}

				
			}
			else
				$this->is_validated = false;
		}else
		{
			$this->is_validated = false;
		}
	}


	/**
	 * @param $fields an array
	 * function to create a certain user
	 */
	public function create($fields = array(), $user_type = null,$table = 'student_accounts')
	{	
		
		if(!$this->db->insert($table,$fields))
			throw new Exception('There was a problem creating the user');
	}


	/**
	 * @param [String] [username] []
	 * function to identify a certain user
	 */
	public function identify_user($username)
	{
		if(!empty($username))
		{
			if($temp = $this->db->get('student_accounts', array("username","=",$username))->count())
			{
				$this->user_identifier = "student_id";
				$this->user_type_no = 2;
				return "student";
			}
			else if($this->db->get('admin_accounts', array("username", "=", $username))->count())
			{
				$temp = $this->db->get('admin_accounts', array("username", "=", $username));
				$this->user_identifier = "admin_account_id";
				if($temp->first()->user_type == 1)
				{
					$this->user_type_no = 1;
					return "faculty";
				}
				else if($temp->first()->user_type == 0)
				{
					$this->user_type_no = 0;
					return "faculty";
				}

				// suppose to be admin has an account details

			}
			else
				return false;
		}

	}

	/**
	 * a static function to identify if the user is a faculty or not
	 * @param  [String] $username [description]
	 * @return [type]           [description]
	 */
	public static function validate_user($username)
	{
		if(!empty($username))
		{
			$db = PDO_Mine::getInstance();
			if($db->get('student_accounts', array("username","=",$username))->count())
				return new Student();
			else if($temp_user = $db->get('admin_accounts', array("username", "=", $username)))
			{
				$temp_user = $temp_user->first();
				if($temp_user->user_type == 1)
					return new Faculty();
				else if($temp_user->user_type == 0)
					return new Admin();
				else
					// fallback procedure in case a typecase error in the database occur
					echo "";
			}
			else
				return false;
		}
	}

	/**
	 * @param [String] [username] 
	 * function to find the user if it is in the database
	 */
	
	public function find($username)
	{
		if(!empty($username))
		{

			$user_type = $this->identify_user($username);

			if($user_type)
			{
				$this->user_type = $user_type;
				$data = $this->db->get(Config::get("db_tables/$user_type"),array("username",'=',$username));

				if($data->count())
				{
					$this->data = $data->first();
					return true;
				}

			}

		}
		return false;
	}


	/**
	 * function to get all the data from the user
	 * 	/ but the user must be logged in
	 */
	
	public function data()
	{
		if(!empty($this->data))
			return $this->data;
		else
		{

			if($this->user_type_no == 2)
			{
				
				$this->data = $this->db->get("student_accounts",array("student_id","=",$this->student_data()->student_id))->first();
				
				if(empty($this->data))
					return false;
				else
					return $this->data;
			}	

			else if($this->user_type_no == 1)
			{

				if($this->data = $this->db->get("admin_accounts",array("ad_user_id","=",$this->instructor_data()->instructor_id)))
				{
					$this->data = $this->data->first();
				
					return $this->data;
				}
				if(empty($this->data))
					return false;
			}
			else if($this->user_type_no == 0)
			{

				if($this->data = $this->db->get("admin_accounts",array("ad_user_id","=",$this->instructor_data()->instructor_id)))
				{
					$this->data = $this->data->first();
					return $this->data;
				}
				if(empty($this->data))
					return false;
			}		
			
		}
	}

	/**
	 * most complex part of the Class
	 *  /login requires several Class dependency 
	 *  	- Session 
	 *  	- Cookie
	 *  	- Hash
	 *  	- Database Handler
	 *
	 * @param [String] [username] 
	 * @param [String] [password] 
	 * @param [Boolean] [remember]
	 */

	public function login($username = null, $password = null, $remember = false, $id_name = 'student_id')
	{

		// first check if the username is in the database
		$user = $this->find($username);

		if($user)
		{

			
			// validate if the password matches the password in the database
			if($this->data()->password == Hash::make($password,$this->data()->salt))
			{
				

				if(!Cookie::exists(Config::get("remember/cookie_name")) 
					&& $this->db->get('user_sessions',array('user_id','=',$this->data()->{$this->user_identifier}))->count())
				{
						$this->db->delete('user_sessions',array('user_id','=',$this->data()->{$this->user_identifier}));
				}

				$hash = Hash::make($this->data()->username,date('Y-m-d H:i:s'));

				// create a cookie for the user session
				//Cookie::put(Config::get('remember/cookie_name'),$this->data()->{$this->user_identifier}, Config::get('remember/cookie_expiry'));
				Cookie::put(Config::get('remember/cookie_name'),$hash, Config::get('remember/cookie_expiry'));

				$this->db->insert
				(
					'user_sessions',
					array
					(
						"user_type" => $this->user_type,
						"user_id"	=> $this->data()->{$this->user_identifier},
						"login_datetime" => date('Y-m-d H:i:s'),
						"hash"		=> $hash
					)
				);

				
				// get the user_id
				$this->user_id = $this->data()->{$this->user_identifier};
				
				// get the user type number
				$user_type = $this->user_type_no;

				//Session::put($this->session_name, $this->data()->$id_name);

				// insert a record of user session
				
				$log = new Log(false,array("user_id"=>$this->user_id,"user_type"=>$user_type));
				$log->log("Login","You have logged in ");
				
				$this->is_logged_in = true;

				

				return true;
			}

		}

		return false;
	}

	public function class_name()
	{
		echo __CLASS__;
	}
	/**
	 * [is_logged_in description]
	 * @return boolean [description]
	 */
	public function is_logged_in()
	{
		return $this->is_logged_in;
	}


	public function logout()
	{
		Cookie::delete($this->cookie_name);
		Session::delete($this->session_name);
		$this->db->delete('user_sessions',array('user_id','=',$this->data()->{$this->user_identifier}));
		
	}


	public function user_type($user_id)
	{
		if(!empty($user_id))
		{
			foreach ($this->user_types as $key => $value)
			{
				if($key == $user_id)
				{
					return $value;
				}
			}
		}

		return false;
	}

	public function my_logs()
	{
		
		if( $this->user_type_no == 1)
			$user_id = $this->data()->ad_user_id;
		else if($this->user_type_no == 2)
			$user_id = $this->data()->{$this->user_identifier};

		$query = "SELECT * FROM `logs` WHERE `user_id` = $user_id ORDER BY `log_date` DESC LIMIT 15";
		
		if($my_logs = $this->db->query($query))
		{

			$my_logs = $my_logs->results();
			
			if(!empty($my_logs))
				return $my_logs;
		}

		return false;
	}

	public function pass_reset_code()
	{

		$reset_code = substr(md5(uniqid(mt_rand(), true)) , 0, 8);

		if(!empty($reset_code))
		{
			return $reset_code;
		}

		return false;
	}

}