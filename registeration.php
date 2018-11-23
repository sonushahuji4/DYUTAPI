<?php
require_once 'DbOperation.php';

$response = array ();

$username=$_POST['username'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$address=$_POST['address'];
$email=$_POST['email'];
$contactno=$_POST['contactno'];
$cast=$_POST['cast'];
$password=$_POST['password'];
$confirmpassword=$_POST['confirmpassword'];


$db= new DbOperation();

			$new_user=$db->createUser($username,$dob,$gender,$address,$email,$contactno,$cast,$password,$confirmpassword);
			if($new_user==1)
			{
				$response['code']=false;
				$response['status']="user registered sucessfully";
				
			}
			else if($new_user==0)
			{
				$response['code']=true;
				$response['status']="error while registering user";
			}
			else if($new_user==2)
			{
				$response['code']=true;
				$response['status']="user already exits";
			}

			echo json_encode($response)

?>