<?php # DISPLAY COMPLETE PRODUCTS PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Shop' ;

include ('includes/header.php' ) ;

require ( 'connect_db.php' ) ;

# Retrieve items from 'shop' database table.
 ?>

<div class="container shop-container pt-5">
		
	<div class="row">
		<div class="col-md-12 pt-3">
			<nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white rounded-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="category.html">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sub-category</li>
                </ol>
            </nav>
		</div>
		<div class="col-md-3">
			<div class="card rounded-0">
                <div class="card-header text-center bg-dark text-white text-uppercase rounded-0"><i class="fa fa-list"></i> Categories</div>
                <ul class="list-group rounded-0 category_block">

                <?php 

                $query = "SELECT product_id FROM products";

                if ($result=mysqli_query($dbc,$query))

                  {
                  // Return the number of rows in result set
                  $rowcount=mysqli_num_rows($result);

                  mysqli_free_result($result);

                  }

                ?>

                    <a href="shop.php" class="text-decoration-none"><li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded-0">All Phones<span class="badge badge-danger badge-pill"><?php echo $rowcount ?></span></li></a>

                    
                <?php 



                $query = "SELECT *, (SELECT COUNT(*) FROM products WHERE products.category_id = product_category.category_id) num FROM product_category";

                $result = mysqli_query($dbc, $query);

                if (mysqli_num_rows($result) > 0) {


                    while($row = mysqli_fetch_assoc($result)) {

                        $category_id = $row["category_id"];
                        $category = $row["category"];
                        $numofprod = $row["num"];
                        $link_cat = "shop.php?cid=$category_id";
                ?>

                    <a href="<?php echo $link_cat ?>" class="text-decoration-none"><li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded-0"><?php echo $category; ?><span class="badge badge-danger badge-pill"><?php echo $numofprod; ?></span></li></a>

                <?php

                        }
                    }

                ?>
                    
           </ul>
        </div>
    </div>     

		<div class="col-md-9">
			<div class="row">
				

				<div class="col-md-12">
					<ul class="list-group">
                
<?php 

if (isset($_GET["cid"])) {

    $cat_id = $_GET["cid"];

    $query = "SELECT * FROM products, product_category WHERE products.category_id = product_category.category_id AND product_category.category_id = $cat_id"; 

}else{

    $query = "SELECT * FROM products";
}

$result = mysqli_query( $dbc, $query ) ;
if ( mysqli_num_rows( $result ) > 0 )
{


 if (isset($_GET["search"]) && $_GET["search"] != '') {

                             $search = $_GET["search"];

                                 $sql = "SELECT * FROM products, category WHERE product_name LIKE '%search%' OR product_details LIKE '%search%' category LIKE '%search%'";

                                $result = mysqli_query($dbc, $sql);

                                $searchquery = mysqli_num_rows($result);

                                if ( $searchquery == 0){


                                            $feeback = "There are no products found with <h6>" . "$search" . "</h6>";

                                            echo $feedback;



                                                }


                                    }



  while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ))
  {

        $product_id = $row["product_id"];
        $product_name =$row["product_name"];
        $product_details = $row["product_details"];
        $image = $row["product_image"];
        $product_price =$row["product_price"];
        $sale_price = $row["sale_price"];
        $link = "product_details.php?pid=$product_id";
        $battery = $row["battery_size"];
        $camera = $row["camera_pixels"];
        $ram = $row["ram"];

        $sale = (($sale_price/$product_price) * (100/10));


?>
                <!-- list group item-->
                 <li class="list-group-item rounded-0">
                    <!-- Custom content-->
                        <div class="row"> 
                        <div class="col-md-3">
                            <a href="<?php echo $link ?>" class="text-decoration-none text-dark ">
                        <img src="<?php echo "images/"."$image" ?>" alt="phone" class="img-fluid">
                            </a>
                            </div>

                            <div class="col-md-9 m-0 p-0">
                            <a href="<?php echo $link ?>" class="text-decoration-none text-dark">
                                <h6 class="font-weight-bold mb-2"><?php echo "$product_name" . ", " . "$battery".", " . "$camera" . ", " . " $ram " . "()" ?></h6>
                            </a>

                             <ul class="list-inline small">
                                <a href="#" class="text-decoration-none text-dark">
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item ml-1">34</li>
                                </a>
                            </ul>


                            <div class="d-flex align-items-center justify-content-between mt-1 text-dark">
                                <h6 class="font-weight-bold my-2">
                        <?php  
                                #echo sale price if there is a sale
                                if ($sale_price > 0) {
                                    
                                   echo "$" . "$sale_price";
                                    
                                }else{

                                   echo "$" . "$product_price";
                                }

                                 ?>
                                     
                                 </h6>
                            </div>

                        <?php 

                        #check if product has a discout and display with code to prevent displaying over 100% sale.

                          if($product_price < $sale_price) {

                                    echo '';

                          }else if($sale == 0){

                                    echo '';

                          }else{

                        ?>

                        <span class="badge badge-danger font-weight-bold"><?php echo "$" . round($sale) . "% OFF"; ?></span>

                        <?php

                          }

                       ?>
   
                        </div>
                    </div> <!-- End -->
                </li>
            </a><!-- End -->


                    <?php


                    }

                     # Close database connection.
                      mysqli_close( $dbc ) ; 

                    }

                        # Or display message.
                        else { echo '<p>There are currently no items in this shop.</p>' ; }

                    ?>
              
           		</ul>
                <!-- list group item -->
				</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php 

include ( 'includes/latest_arrivals.php' ) ;


include ( 'includes/footer.php' ) ;


?>











