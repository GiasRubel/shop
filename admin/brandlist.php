<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
$brnd = new Brand();
 $id = '';
 if(isset($_GET['delbrnd']))
 {
    $id = $_GET['delbrnd'];
    $delbrnd = $brnd->delbrnd($id);
 }

//var_dump($id);
   

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                
                <div class="block">  
            	<?php
               if(isset($delbrnd))
                echo $delbrnd;
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
                $brndlist = $brnd->getbrnd();
                if($brndlist)
                {
                	$i=0;
                	while($result = $brndlist->fetch_assoc())
                	{
                		$i++;
                ?>   
						<tr class="odd gradeX">
							<td><?= $i?></td>
							<td><?= $result['brandname']?></td>
							<td><a href="editbrnd.php?id=<?= $result['brandid']?>">Edit</a> || 
							<a onclick="return confirm('Are You Sure!')" href="?delbrnd=<?php echo $result['brandid']?>">Delete</a></td>
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

