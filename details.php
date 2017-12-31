<?php include'inc/header.php';?>


 <div class="main">
    <div class="content">
    	<div class="section group">
   	<?php
    	if(!isset($_GET['pid']) or $_GET['pid'] == NULL)
    {
        echo "<script>window.location = '404.php' ;</script>";
    }
    else{
         $id = $_GET['pid'];
    }

    if(isset($_POST['submit']))
	{
		$quantity = $_POST['quantity'];
		$cartInsert = $ct->cartInsert($quantity,$id);
	}

	?>

	<?php
	    if(isset($_POST['wish']))
		{
			$uId = session::get("userId");
			$addToWish = $odr->addToWish($id, $uId);
			
		}
	?>

	<?php
	$singlepro = $pd->getsingleproduct($id);
	if($singlepro)
	{
		while($result = $singlepro->fetch_assoc())
		{
	?>
			<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/<?= $result['image']?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?= $result['productName']?> </h2>
					<p><?= $fm->textShorten($result['body'],180)?></p>					
					<div class="price">
						<p>Price: <span>$<?= $result['price']?></span></p>
						<p>Category: <span><?= $result['catName']?></span></p>
						<p>Brand:<span><?= $result['brandname']?></span></p>
					</div>
					<?php 
					if (session::get("userLogin") == true) {
						?>
						<div class="add-cart">
							<form action="" method="post">
								<input type="number" class="buyfield" name="quantity" value="1"/>
								<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
							</form>	<br>
							<form action="" method="post">
								<input type="submit" class="buysubmit" name="wish" value="Add to wish list"/>	
							</form>			
						</div>
						<?php }?>
				<br>
				<?php 
				if (isset($addToWish)) {
					echo $addToWish;
				}

				if(isset($cartInsert))
				{
					echo $cartInsert;
				}
				?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	    </div>
				
	</div>
	<?php } } ?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<?php
						$allCat = $cat->getAllCat();
						if ($allCat) {
							while ($result = $allCat->fetch_assoc()) {

					?>
					<ul>
				      <li><a href="productbycat.php"><?= $result["catName"]?></a></li>
				      
    				</ul>
    	<?php } } ?>
 				</div>
 		</div>
 	</div>
	</div>

<?php include 'inc/footer.php';?>