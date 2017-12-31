<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../helpers/format.php';?>
<?php include_once '../classes/order.php';?>
<?php
$fm = new Format();
$odr = new order();
?>
<?php
	if (isset($_GET['shiftid']) && isset($_GET['price'])) 
	{
		$uId = $_GET['shiftid'];
		$date = $_GET['time'];
		$price = $_GET['price'];

		 $updateStatus = $odr->updateStatus($uId, $price, $date);
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
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php
        	if (isset($updateStatus)) {
        		echo $updateStatus;
        	}
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>sl</th>
					<th>ProductName</th>
					<th>image</th>
					<th>Buyer</th>
					<th>Adress</th>
					<th>price</th>
					<th>quantity</th>
					<th>Total price</th>
					<th>Date</th>
					<th>status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$getOrder = $odr->getOrderByUser();
			if($getOrder)
			{
				$i = 0;
				while($result = $getOrder->fetch_assoc())
				{
					$i++;
			?>
				<tr class="odd gradeX">
					<td><?= $i;?></td>
					<td><?= $result['product_name']?></td>
					<td><img src="<?= $result['image']?>" width="60px" height="40px"></td>
					<td><?= $result['name']?></td>
					<td><?= $result["adress"]?></td>
					<td>$<?= $result['price']?></td>
					<td><?= $result["quantity"]?></td>
					<td><?php echo $result["price"]*$result["quantity"]; ?></td>
					<td><?php echo date('jS F Y , H:i:s', strtotime($result["date"])); ?></td>
					<td>
						<?php
							if ($result["status"] == '0') {
						?>
							<a href="?shiftid=<?= $result["uId"]?>&price=<?= $result["price"]?>&time=<?= $result["date"]?>">Pending</a>
						<?php
							}
							elseif($result["status"] == '1') {
						?>
							<a href="?shiftid=<?= $result["uId"]?>&price=<?= $result["price"]?>&time=<?= $result["date"]?>">Shifted</a>
						<?php } 
							else{
						?>
							<a href="?shiftid=<?= $result["uId"]?>&price=<?= $result["price"]?>&time=<?= $result["date"]?>">confirmed</a>
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
				<?php } } ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
