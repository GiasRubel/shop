<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php 
    if(!isset($_GET['id']) or $_GET['id'] == NULL)
    {
        echo "<script>window.location = 'brandlist.php' ;</script>";
    }
    else{
         $id = $_GET['id'];
    }

    $brnd = new Brand();
    if(isset($_POST['submit']))
    {
        $brandname = $_POST['brandname'];
        $updatebrnd = $brnd->editbrnd($brandname,$id);
        //echo "<script>window.location = 'brandlist.php'; </script>";
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Brand</h2>
               <div class="block copyblock"> 
                  <?php
               if(isset($updatebrnd))
                echo $updatebrnd;
             
               ?>

               <?php
               $getbrndid = $brnd->getbyid($id);
               $result = $getbrndid->fetch_assoc();
               ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium"  name="brandname" value="<?php echo $result['brandname']?>" />
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