<?php

$filepath = realpath(dirname(__FILE__));
// include ($filepath.'/../lib/session.php');
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');


/**
* 
*/
class Order
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}


	public function insertOrder($uId)
	{
		$sId = session_id();
		$oquery = "select * from tbl_cart where sId = '$sId' ";
		$getOrder = $this->db->select($oquery);

		if ($getOrder)
		{
			while ($result = $getOrder->fetch_assoc())
			{
				$product_id   = $result["productId"];
				$product_name = $result["productName"];
				$price        = $result["price"];
				$price        = $price + ($price*0.15);
				$quantity     = $result["quantity"];
				$image        = $result["image"];

				$query = "insert into orders(user_id,product_id,product_name,price,quantity,image)
				values($uId,$product_id,'$product_name',$price,$quantity,'$image')";

				$inserted_row = $this->db->insert($query);
				
			}
		}
		
	}

	public function getByPrice($uId)
	{
		$query = "select price, quantity from orders where user_id = $uId and date = now() ";
		$result = $this->db->select($query);
		return $result;
	}

	public function getOrders($uId)
	{
		$query = "select * from orders where user_id = $uId ";
		$result = $this->db->select($query);
		return $result;
	}

	public function getOrderByUser()
	{
		$query ="SELECT orders.*, user.id as uId, user.name, CONCAT(user.adress, ',' ,user.city) as adress
	      FROM  orders, user 
	      WHERE user.id = orders.user_id 
	      ORDER BY orders.id DESC" ;

		$result = $this->db->select($query);
		return $result;
	}

	public function updateStatus($uId, $price, $date)
	{
		$query = " UPDATE orders SET status = '1' WHERE user_id = $uId AND price = $price AND date = '$date' ";

		$result = $this->db->update($query);
		if($result != false)
		{
			$msg = "<span class='success'>Data updated for orders</span>";
			return $msg;
		}
		else{
			$msg = "<span class='error'>Data not updated</span>";
			return $msg;
		} 
	}

	public function updateStat($uId, $price, $quantity)
	{
		$query = " UPDATE orders SET status = '2' WHERE user_id = $uId AND price = $price AND quantity = $quantity ";

		$result = $this->db->update($query);
		return $result;
	}

	public function delOrder($id, $uId)
	{
		$query = "DELETE FROM orders WHERE id = $id AND user_id = $uId" ;
		$result = $this->db->delete($query);
		return $result;
	}

	public function addToWish($id, $uId)
	{
		$query = "select * from wishes where product_id = $id AND user_id = $uId" ;
		$result = $this->db->select($query);
		if ($result) {
			$msg = "<span class='error'>Already Added To Wishlist</span>";
				return $msg;
		}

		else{

			$query = "select * from tbl_product where productId = $id" ;
			$result = $this->db->select($query)->fetch_assoc();
			if ($result) {
				$product_name = $result["productName"];
				$price = $result["price"];
				$image = $result["image"];
				
				$query = "insert into wishes (product_id, user_id, product_name, price, image)
				values ($id, $uId, '$product_name', $price, '$image')";

				$inserted_wish = $this->db->insert($query);

				if($inserted_wish != false)
				{
					$msg = "<span class='success'>Added To Wishlist</span>";
					return $msg;
				}
				else{
					$msg = "<span class='error'>Something wrong</span>";
					return $msg;
				} 
			}
		}
		
		
	}

	public function getwishes($uId)
	{
		$query = "select * from wishes where user_id = $uId" ;
		$result = $this->db->select($query);
		return $result;
	}

	public function delwishes($id)
	{
		$query = "DELETE FROM wishes WHERE id = $id" ;
		$result = $this->db->delete($query);
		return $result;
	}



}