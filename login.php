<?php # DISPLAY COMPLETE LOGIN PAGE.

# Set page title and display header section.
$page_title = 'Login' ;
include ( 'includes/header.html' ) ;

# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
 echo '<p id="err_msg">Oops! There was a problem:<br>' ;
 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
 echo 'Please try again or <a href="register.php">Register</a></p>' ;
}
?>

<!-- Display body section. -->
<h1>Login</h1>
<form action="login_action.php" method="post">
<p>Email Address: <input type="text" name="email"> </p>
<p>Password: <input type="password" name="pass"></p>
<p><input type="submit" value="Login" ></p>
</form>
..................

<!---Login Form Bootstrap 4 ----->
<form action="login_action.php" method="post">
<div class="container-fluid">
	<h1 class="text-center pb-4">Login</h1>
	<div class="col-md-4 offset-md-4 pt-5 pb-5">
		<div class="form-group">
	<label for="email">Email address:</label>
	<input type="email" name="email" class="form-control" placeholder="Enter email">
</div>
<div class="form-group">
	<label for="password">Password:</label>
	<input type="password" name="pass" class="form-control" placeholder="Enter password">
</div>
<div class="form-group form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox">
		Remember me
    </label>
  </div>
<button type="Login" class="btn btn-primary">
	Login
</button>
	</form>
	</div>
</div>


<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>
