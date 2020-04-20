<?php
	
	# Access session.
	session_start() ;

	# Redirect if not logged in.
	if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

	# Set page title and display header section.
	$page_title = 'Product Details' ;

	include ( 'includes/topbar.php' );

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
		echo '		<section class="slice sct-color-1">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="text-center">
                                        <div class="d-block p-2"> 
                                            <i class="fas fa-times text-danger fa-5x"></i>
                                        </div>
                                        <h2 class="heading heading-3 strong-600">OOPS!</h2>
                                        <p class="mt-5 px-5">
                                            No Parameter found on this page!
                                        </p>
                                        <button class="btn btn-danger" onclick="history.go(-1)"; ><i class="fas fa-backward"></i> Previous Page</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>';

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


//product add to cart create session for product quantity

?>

<!--- image slider for detail page ---->
<div class="container-fluid pt-3 text-dark">

<!--- Pagination for switching product ---->
  <div class="row">

          <?php 

  $dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());

  $sql ="SELECT * FROM products WHERE product_id < $product_id ORDER BY product_id DESC LIMIT 1";
      $query = mysqli_query($dbconnect, $sql);
          if($query){
            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                
              $prevproduct_id = $row["product_id"];

              }

              }

            ?>
<div class="col-md-12 pb-4">
<div class="float-right">
 <a href="product_details.php?pid=<?php echo $prevproduct_id; ?>" title="previous product" class="btn btn-dark rounded"><i class="fas fa-angle-left fa-2x text-light"></i></a>





<?php 

$dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());

  $sql ="SELECT * FROM products WHERE product_id > $product_id ORDER BY product_id ASC LIMIT 1";
      $query = mysqli_query($dbconnect, $sql);
          if($query){
            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                
              $nextproduct_id = $row["product_id"];

              }

              }

            ?>

<a href="product_details.php?pid=<?php echo $nextproduct_id; ?>" title="Next product" class="btn btn-dark rounded"><i class="fas fa-angle-right fa-2x text-light"></i></a>
</div>
</div>
</div>

<div class="row m-0 p-0">
		<!-- creating structure for single item -->
<div class="col-md-5 m-0 p-0 justify-content-center">

<div class=" m-0 p-0 row">

<!-------------------- Image carousel for products ------------------>

			<div class="col-md-3 pl-3 justify-content-center">

			<div class="row pl-5 pb-2 d-none d-lg-block"><a class="img1" href="images/<?php echo $image_1 ?>" target="imgBox"><img width="80" height="80" class="img-thumbnail" src="images/<?php echo $image_1 ?>"></a></div>

			<div class="row pl-5 pb-2 d-none d-lg-block"><a class="img1" href="images/<?php echo $image_2 ?>" target="imgBox"><img width="80" height="80" class="img-thumbnail" src="images/<?php echo $image_2 ?>"></a></div>

			<div class="row pl-5 pb-2 d-none d-lg-block"><a class="img1" href="images/<?php echo $image_3 ?>" target="imgBox"><img width="80" height="80" class="img-thumbnail" src="images/<?php echo $image_3 ?>"></a>

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


		<div class="col-md-3">


			<div class="card">
				


			  	<div class="card-body text-dark">



			  	
				<div class="card-title font-weight-bold font-italic text-danger">Brand: <?php echo $category; ?></div>
				

				<h6>Product will be Shipped to:</h6>

				<hr>

				<p class="figure-caption">
				Address: <?php echo  $_SESSION["address"]; ?>
				</p>


				<p class="figure-caption">
				Address #2: <?php echo  $_SESSION["address2"]; ?>
				</p>

				
				<p class="figure-caption">
				Country: <?php echo  $_SESSION["country"]; ?>
				</p>

				<p class="figure-caption">
				City: <?php echo  $_SESSION["city"]; ?>
				</p>

				<hr>

				<div class="font-weight-bold">

				<?php 

                    if($sale_price <> 0 ){

                    echo '<s class="text-dark h5"> $'.$product_price. ' TTD </s>';

                  }else{

                    echo '<span class="text-dark font-weight-bold h5"> $'.$product_price. ' TTD </span>'; 
                    
                  }
                  ?>

               </div>



        <!----remove sale price when value is 0 ------>

            <h5 class="text-danger font-weight-bold"> 
                    <?php 

                    if($sale_price != 0){

                    	echo '$'.$sale_price .' TTD'; 

                      }else{

                        echo "";
                      }

                      ?>

            </h5>
         </div>

 

           <form action="added.php" method="get">
          
			<div class="text-center">
  			  <label>Quantity</label>
  			  	<div class="col-md-4 offset-md-4"> 
				  <input for="cartitems" class="form-control form-control-sm text-center" value="1" type="number" name="qnty" title="set number of products">
				</div>
			</div>

			 <hr>

			  
				<button class="btn btn-warning btn-sm btn-block text-light" type="submit" id="cartitems" name="add" value="<?php echo $product_id ?>">Add to Cart</button>
			

				<a href="shop.php" class="btn btn-danger btn-sm text-white btn-block">Continue Shopping</a>
		

		 </form>
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

		<h5 class="pt-5 pb-0 mb-0">Product Discussion</h5>
		<label class="figure-caption">Discuss our product</label>
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