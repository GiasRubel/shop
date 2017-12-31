<?php include_once '../classes/adminlogin.php';?>
<?php
$al = new Adminlogin();
if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$loginchk = $al->adminLogin($username,$password);
}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>
			<span style="color:red">
				<?php 
				if(isset($loginchk))
					echo $loginchk;
				?>
			</span>
			<div>
				<input type="text" placeholder="username"  name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" name="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>