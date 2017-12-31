<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
    $brnd = new Brand();
    if(isset($_POST['submit']))
    {
        $brandname = $_POST['brandname'];
        $addbrnd = $brnd->addbrnd($brandname);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock"> 
               <?php
               if(isset($addbrnd))
                echo $addbrnd;
               ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium"  name="brandname"/>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>