<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/country.php';?>
<?php 
    if(!isset($_GET['id']) or $_GET['id'] == NULL)
    {
        echo "<script>window.location = 'countrylist.php' ;</script>";
    }
    else{
         $id = $_GET['id'];
    }

    $cnty = new Country();
    if(isset($_POST['submit']))
    {
        $country = $_POST['country'];
        $editcountry = $cnty->editcountry($country,$id);
        //echo "<script>window.location = 'brandlist.php'; </script>";
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Brand</h2>
               <div class="block copyblock"> 
                  <?php
               if(isset($editcountry))
                echo $editcountry;
             
               ?>

               <?php
               $countrybyid = $cnty->countrybyid($id);
               $result = $countrybyid->fetch_assoc();
               ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium"  name="country" value="<?php echo $result['name']?>" />
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