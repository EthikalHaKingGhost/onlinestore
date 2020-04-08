<?php 

# Access session.
session_start() ; 

# Set page title and display header section.
$page_title = 'Home'; ?>


<?php 
include ( 'includes/topbar.php' );


include ( 'includes/header.php' );



include ('includes/slider1.php'); ?>


<!--------------------->

<div class="jumbotron jumbotron-fluid bg-dark text-light">
  <div class="container">
    <h3 class="display-5">Call US NOW</h3>
    <p class="lead">Our contact team is always available for your needs, contact us anytime at +1-868-567-6878 or send us a message!</p>
    <a href="contactus.php"><button class="btn btn-success btn-lg">Message</button></a>
  </div>
</div>


<!--------------------->

<?php include "connect_db.php"; ?>


<div class="container pb-5">
	<h1 class="text-center pb-4">LATEST RELEASED PRODUCTS</h1>
	<div class="row">

<?php

$sql ="SELECT * FROM `products` WHERE sale_price ORDER BY `products`.`sale_price` DESC LIMIT 4";

      $result = mysqli_query($dbc, $sql);

          if($result){
     
            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
          
          $product_id = $row["product_id"];
          $product_name =$row["product_name"];
          $product_details = $row["product_details"];
          $product_image = $row["product_image"];
          $product_price =$row["product_price"];
          $sale_price = $row["sale_price"];
          $product_type = $row["product_type"];
          $link = "shop.php?pid=$product_id";
          $sale = (($product_price/$sale_price) * (100/10));


?>

    <div class="col-md-3">
    	<a class="detail-link" href="<?php echo $link ?>">
			<div class="card rounded-0 border-0">
				<div class="card-body">
					<img src="images/<?php echo $product_image;?>" class="img-fluid" alt="iphone">
					<div class="text-center p-3 text-dark"><strong><?php echo $product_name; ?></strong></div>
					<div class="card-footer bg-dark rounded-lg pb-4 pt-0">
					<div class="float-left text-white"><strong>$<?php echo $product_price; ?></strong></div>	
					<div class="float-right text-warning"><strong><?php 

          		if($product_price < $sale_price){

                    echo '';

          		}else if($sale == 0){

                    echo '';

                }else{

                    echo round($sale); 
                }

        	?>% OFF</strong></div>
			</div>
		</div>
	</div>
  </div>

<?php

    }
        } else {echo "Site is under maintenance";}

    ?>
      
</div>
</div>

<?php include ( 'includes/footer.php' ) ;
?>