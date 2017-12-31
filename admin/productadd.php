<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/catagory.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?php
$pd = new Product();
if(isset($_POST['submit']))
{
   // $productName = $_POST['productName'];
   // $catId = $_POST['catId'];

   $pdinsert = $pd->productinsert($_POST,$_FILES);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block"> 
        <?php 
        if(isset($pdinsert))
        {
            echo $pdinsert;
        }
        ?>              
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Enter Product Name..."  class="medium"  />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    
                    <td>
                        <select id="select" name="catId">
                        <option>Select catagory</option>
                         <?php
                            $cat = new Catagory();
                            $selectcat = $cat->getcat();
                            if($selectcat)
                            {
                                while($result = $selectcat->fetch_assoc())
                                {
                            ?>
                        <option value="<?= $result['catId']?>"><?= $result['catName']?></option>
                            <?php } } ?>
                        </select>
                        
                    </td>
                    
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                             <?php
                            $brnd = new Brand();
                            $selectbrand = $brnd->getbrnd();
                            if($selectbrand)
                            {
                                while($result = $selectbrand->fetch_assoc())
                                {
                            ?>
                            <option value="<?= $result['brandid']?>"><?= $result['brandname']?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium"  />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option value="1">Featured</option>
                            <option value="2">Generel</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


