<?php
require_once 'Constant.php';
require_once 'DbConnect.php';


class DbOperation
{
	private $conn;

	function __construct()
	{
		$db = new DbConnect ();
		$this->conn = $db->connect ();
	}

	public function createUser($username,$dob,$gender,$address,$email,$contactno,$cast,$pass,$confirmpassword)
	{

		if(!$this->isUserExits($email))
		{

			$password=md5($pass);
			$stmt=$this->conn->prepare("INSERT INTO users(username,dob,gender,address,email,contactno,cast,password) VALUES (?,?,?,?,?,?,?,?)");
			$stmt->bind_param("ssssssss",$username,$dob,$gender,$address,$email,$contactno,$cast,$password);
			$result=$stmt->execute();

			$stmt->close();
			//echo json_encode($result);

			if($result)
			{
				return 1;//means user created successfully
			}
			else
			{
				return 0; //error while registering user
			}
		}
		else
		{
			return 2;//user already exits
		}
	}

	private function isUserExits($email)
	{

		$stmt=$this->conn->prepare("SELECT id FROM driver WHERE mobile=? AND adhaar=?");
		$stmt->bind_param("ss",$mobile,$adhaar);
		$stmt->execute();
		$stmt->store_result ();

		if ($stmt->num_rows > 0) 
		{
			// user exists
			return true;
		} 
		else 
		{
			// user does not exist
			return false;
		}
		$stmt->close ();
	}

	public function userLogin($email,$pass)
	{
		$password=md5($pass);
		$stmt=$this->conn->prepare("SELECT id,username,password FROM users WHERE email=?");
		$stmt->bind_param("s",$email);
		$stmt->execute();
		//$stmt->store_result ();
		$user_data = $stmt->get_result()->fetch_assoc();
		#echo $userid;
		//echo json_encode($user_data);
		if ($user_data["password"]==$password) 
		{
			// login success
			return 1;
		} 
		else 
		{
			// user not registered
			return 0;
		}
		$stmt->close ();

	}
}