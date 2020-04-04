
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="includes/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<body>

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

<div class="container-fluid text-white pl-5 pr-5">

<div class="text-center">

  <a href="shop.php"><img src="images/logo.png" loading="lazy" width="150px" height="150px">
  <span aria-label="Click me to go back to Shop"></span></a>
  
</div> 

<div class="col-md-4 offset-md-4">
<form action="login_action.php" method="post">
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="text" class="form-control form-control-default" name="email" id="email" required="">
				<span class="help-box text-muted">
					Please enter your email.
				</span>
			</div>
			<div class="form-group">
					<label for="pass">Password:</label>
					<input type="password" class="form-control form-control-default password-input" id="pass" name="pass" required="" autocomplete="new-password">
					<span class="help-box text-muted">
						Please enter your password
					</span>
			</div>

			<button type="submit" class="btn btn-block btn-grad pb-0 pt-0 mt-3" Value="Login" id="Login"><small>Sign in</small></button>

</form>

	<hr>

	<a href="register.php" class="btn btn-block btn-outline-light pb-0 pt-0 mt-3"><small>Create a topcellers account</small></a>

</div>
</div>
  

</body>
</html>


