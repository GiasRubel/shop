<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/catagory.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?php
if(!isset($_GET['id']) or $_GET['id'] == NULL)
{
    echo "<script>window.location = 'productlist.php' ;</script>";
}
else{
    $id = $_GET['id'];
}

$pd = new Product();
if(isset($_POST['submit']))
{
   // $productName = $_POST['productName'];
   // $catId = $_POST['catId'];

   $pdupdate = $pd->productedit($_POST,$_FILES,$id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block"> 
        <?php 
        if(isset($pdupdate))
        {
            echo $pdupdate;
        }
        ?> 
        <?php
        $getpdbyId = $pd->getpdbyId($id);
        if($getpdbyId)
        {
            while($value = $getpdbyId->fetch_assoc())
            {

        ?>             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Enter Product Name..."  class="medium" value="<?= $value['productName']?>" />
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
                        <option 
                        <?php
                        if($result['catId'] == $value['catId']) 
                        {
                        ?>
                            selected = "selected";
                        
                        <?php }?>
                        value="<?= $result['catId'] ?>"><?= $result['catName']?></option>
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
                            <option
                            <?php
                            if($result['brandid'] == $value['brandId']) 
                            {
                            ?>
                                selected = "selected";
                            
                        <?php }?>
                             value="<?= $result['brandid']?>"><?= $result['brandname']?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body" >
                            <?= $value['body']?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium" value="<?= $value['price']?>" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" /><img src="<?= $value['image']?>" height="80px" weight="100px">
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php 
                            if($value['type'] == 1)
                            {
                            ?>
                                <option selected = "selected" value="1">Featured</option>
                                <option value="2">Generel</option>
                            <?php } else { ?>
                                <option  value="1">Featured</option>
                                <option selected = "selected" value="2">Generel</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php } } ?>
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


