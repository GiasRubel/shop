<?php include_once 'inc/header.php';?>
<style type="text/css">
	.paysuc{
		min-height: 100px;
		border: 1px solid #eee;
		padding: 5px;
		text-align: center;
		line-height: 18px;
		font-weight: bold;
	}
</style>
	<div class="main">
    	<div class="content">

    		<div class="paysuc">
    			<?php
    			$sum;
    			$uId = session::get("userId");
    			$getPrice = $odr->getByPrice($uId);
    			if ($getPrice) {
    				// echo mysqli_num_rows($getPrice);
    				$sum = 0;
    				while ($result = $getPrice->fetch_assoc()) {
    					$total = $result["price"] * $result["quantity"];
    					$sum = $sum + $total;
    				}
    			}
    		?>
    			<p>Total ammount of transaction is <span style="color: red;">$<?php echo $sum; ?></span></p>
    			<p>Your Transection is successfully submitted. for more info please <a href="orderdetails.php">click here</a></p>
    		</div>
    	</div>
    </div>
<?php include_once'inc/footer.php';?>