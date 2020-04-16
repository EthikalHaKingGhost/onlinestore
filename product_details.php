<?php
	
	# Access session.
	session_start() ;

	# Redirect if not logged in.
	if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

	# Set page title and display header section.
	$page_title = 'Product Details' ;

	include ( 'includes/header.php' ) ;

	# Open database connection.
	require ( 'connect_db.php' ) ;
	
	//capture and save parameter: selected
	if(isset($_REQUEST["pid"])){

		$product_id = $_REQUEST["pid"];

	}

	else 

	{
		echo "No parameter found, please try again.";

		exit();
	}

	//sql statement using parameter as criteria
	$query = "SELECT * FROM products, product_category, category_assign WHERE products.product_id = '$product_id' AND product_category.category_id = category_assign.category_id AND products.product_id = category_assign.product_id";
	
	//create query to execute sql on db
	$query = mysqli_query($dbc, $query);
	
			//create IF function to display db data if any available
			if($query){
				//singular product placed in record variable
				$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
				
				//create variables for each field
				  $product_name =$row["product_name"];
                  $product_details = $row["product_details"];
                  $ram = $row["ram"];
                  $battery_size = $row["battery_size"];
                  $screen_size = $row["screen_size"];
                  $camera_pixels = $row["camera_pixels"];
                  $product_image = $row["product_image"];
                  $product_price =$row["product_price"];
                  $sale_price = $row["sale_price"];
                  $category = $row["category"];
                  $category_id = $row["category_id"];

		}

		else {
			echo "no data to display";
		}

		?>

		<div class="container-fluid pt-5 text-dark">

		<div class="row">
		<!-- creating structure for single item -->
		<div class="col-md-4 text-center">
			<img class="img-thumbnail" src="images/<?php echo $product_image; ?>" width="350" height="350" />
		</div>
		
		<div class="col-md-4">
			<h2 class="text-uppercase"><?php echo $product_name; ?></h2>
			<figcaption class="figure-caption text-justify"><?php echo $product_details; ?></figcaption>
			<hr>
			<ul class="figure-caption list-unstyled">
			<li><label>Specifications: </label>
		        <ul>
			        <li><label class="font-weight-bold">Screen Resolution: </label> <?php echo $screen_size ?></li>
					<li><label class="font-weight-bold">pixels: </label> <?php echo $camera_pixels ?></li>
					<li><label class="font-weight-bold">Battery Size: </label> <?php echo $battery_size ?></li>
					<li><label class="font-weight-bold">RAM Size: </label> <?php echo $ram ?></li>
		        </ul>
		    </li>	
			</ul>
		</div>
		
		<div class="col-md-4 pl-5">
			<div class="card" style="width: 18rem;">
			  <div class="card-body text-dark">
				<h5 class="card-title"><?php echo $category; ?></h5>
				<h5 class="font-weight-bold">Price: <?php 
                    if($sale_price <> 0 ){

                    echo '<s class="text-dark h5" "> $'.$product_price. ' TTD </s>';

                  }else{

                    echo '<span class="text-dark font-weight-bold h4"> $'.$product_price. ' TTD </span>'; 
                    
                  }
                  ?>

        <!----remove sale price when value is 0 ------>

            <span class="text-danger font-weight-bold h4"> 

                    <?php 

                    if($sale_price != 0){

                    	echo '$'.$sale_price .' TTD'; 

                      }else{

                        echo "";
                      }

                      ?>

             </span>
         </h5>
				<a href="added.php?add=<?php echo $product_id; ?>" class="btn btn-warning text-dark">Add to Cart<br/></a>
			  </div>
			</div>
		</div>
		</div>

		<hr>
		
		<div class="container text-dark">

		<h5 class="pt-5 pb-0 mb-0">Similar Products</h5>
		<label class="figure-caption">See some of our Latest products</label>
		<hr>
		<div class="row text-centerp-5">

				<?php

				# Retrieve items from 'shop' database table, display similar items except item displayed.
				$query = "SELECT * FROM products, product_category, category_assign WHERE product_category.category_id = '$category_id' AND product_category.category_id = category_assign.category_id AND products.product_id = category_assign.product_id AND products.product_id <> '$product_id' LIMIT 4" ;

				$result = mysqli_query( $dbc, $query ) ;

				if (mysqli_num_rows($result) > 0) {
    			// output data of each row
    			while($row = mysqli_fetch_assoc($result)) {

				        $pname =$row["product_name"];
				        $pimage = $row["product_image"];
				        $pprice =$row["product_price"];
				        $sprice = $row["sale_price"];
				        $prodid = $row["product_id"];
				        $plink = "product_details.php?pid=$prodid";

				?>
					<div class="col-md-3 text-center">
						
						<br/>
						<img class="img-thumbnail" src="images/<?php echo $pimage ?>" width="150" height="150">
						<br/>
						<h5><?php echo $pname ?></h5>
						<a href="<?php echo $plink; ?>" class="btn btn-dark text-light">View Product<br/></a>
					</div>
					
				<?php

				  }

				  # Close database connection.
				  mysqli_close( $dbc ) ; 
				}

				# Or display message.
				else { echo '<p>There are currently no items in this shop.</p>' ; }
				?>

				</div>
				<hr>
			</div>
			

<div class="container text-dark">

		<h5 class="pt-5 pb-0 mb-0">Product Reviews</h5>
		<label class="figure-caption">Rate our product</label>
		<hr>
		<div class="row text-centerp-5">


</div>
</div>
</div>

<?php include ( 'includes/footer.php' ) ; ?>
	