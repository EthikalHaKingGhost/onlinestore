<?php
	
	# Access session.
	session_start() ;

	# Redirect if not logged in.
	if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

	# Set page title and display header section.
	$page_title = 'Product Details' ;

	include ( 'includes/header.php' ) ;

		require 'connect_db.php';

	if (isset($_GET["pid"])){

		$idforpro = $_GET["pid"];
		
		$idforprosql = "SELECT product_name, category, product_category.category_id FROM products, product_category, category_assign WHERE products.product_id = '$idforpro' AND product_category.category_id = category_assign.category_id AND products.product_id = category_assign.product_id";

		$idforproresult = mysqli_query($dbc, $idforprosql);

		if (mysqli_num_rows($idforproresult) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($idforproresult)) {
			

			$nameforcat = $row["product_name"];
			$catforpro = $row["category"];
			$catid = $row['category_id'];

		}
		

}
mysqli_close($dbc);
}

	?>



 <div class="row">
        <div class="col-md-12 pt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light rounded-0">
                    <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="shop.php" class="text-decoration-none text-dark">Shop</a></li>
                    <li class="breadcrumb-item"><a href="shop.php?cid=<?php echo $catid; ?>" class="text-decoration-none text-dark"><?php echo $catforpro ?></a></li>
                    <li class="breadcrumb-item active text-danger font-weight-bold" aria-current="page"><?php echo $nameforcat; ?></li>
                </ol>
            </nav>
        </div>
    </div>


	<?php




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

	$query = "SELECT * FROM products, product_category, category_assign, images  WHERE products.product_id = '$product_id' AND products.product_id = images.product_id  AND product_category.category_id = category_assign.category_id AND products.product_id = category_assign.product_id";
	
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
                  $image_1 = $row["image_1"];
                  $image_2 = $row["image_2"];
                  $image_3 = $row["image_3"];
        

		}

		else {
			echo "no data to display";
		}

		?>


<!--- image slider for detail page ---->


		<div class="container-fluid pt-5 text-dark">

		<div class="row m-0 p-0">
		<!-- creating structure for single item -->
<div class="col-md-5 m-0 p-0 justify-content-center">

<div class=" m-0 p-0 row">


<!-------------------- Image carousel for products ------------------>

			<div class="col-md-3 pl-3 justify-content-center">

			<div class="row pl-5 pb-2"><a class="img1" href="images/<?php echo $image_1 ?>" target="imgBox"><img width="80" height="80" class="img-thumbnail" src="images/<?php echo $image_1 ?>"></a></div>

			<div class="row pl-5 pb-2"><a class="img1" href="images/<?php echo $image_2 ?>" target="imgBox"><img width="80" height="80" class="img-thumbnail" src="images/<?php echo $image_2 ?>"></a></div>

			<div class="row pl-5 pb-2"><a class="img1" href="images/<?php echo $image_3 ?>" target="imgBox"><img width="80" height="80" class="img-thumbnail" src="images/<?php echo $image_3 ?>"></a>

			</div>
			</div>

			<div class="col-md-9 p-0 m-0 imgBox">
			<img class="img-thumbnail p-0 m-0" src="images/<?php echo $image_1 ?>" width="400" height="400"/>
			</div>
			</div>
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
		
		<div class="col-md-3 pl-3">
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


<!----JQuery for Product images and thumbnails----->

<script type="text/javascript">

//setting up function
$(document).ready(function(){ 

//mouse hover to activate function
$('.img1').mouseover(function(e){ 
e.preventDefault();

//change the image in the image box 
$('.imgBox img').attr("src", $(this).attr("href")); 
  });
  
});
</script>