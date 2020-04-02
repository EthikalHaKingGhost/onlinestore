
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="includes/style.css">

<style>

	body {
		background-image: url(images/login-bg.jpeg) !important;
		background-size: cover;
		background-repeat: none;
		background-size: cover;
		background-position: center;
		background-attachment: fixed;

	}
</style>
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


<!---Login Form Bootstrap 4 ----->
<form action="login_action.php" method="post">
	<div class="container">
	<div class="row justify-content-center p-5">
	<div class="col-md-6">
		<span class="anchor" id="login"></span>
		<div class="card">
			<header class="card-header bg-info text-white text-center p-0">
				<h4 class="mb-0"><small><img src="images/rhino.png"></small></h4>
			</header>
	<div class="row pl-3 pr-3">
		<div class="card-body">
			<div class="form-group">
				<label for="email" class="m-0">Email:</label>
				<input type="text" class="form-control form-control-sm" name="email" id="email" required="">
				<span class="form-text small text-muted">
					<small>Please enter your email.</small>
				</span>
			</div>
				<div class="form-group">
					<label for="pass" class="m-0">Password:</label>
					<input type="password" class="form-control form-control-sm" id="pass" name="pass"required="" autocomplete="new-password">
					<span class="form-text small text-muted">
						<small>Please enter your password</small>
					</span>
				</div>
				<button type="submit" class="btn btn-block btn-info pb-0 pt-0 mt-3" Value="Login" id="Login"><small>Sign in</small></button>
			</div>
		</div>
	</div>
	<hr>
	<a href="register.php" class="btn btn-block btn-secondary pb-0 pt-0 mt-3"><small>Create a topcellers account</small></a>
</div>
</div>
</div>           <!--/card-body-->
</form>
</body>
</html>


