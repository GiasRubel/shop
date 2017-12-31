<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/country.php';?>
<?php
    $cnty = new Country();
    if(isset($_POST['submit']))
    {
        $country = $_POST['countryname'];
        $addcountry = $cnty->addcountry($country);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock"> 
               <?php
               if(isset($addcountry))
                echo $addcountry;
               ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Country Name..." class="medium"  name="countryname"/>
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