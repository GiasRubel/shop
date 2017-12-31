<?php include_once 'inc/header.php';?>
<?php 
if (session::get("userLogin") == false) {
	header("Location:index.php");
}
    if(isset($_GET['delpro']))
    {
    	$id = $_GET['delpro'];
    	$delcart = $ct->deletecart($id);
    }

if(isset($_POST['submit']))
	{
		$cartId     = $_POST['cartId'];
		$quantity   = $_POST['quantity'];
		$cartupdate = $ct->updatecart($cartId,$quantity);
		if ($quantity<0) {
			$delcart = $ct->deletecart($cartId);
		}
	} 

	if (!isset($_GET["id"])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=gias' />";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php 
			if(isset($cartupdate))
			{
				echo $cartupdate;
			}
			?>
			<?php
			if(isset($delcart))
			{
				echo $delcart;
			}
			?>
						<table class="tblone">

							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$getcart = $ct->getcart();
							if($getcart)
							{
								$sum = 0;	
								while($result = $getcart->fetch_assoc())
								{	
							?>
							<tr>
								<td><?= $result['productName']?></td>
								<td><img src="admin/<?= $result['image']?>" width="5%" alt=""/></td>
								<td>Tk. <?= $result['price']?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?= $result['cartId']?>"/>
										<!-- <?php session::set("cartId",$result['cartId']);?>  -->
										<input type="number" name="quantity" value="<?= $result['quantity']?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
								<?php
								 $total = $result['price']*$result['quantity'] ;
								 echo $total;
								?>	
								</td>
								<td><a onclick="return confirm('ARE YOU SURE??');" href="?delpro=<?php echo $result['cartId'];?>">X</a></td>
							</tr>
							<?php 
							$sum = $sum+$total;

							?>
							<?php } } 
					   else{
					   	echo "<p>cart empty</p>";
					   }
					   ?>
						</table>
						<?php
							$countCart = $ct->getcart();
							
							if (!empty($countCart)) {
								
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>TK.<?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT :15% </th>
								<td>TK. <?php $vat = $sum*0.15; echo $vat; ?></td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>TK. <?= $sum+$vat ?><?php session::set("total",$sum+$vat);?> </td>
							</tr>
					   </table>
					   <?php
							}
							else{
								echo " ";
							}
					   ?>
					   
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
   <?php include_once'inc/footer.php';?>