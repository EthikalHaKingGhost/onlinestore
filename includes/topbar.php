<div class="container-fluid bg-black border-0 header-top d-none d-md-block sticky-top">
	<div class=container>
		<div class= "row text-light py-2">
			<div class="col-md-5 pt-1 text-light">
				<i class="fa fa-envelope" aria-hidden="true"> topcellers@mail.com</i>
			</div>

			<div class="col-md-2 pt-1 text-light">
			<i class="fas fa-phone" aria-hidden="true"> 1-758-726-1402</i>
			</div>

			<div class="col-md-2 pt-1 text-light">
				<i class="fa fa-user" aria-hidden="true">

					<?php if (isset($_SESSION["user_id"])){
						echo $_SESSION["first_name"];
					}else{
						echo "Account";
					}
				?></i>

			</div>
			<div class="col-md-3 text-right"><a href="cart.php" class="text-decoration-none btn btn-danger btn-sm text-white mr-1"><i class="fa fa-shopping-cart" aria-hidden="true"> My Cart</a> - <?php

			if (isset($_SESSION["total_price"])) {
				echo "$"."{$_SESSION["total_price"]}";
			}else{

				echo "$"."0.00";
			}

			  ?></i></div>
		</div>
	</div>
</div>