<?php 

# Access session.
session_start() ; 

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Home'; ?>


<div class="container-fluid bg-dark header-top d-none d-md-block">
	<div class=container>
		<div class= "row text-light pt-2 pb-2">
			<div class="col-md-5"><i class="fa fa-envelope" aria-hidden="true"></i> topcellers@mail.com</div>

			<div class="col-md-3">
				
			</div>

			<div class="col-md-2"><i class="fa fa-user" aria-hidden="true"></i> Account</div>
			<div class="col-md-2 text-right"><i class="fa fa-cart-plus" aria-hidden="true"></i> My Cart - $0.00</div>
		</div>
	</div>
</div>

<?php include ( 'includes/header.html' ) ;?>







//display most recent products







# Display footer section.
<?php include ( 'includes/footer.html' ) ;
?>