<?php
$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

/**
* 
*/
class Catagory 
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db =	new Database();
		$this->fm =	new Format();
	}

	public function addcat($catName)
	{
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		if(empty($catName))
		{
			$msg = "<span class='error'>Fill The Field</span>";
			return $msg;
		}
		else{
			$query = "INSERT INTO catagory (catName) VALUES ('$catName')";
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

	public function getcat()
	{
		$query = "SELECT * FROM catagory ORDER BY catId DESC";
		$result = $this->db->select($query);
		if($result)
			return $result;
	}

	public function editcat($catName,$id)
	{
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		if(empty($catName))
		{
			$msg = "<span class='error'>Fill The Field</span>";
			return $msg;
		}
		else{
		$query = "UPDATE catagory SET catName = '$catName' WHERE catId = '$id'";
		$result = $this->db->update($query);
			if($result != false)
			{
				$msg = "<span class='success'>Data updated</span>";
				return $msg;
			}
			else{
				$msg = "<span class='error'>Data not updated</span>";
				return $msg;
			}
		}
	}

	public function getbyid($id)
	{
		$query = "SELECT * FROM catagory WHERE catId = '$id'";
		$result = $this->db->select($query);
		if($result)
			return $result;
	}

	public function getAllCat()
	{
		$query = "SELECT * FROM catagory ORDER BY catId DESC LIMIT 10";
		$result = $this->db->select($query);
		if($result)
			return $result;
	}
	public function delcat($id)
	{
		$query = "DELETE FROM catagory WHERE catId = '$id'";
		$result = $this->db->delete($query);
			if($result != false)
			{
				$msg = "<span class='success'>Data deleted</span>";
				return $msg;
			}
			else{
				$msg = "<span class='error'>Data not deleted</span>";
				return $msg;
			}
	}


}
