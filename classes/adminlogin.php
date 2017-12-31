<?php
$filepath = realpath(dirname(__FILE__));
include ($filepath.'/../lib/session.php');
Session::checkLogin();
include_once ($filepath.'/../lib/database.php');
?>
<?php
class Adminlogin
{
	private $db;

	function __construct()
	{
		$this->db = new Database();
	}

	public function adminLogin($username,$password)
	{
		$username = mysqli_real_escape_string($this->db->link, $username);
		$password = mysqli_real_escape_string($this->db->link, $password);

		if(empty($username) or empty($password))
		{
			$loginmsg = "field must not empty";
			return $loginmsg;
		}
		else{
			$query = "SELECT * FROM  adminlogin WHERE 	username = '$username' AND 	password = '$password' ";
			$result = $this->db->select($query);
			if($result != false)
			{
				$value = $result->fetch_assoc();
				Session::set("adminLogin",true);
				Session::set("adminId",$value['id']);
				Session::set("adminName",$value['name']);
				Session::set("adminUser",$value['username']);
				header("Location:index.php");
			}
			else{
				$loginmsg = "dont match";
				return $loginmsg;
			}
		}
	}
}
?>