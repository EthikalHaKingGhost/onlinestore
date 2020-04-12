<div class="container-fluid bg-dark border-0 header-top d-none d-md-block sticky-top">
	<div class=container>
		<div class= "row text-light pt-2 pb-2">
			<div class="col-md-5"><i class="fa fa-envelope" aria-hidden="true"></i> topcellers@mail.com</div>

			<div class="col-md-3">
				
			</div>

			<div class="col-md-2"><i class="fa fa-user" aria-hidden="true"></i>

					<?php if (isset($_SESSION["user_id"])){
						echo $_SESSION["first_name"];
					}else{
						echo "Account";
					}
				?>

			</div>
			<div class="col-md-2 text-right"><a href="cart.php" class="text-decoration-none btn btn-outline-info btn-sm text-white"><i class="fa fa-shopping-cart" aria-hidden="true"></i>My Cart</a> - <?php echo '$'.'0.00' ?></div>
		</div>
	</div>
</div>