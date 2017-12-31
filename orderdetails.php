<?php include_once 'inc/header.php';?>
<?php 
if (session::get("userLogin") == false) {
	header("Location:index.php");
}

	// if (!isset($_GET["id"])) {
	// 	echo "<meta http-equiv='refresh' content='0;URL=?id=gias' />";
	// }
?>

<?php
	if (isset($_GET['uId']) && isset($_GET['price']) && isset($_GET['quantity'])) 
	{
		$uId      = $_GET['uId'];
		$quantity = $_GET['quantity'];
		$price    = $_GET['price'];

		$updateStat = $odr->updateStat($uId, $price, $quantity);
	}
?>

<?php
	if (isset($_GET['delId']) && isset($_GET['uId'])) 
	{
		$id   = $_GET['delId'];
		$uId  = $_GET['uId'];
		
		$delOrder = $odr->delOrder($id, $uId);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Orders</h2>
			    	
						<table class="tblone">

							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="20%">Status</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$uId = session::get("userId");
							$getOrders = $odr->getOrders($uId);
							if($getOrders)
							{	
								while($result = $getOrders->fetch_assoc())
								{	
							?>
							<tr>
								<td><?= $result['product_name']?></td>
								<td><img src="admin/<?= $result['image']?>" width="5%" alt=""/></td>
								<td>Tk. <?= $result['price']?></td>
								<td><?= $result["quantity"]?></td>
								<td>
									<?php
										 $total = $result['price']*$result['quantity'] ;
										 echo $total;
									?>	
								</td>
								<td> 
									<?php
										if ($result["status"] == 0) 
										{
									?>
										<a href="">Pending</a>
									<?php		
										}
										elseif ($result["status"] == 1) 
										{
									?>
										<a href="?uId=<?= $result["user_id"]?>&price=<?= $result["price"]?>&quantity=<?= $result["quantity"]?>">seen</a>
									<?php } 
										else{
									?>
										<a href="">Confirmed</a>
									<?php } ?>
								</td>

								<td>
									<?php
										if ($result["status"] == 0) 
										{
									?>
										<a href="">N/A</a>
									<?php		
										}
										elseif ($result["status"] == 1) 
										{
									?>
										<a href="">N/A</a>
									<?php } 
										else{
									?>
									<a onclick="return confirm('ARE YOU SURE??');" href="?delId=<?= $result["id"]?>&uId=<?= $result["user_id"]?>">X</a>
									<?php } ?>
								</td>
							</tr>
							
							<?php } } 
					   // else{
					   // 	echo "<p>cart empty</p>";
					   // }
					   ?>
						</table>
						
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
   <?php include_once'inc/footer.php';?>
