<?php 
$filepath = realpath(dirname(__FILE__));
 include_once ($filepath."/../lib/session.php");
Session::init();
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<?php
spl_autoload_register(function($class){
	include_once "classes/".$class.".php";
});

$db   = new Database();
$fm   = new Format();
$pd   = new Product();
$ct   = new Cart();
$cat  = new catagory();
$cnty = new Country();
$usr  = new User();
$odr  = new Order();

?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php
									$cartcount = $ct->getcart();
									if (!empty($cartcount)) {
										echo Session::get("total");
									}
									else{
										echo '$ 0';
									}
									
									?>
								</span>
							</a>
						</div>
			      </div>
			      <?php 
			      	if (isset($_GET['usid'])) {

			      		$uId = $_GET['usid'];
			      		$ct->deleteAllItem();
			      		session::destroy();
			      		
			      	}
			      ?>
		   <div class="login">
		   	<?php if (session::get("userLogin") == true): ?>
		   		<a href="?usid=<?= session::get("userId")?>"> Logout </a>
		   	<?php else: ?>
		   		<a href="login.php">Login</a>
		   	<?php endif ?>
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <?php if (session::get("userLogin") ==true): ?>
	  	<li><a href="cart.php">Cart</a></li>
	  	<li><a href="orderdetails.php">Order</a></li>
	  	<li><a href="wishlist.php">Wish List</a></li>
	  <?php endif ?>
	  
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>
