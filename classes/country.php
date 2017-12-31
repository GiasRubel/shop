<?php
$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
/**
* 
*/
class Country 
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db =	new Database();
		$this->fm =	new Format();
	}

	public function addcountry($country)
	{
		$country = $this->fm->validation($country);
		$country = mysqli_real_escape_string($this->db->link, $country);
		if(empty($country))
		{
			$msg = "<span class='error'>Fill The Field</span>";
			return $msg;
		}
		else{
			$query = "INSERT INTO country (name) VALUES ('$country')";
			$result = $this->db->insert($query);
			if($result != false)
			{
				$msg = "<span class='success'>Data inserted</span>";
				return $msg;
			}
			else{
				$msg = "<span class='error'>Data not inserted</span>";
				return $msg;
			}
		}
	}

	public function getcountry()
	{
		$query = "SELECT * FROM country ORDER BY id DESC";
		$result = $this->db->select($query);
		if($result)
			return $result;
	}

	public function editcountry($country,$id)
	{
		$country = $this->fm->validation($country);
		$country = mysqli_real_escape_string($this->db->link, $country);
		if(empty($country))
		{
			$msg = "<span class='error'>Fill The Field</span>";
			return $msg;
		}
		else{
		$query = "UPDATE country SET name = '$country' WHERE id = '$id'";
		$result = $this->db->update($query);
			if($result)
			{
				$msg = "<span class='success'>Data updateds</span>";
				return $msg;
			}
			else{
				$msg = "<span class='error'>Data not updated</span>";
				return $msg;
			}
		}
	}

	public function countrybyid($id)
	{
		$query = "SELECT * FROM country WHERE id = '$id'";
		$result = $this->db->select($query);
		if($result)
			return $result;
	}


	public function delcountry($id)
	{
		$query = "DELETE FROM country WHERE id = '$id'";
		$result = $this->db->delete($query);
			if($result != false)
			{
				$msg = "<span class='success'>Data deleteds</span>";
				return $msg;
			}
			else{
				$msg = "<span class='error'>Data not deleted</span>";
				return $msg;
			}
	}


}
