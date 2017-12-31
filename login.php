<?php include_once 'inc/header.php';?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<?php
        	if (isset($_POST['register'])) {
        		$name = $_POST['name'];
        		$password = $_POST['password'];

        		$logUser = $usr->logUser($name,$password);
        	}
        	?>
        	<?php
    			if (isset($logUser)) {
    				echo $logUser;
    			}
    		?>
        	<form action="" method="post" id="member">
                	<input  type="text" value="" name="name" class="field" >
                    <input  type="password" value="" name="password" class="field" >
             
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><button name="register" class="grey">Sign In</button></div></div>
            </form>

                    </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php
    			if (isset($_POST['submit'])) {
    				$adduser = $usr->adduser($_POST);
    			}
    		?>
    		<?php
    			if (isset($adduser)) {
    				echo $adduser;
    			}
    		?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" value="" name="name" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" value="" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" value="" name="zip" placeholder="Zip-Code">
							</div>
							<div>
								<input type="text" value="" name="emial" placeholder="Email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" value="" name="adress" placeholder="Adress">
						</div>
		    		<div>
						<select id="country" name="country">
							<option value="0">Select a Country</option> 
							<?php
								$countries = $cnty->getcountry();
								if($countries)
								{
									while($result = $countries->fetch_assoc())
									{
							?>
							        
							<option value="<?= $result["id"]?>"><?= $result["name"]?></option>
							<?php } } ?>
		         		</select>
				 </div>		        
	
		           <div>
		          <input type="text" value="" name="phone" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="text" value="" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button name="submit" class="grey">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
   <?php include_once'inc/footer.php';?>