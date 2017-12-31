<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/country.php';?>
<?php
$cnty = new Country();
 $id = '';
 if(isset($_GET['delcnty']))
 {
    $id = $_GET['delcnty'];
    $delcnty = $cnty->delcountry($id);
 }

//var_dump($id);
   

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                
                <div class="block">  
            	<?php
               if(isset($delcnty))
                echo $delcnty;
               ?>  

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				<?php
                $cntylist = $cnty->getcountry();
                if($cntylist)
                {
                	$i=0;
                	while($result = $cntylist->fetch_assoc())
                	{
                		$i++;
                ?>   
						<tr class="odd gradeX">
							<td><?= $i?></td>
							<td><?= $result['name']?></td>
							<td><a href="editcnty.php?id=<?= $result['id']?>">Edit</a> || 
							<a onclick="return confirm('Are You Sure!')" href="?delcnty=<?php echo $result['id']?>">Delete</a></td>
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

