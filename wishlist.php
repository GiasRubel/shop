<?php include_once 'inc/header.php';?>
<?php 
if (session::get("userLogin") == false) {
	header("Location:index.php");
}
?>
<?php
	if (isset($_GET['delwishId'])) { 

		$id = $_GET['delwishId'];

		 $delwishes = $odr->delwishes($id);
	}
?>
<style type="text/css">
	table.tblone img {
    height: 60px;
    width: 80px;
}
</style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Orders</h2>
			    	
						<table class="tblone">

							<tr>
								<th width="10%">Serial</th>
								<th width="25%">Product Name</th>
								<th width="35%">Image</th>
								<th width="10%">Price</th>
								<th width="20%">Action</th>
							</tr>
							<?php
							$uId = session::get("userId");
							$getwishes = $odr->getwishes($uId);
							if($getwishes)
							{	
								$i = 1;

								while($result = $getwishes->fetch_assoc())
								{	
							?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= $result['product_name']?></td>
								<td><img src="admin/<?= $result['image']?>" width="300" alt=""/></td>
								<td>Tk. <?= $result['price']?></td>
								<td>
									<a href="details.php?pid=<?php echo $result['product_id']?>">view</a> ||
									<a onclick="return confirm('ARE YOU SURE??');" href="?delwishId=<?= $result["id"]?>">Remove</a>	
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
