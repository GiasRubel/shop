<?php include_once 'inc/header.php';?>
<style type="text/css">
	.paytable{
		min-height: 400px;
		width: 50%;
		float: left;
	}
	.back{
		background: red;
		padding: 20px;
		border-radius: 5px;
		width: 20%;
		margin-left: 50px;
		font-weight: bold;
		font-size: 25px;
	}

    .back a{
         color: white;
    }
	.showuser{
		float: left;
		height: 400px;
		margin-left: 100px;
	}
	table, th, td {
	    border: 1px solid black;
	    border-collapse: collapse;
	}
	th, td {
	    padding: 5px;
	    text-align: left;    
	}

	table#t01 tr:nth-child(even) {
	    background-color: #eee;
	}
	table#t01 tr:nth-child(odd) {
	   background-color:#fff;
	}

</style>
<?php
	if (isset($_GET['orderId']) && $_GET['orderId'] == 'order' )
    {
        $uId = session::get("userId");
        $insertOrder = $odr->insertOrder($uId);
     
		header("Location:paysuccess.php");

        $ct->deleteAllItem();
	}
?>
<div class="main">
    	<div class="content">
    		<div class="paytable">
    				<table class="tblone">

    					<tr>
    						<th width="20%">Product Name</th>
    						<th width="20%">Image</th>
    						<th width="20%">Price</th>
    						<th width="20%">Quantity</th>
    						<th width="20%">Total Price</th>
    						
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
    						<td><?= $result['quantity']?></td>
    						
    						<td>
    						<?php
    						 $total = $result['price']*$result['quantity'] ;
    						 echo $total;
    						?>	
    						</td>
    						
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
    		</div>
    		<div class="showuser">
    			<h2>User Profile</h2>
    			<?php
    				$uId = session::get("userId");
    				$getUser = $usr->getUser($uId);
    				if($getUser)
    				{
    					while ($result = $getUser->fetch_assoc()) {
    						# code...
    			?>
    			<table style="width: 100%" id="t01">
    			  <tr>
    			    <th>Name:</th>
    			    <td><?= $result["name"]?></td>
    			  </tr>
    			  <tr>
    			    <th >Email:</th>
    			    <td><?= $result["email"]?></td>
    			  </tr>
    			  <tr>
    			    <th >Telephone:</th>
    			    <td><?= $result["phone"]?></td>
    			  </tr>
    			  <tr>
    			    <th >Adress:</th>
    			    <td><?= $result["adress"]?></td>
    			  </tr>
    			  <tr>
    			    <th >city:</th>
    			    <td><?= $result["city"]?></td>
    			  </tr>
    			  <tr>
    			    <th >country:</th>
    			    <td><?= $result["cname"]?></td>
    			  </tr>
    			  <tr>
    			    <th >Zip:</th>
    			    <td><?= $result["zip"]?></td>
    			  </tr>
    			  
    			</table>
    			
    		</div>
    		<button class="back" ><a href="?orderId=order">order</a></button>
    		<?php } } ?>
    	</div>
 </div>

<?php include_once'inc/footer.php';?>
