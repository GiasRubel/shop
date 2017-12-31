<?php include_once 'inc/header.php';?>
<style type="text/css">
	.paysec{
		color: grey;font-size: 16px;height: 300px;font-weight: bold;text-align: center; 
	}
	.system {
		margin-top: 50px;
	}.system a{
		color: #fff;background:red;padding: 5px; 
	}
</style>
	<div class="main">
    	<div class="content">
    		<div class="paysec">
    			<p><b>select payment system</b></p>
    			<hr>
    			<div class="system">
    				<a href="online.php">Online payment</a>
    				<a href="offline.php">offline payment</a>
    			</div>
    		</div>
   		 </div>
	</div>
<?php include_once'inc/footer.php';?>