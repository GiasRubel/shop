<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';
/**
* 
*/
class Brand 
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db =	new Database();
		$this->fm =	new Format();
	}

	public function addbrnd($brandname)
	{
		$brandname = $this->fm->validation($brandname);
		$brandname = mysqli_real_escape_string($this->db->link, $brandname);
		if(empty($brandname))
		{
			$msg = "<span class='error'>Fill The Field</span>";
			return $msg;
		}
		else{
			$query = "INSERT INTO brand (brandname) VALUES ('$brandname')";
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

	public function getbrnd()
	{
		$query = "SELECT * FROM brand ORDER BY brandid DESC";
		$result = $this->db->select($query);
		if($result)
			return $result;
	}

	public function editbrnd($brandname,$id)
	{
		$brandname = $this->fm->validation($brandname);
		$brandname = mysqli_real_escape_string($this->db->link, $brandname);
		if(empty($brandname))
		{
			$msg = "<span class='error'>Fill The Field</span>";
			return $msg;
		}
		else{
		$query = "UPDATE brand SET brandname = '$brandname' WHERE brandid = '$id'";
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

	public function getbyid($id)
	{
		$query = "SELECT * FROM brand WHERE brandid = '$id'";
		$result = $this->db->select($query);
		if($result)
			return $result;
	}


	public function delbrnd($id)
	{
		$query = "DELETE FROM brand WHERE brandid = '$id'";
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
