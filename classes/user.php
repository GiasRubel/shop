<?php

$filepath = realpath(dirname(__FILE__));
// include ($filepath.'/../lib/session.php');
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');


/**
* 
*/
class User
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function adduser($data)
	{
		$name     = mysqli_real_escape_string($this->db->link, $data['name']);
		$adress   = mysqli_real_escape_string($this->db->link, $data['adress']);
		$city     = mysqli_real_escape_string($this->db->link, $data['city']);
		$country  = mysqli_real_escape_string($this->db->link, $data['country']);
		$phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email    = mysqli_real_escape_string($this->db->link, $data['emial']);
		$zip      = mysqli_real_escape_string($this->db->link, $data['zip']);
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

		$query = "SELECT * FROM user WHERE email = '$email'";
		$result = $this->db->select($query);
		if ($result) {
			$msg = "<span class='error'>email already exist</span>";
			return $msg;
		}

		elseif (empty($name) or empty($adress) or empty($city) or empty($country) or empty($phone) or empty($email) or empty($zip) or empty($password)) 
		{
			 $msg = "<span class='error'>Fill The Field</span>";
			return $msg;
		}
		else{
			$query = "INSERT INTO user(name,adress,city,country,phone,email,zip,password)
			VALUES('$name', '$adress', '$city', $country, '$phone', '$email', $zip, '$password')";
			$result = $this->db->insert($query);
			if($result != false)
			{
				$msg = "<span class='success'>Data Inserted</span>";
				return $msg;
			}
			else{
				$msg = "<span class='success'>Data Not Inserted</span>";
				return $msg;
			}
		}
		
		
	}


	public function logUser($name,$password)
	{
		$name = mysqli_real_escape_string($this->db->link, $name);
		$password = mysqli_real_escape_string($this->db->link, md5($password));

		if (empty($name) or empty($password)) {
			$msg = "<span class='error'>Fill The Field</span>";
			return $msg;
		}

		else{

			$query = "SELECT * FROM user WHERE name='$name' AND password='$password' ";
			$result = $this->db->select($query);
			if($result != false)
			{
				$value = $result->fetch_assoc();
				session::set("userLogin", TRUE);
				session::set("userId", $value["id"]);
				session::set("userName", $value["name"]);
				header("Location:index.php");
				// $msg = "<span class='error'>Does  match</span>";
				// return $msg;
			}
			else{
				
			}
		}
	}

	public function getUser($id)
	{
		$query = "SELECT u.*, c.name as cname FROM  user as u, country as c 
		WHERE u.country = c.id AND u.id = $id";
		$result = $this->db->select($query);
		if($result)
			return $result;
	}

	public function destroy()
	{
		 session_destroy();
  header("Location:index.php");
	}






}