<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/catagory.php';?>
<?php 
    if(!isset($_GET['id']) or $_GET['id'] == NULL)
    {
        echo "<script>window.location = 'catlist.php' ;</script>";
    }
    else{
         $id = $_GET['id'];
    }

    $cat = new Catagory();
    if(isset($_POST['submit']))
    {
        $catName = $_POST['catName'];
        $updatecat = $cat->editcat($catName,$id);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"> 
               <?php
               if(isset($updatecat))
                echo $updatecat;
             
               ?>

               <?php
               $getcatid = $cat->getbyid($id);
               $result = $getcatid->fetch_assoc();
               ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium"  name="catName" value="<?php echo $result['catName']?>" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>