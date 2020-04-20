

<?php # DISPLAY COMPLETE LOGIN PAGE.

	# Set page title and display header section.
$page_title = 'Login' ;

# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
 echo '<p id="err_msg">Oops! There was a problem:<br>' ;

 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }

 echo 'Please try again or <a href="register.php">Register</a></p>' ;
 
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $page_title ?></title>
</head>
<link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="includes/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<body>


<div class="container-fluid text-dark pl-5 pr-5 pt-5">

<div class="text-center">

  <a href="shop.php"><img src="images/logo3.png" loading="lazy" width="150px" height="150px">
  <span aria-label="Click me to go back to Shop"></span></a>
  
</div> 

<div class="col-md-4 offset-md-4">
<form action="login_action.php" method="post">
			<div class="form-group">
				<label for="email"> <small>Email</small></label>
				<input type="text" class="form-control" name="email" id="email" required>
				
			</div>
			<div class="form-group">
					<label for="pass"><small>Password</small></label>
					<input type="password" class="form-control password-input" id="pass" name="pass" required>
					
			</div>

			  <div class="form-group">
			    <div class="custom-control form-control-sm custom-checkbox">  
			    <input type="checkbox" class="custom-control-input" id="checkbox">  
			    <label class="custom-control-label" for="checkbox"><small>Remember Me</small></label>  
			    </div>  
			  </div> 


			<button type="submit" class="btn btn-block btn-grad mb-3 pt-0 mt-3" Value="Login" id="Login" name="Login"><small><strong>Sign in</strong></small></button>

</form>


		<div class="border-top text-center p-3">
		<small>Don't have an account? <a href="register.php">Create a topcellers account</a></small>
</div>
</div>
</div>
  


