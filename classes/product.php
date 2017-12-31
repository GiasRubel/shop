<?php
$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
/**
* 
*/
class Product 
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db =	new Database();
		$this->fm =	new Format();
	}

	public function productinsert($data,$file)
	{
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId       = mysqli_real_escape_string($this->db->link, $data['catId']);
		$body        = mysqli_real_escape_string($this->db->link, $data['body']);
		$price       = mysqli_real_escape_string($this->db->link, $data['price']);
		$type        = mysqli_real_escape_string($this->db->link, $data['type']);
		$brandId     = mysqli_real_escape_string($this->db->link, $data['brandId']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $_FILES['image']['name'];
	    $file_size = $_FILES['image']['size'];
	    $file_temp = $_FILES['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/".$unique_image;
			
		
		if(empty($productName) or empty($catId) or empty($body) or empty($price) or empty($type) or empty($brandId) or empty($file_name))
		{
			$msg = "<span class='error'>Fill The Field</span>";
			return $msg;
		}
		elseif ($file_size >1048567) {
	     $msg =  "<span class='error'>Image Size should be less then 1MB!</span>";
	     return $msg;
	    } 
	    elseif (in_array($file_ext, $permited) === false) {
	     $msg = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
	     return $msg;
	    }

	   else{
			move_uploaded_file($file_temp, $uploaded_image);
			$query = " INSERT INTO tbl_product (productName, catId, body, price, type, brandId, image) 
			VALUES ('$productName', $catId, '$body', $price, $type , $brandId, '$uploaded_image')";
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

	public function getproduct()
	{
		$query = "SELECT p.*,c.catName,b.brandname
		FROM tbl_product as p, catagory as c, brand as b
		WHERE p.catID = c.catId AND p.brandId = b.brandId
		ORDER BY p.productId DESC";
		// $query = "SELECT tbl_product.*, catagory.catName, brand.brandname
		// FROM tbl_product
		// INNER JOIN catagory 
		// ON tbl_product.catID = catagory.catID
		// INNER JOIN brand 
		// ON tbl_product.brandId = brand.brandId
		// ORDER BY productId DESC";

		$result = $this->db->select($query);
		if($result)
			return $result;
	}

	public function getpdbyId($id)
	{
		$query = "SELECT p.*,c.catName,b.brandname
		FROM tbl_product as p, catagory as c, brand as b
		WHERE p.catID = c.catId AND p.brandId = b.brandId AND p.productId = $id
		ORDER BY p.productId DESC";

		$result = $this->db->select($query);
		if($result)
			return $result;
	}

	public function getAllProduct()
	{
		$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 3";
		$result = $this->db->select($query);
		if ($result) {
			return $result;
		}
	}

	public function productedit($data,$file,$id)
	{
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId       = mysqli_real_escape_string($this->db->link, $data['catId']);
		$body        = mysqli_real_escape_string($this->db->link, $data['body']);
		$price       = mysqli_real_escape_string($this->db->link, $data['price']);
		$type        = mysqli_real_escape_string($this->db->link, $data['type']);
		$brandId     = mysqli_real_escape_string($this->db->link, $data['brandId']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $_FILES['image']['name'];
	    $file_size = $_FILES['image']['size'];
	    $file_temp = $_FILES['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/".$unique_image;
			
		
		if(empty($productName) or empty($catId) or empty($body) or empty($price) or empty($type) or empty($brandId))
		{
			$msg = "<span class='error'>Fill The Field</span>";
			return $msg;
		}
		else{
			if(! empty($file_name))
			{
			 if ($file_size >1048567) {
		     $msg =  "<span class='error'>Image Size should be less then 1MB!</span>";
		     return $msg;
		    } 
		    elseif (in_array($file_ext, $permited) === false) {
		     $msg = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
		     return $msg;
		    }

		   else{
				move_uploaded_file($file_temp, $uploaded_image);

				$query = " UPDATE  tbl_product 
				SET
				productName = '$productName', 
				catId       = $catId,
				brandId     = $brandId,
				body        = '$body',
				price       = $price,
				image       = '$uploaded_image',
				type        = $type
				WHERE productId = '$id' ";

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

			else{

			$query = " UPDATE  tbl_product 
			SET
			productName = '$productName', 
			catId       = $catId,
			brandId     = $brandId,
			body        = '$body',
			price       = $price,
			type        = $type
			WHERE productId = '$id' ";

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
	}


	public function deleteproduct($id)
	{
		$query = "DELETE FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->delete($query);
		if($result != false)
			{
				$msg = "<span class='success'>Data Deleted</span>";
				return $msg;
			}
			else{
				$msg = "<span class='error'>Data not Deleted</span>";
				return $msg;
			} 
	}

	public function getfeatureproduct()
	{
		$query = "SELECT * from tbl_product WHERE type = '1'   LIMIT 4 ";
		$result = $this->db->select($query);
		return $result;
	}

	public function getnewproduct()
	{
		$query = "SELECT * from tbl_product WHERE type = '2'   LIMIT 4 ";
		$result = $this->db->select($query);
		return $result;
	}

    public function getsingleproduct($id)
    {
    	$query = "SELECT p.*,c.catName,b.brandname
		FROM tbl_product as p, catagory as c, brand as b
		WHERE p.catID = c.catId AND p.brandId = b.brandId AND p.productId = $id
		ORDER BY p.productId DESC";
    	$result = $this->db->select($query);
		return $result;
    }


}