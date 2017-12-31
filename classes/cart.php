<?php

$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

class Cart 
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db =	new Database();
		$this->fm =	new Format();
	}

	public function cartInsert($quantity,$id)
	{
		 $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
		 $productId = mysqli_real_escape_string($this->db->link,$id);
		 $sId       = session_id();

		$nquery = "SELECT * FROM tbl_product WHERE productId = '$productId' ";
		$result = $this->db->select($nquery)->fetch_assoc();

		$productId   = $result['productId'];
		$productName = $result['productName'];
		$price       = $result['price'];
		$image       = $result['image'];

		$newq ="SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId' ";
		$nresult = $this->db->select($newq);
		if($nresult)
		{
			$msg = "<span style='color:red;'>Already added to cart</span>";
				return $msg;
		}
		elseif ($quantity<0) {
			$msg = "<span style='color:red;'>Not allowed</span>";
				return $msg;
		}
		else{
		$query = "INSERT INTO tbl_cart (sId,productId,productName,price,quantity,image) VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
		$result = $this->db->insert($query);
		if($result != false)
		{
			header('Location:cart.php');
		}
		else{
			header('Location:404.php');
		}
	  }
	}

	public function getcart()
	{
		$query = "SELECT * FROM tbl_cart ORDER BY cartId";
		$result = $this->db->select($query);
		return $result;
	}


	public function updatecart($cartId,$quantity)
	{
		$cartId    = mysqli_real_escape_string($this->db->link,$cartId);
		$quantity  = mysqli_real_escape_string($this->db->link, $quantity);

		$query = " UPDATE tbl_cart SET 
					quantity = '$quantity'
					WHERE cartId = '$cartId'";
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

	public function deletecart($id)
	{
		$query = "DELETE FROM tbl_cart WHERE cartId = '$id'";
		$result = $this->db->delete($query);
		if($result != false)
		{
			$msg =  "<script>window.location = 'cart.php';</script> ";
			return $msg;
		}
		else{
			$msg = "<span class='error'>Data not deleted</span>";
			return $msg;
			}
	}

	public function deleteAllItem()
	{
		 $sId   = session_id();
		$query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->delete($query);
		return $result;
	}

}
?>