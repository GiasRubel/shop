<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../helpers/format.php';?>
<?php include_once '../classes/product.php';?>
<?php
$fm = new Format();
$pd = new Product();
?>
<?php
if(isset($_GET['delpro']))
{
	$id = $_GET['delpro'];
	$delproduct = $pd->deleteproduct($id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php
        if(isset($delproduct))
        	echo $delproduct;
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>sl</th>
					<th>ProductName</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$getpd = $pd->getproduct();
			if($getpd)
			{
				$i = 0;
				while($result = $getpd->fetch_assoc())
				{
					$i++;
			?>
				<tr class="odd gradeX">
					<td><?= $i;?></td>
					<td><?= $result['productName']?></td>
					<td><?= $result['catName']?></td>
					<td><?= $result['brandname']?></td>
					<td><?= $fm->textShorten($result['body'], 40)?></td>
					<td>$<?= $result['price']?></td>
					<td>  <img src="<?= $result['image']?>" width="60px" height="40px"></td>
					<td>
					<?php
					if($result['type'] == 1)
					{
						echo "Featured";
					}
					else{
						echo "Generel";
					}
					?>
					</td>
					<td><a href="editproduct.php?id=<?= $result['productId']?>">Edit</a> || 
					<a href="?delpro=<?= $result['productId']?>">Delete</a></td>

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
