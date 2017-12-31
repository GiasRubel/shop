<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/catagory.php';?>
<?php
$cat = new Catagory();
$id = '';
if(isset($_GET['delcat']))
{
   $id = $_GET['delcat'];
   $delcat = $cat->delcat($id);
}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                
                <div class="block">  
             <?php
               if(isset($delcat))
                echo $delcat;
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
                $catlist = $cat->getcat();
                if($catlist)
                {
                	$i=0;
                	while($result = $catlist->fetch_assoc())
                	{
                		$i++;
                ?>   
						<tr class="odd gradeX">
							<td><?= $i?></td>
							<td><?= $result['catName']?></td>
							<td><a href="editcat.php?id=<?= $result['catId']?>">Edit</a> || 
							<a onclick="return confirm('Are You Sure!')" href="?delcat=<?php echo $result['catId']?>">Delete</a></td>
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

