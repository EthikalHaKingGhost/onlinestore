<?php # DISPLAY POST MESSAGE FORM.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Post Message' ;

include ( 'includes/header.php' ) ;
?>

<div class="container">
	
<div class="row">

	<div class="col-md-6 offset-md-3">

		<form action="post_action.php" method="post" accept-charset="utf-8">

<div class="form-group">
    <label for="messagebox">Subject:</label>
<input name="subject" type="text" size="64" class="form-control" class maxlength="100">
</div>

 <div class="form-group">
    <label for="messagebox">Message:</label>
    <textarea class="form-control bg-light" id="messagebox" name="message" rows="5" cols="50"></textarea>
  </div>

<input name="submit" type="submit" class="btn btn-info btn-block" value="Post"></p>

</form>
		
	</div>
	
</div>

</div>


<?php 

include ( 'includes/footer.php' ) ;

?>