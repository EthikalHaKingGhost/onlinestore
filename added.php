<?php # DISPLAY SHOPPING CART ADDITIONS PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Cart Addition' ;

include ( 'includes/header.php' ) ;

# Get passed product id and assign it to a variable.
if ( isset( $_GET['add'] ) )

  $pid = $_GET['add'] ; 

  $qnty =  $_GET['qnty'] ; 


if(!empty($_GET['qnty'])){

# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve selective item data from 'shop' database table. 
$query = "SELECT * FROM products WHERE product_id = $pid" ;

$result = mysqli_query( $dbc, $query ) ;

if ( mysqli_num_rows( $result ) == 1 )
{
  $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );

  # Check cart for product

  if ( isset( $_SESSION['cart'][$pid]) )

  { 

  # Add one more of this product.

    $_SESSION['cart'][$pid]['quantity'] = $_SESSION['cart'][$pid]['quantity'] + $qnty; 


  echo ' <section class="slice sct-color-1">
                        <div class="container pb-5">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="text-center">
                                        <div class="d-block p-2">
                                            <i class="fas fa-cart-plus fa-5x"></i>
                                        <h2 class="heading heading-3 strong-600">Item Added!</h2>
                                        <p class="mt-3 px-5">'. $qnty.' more '.$row["product_name"].'(s) has been added to your cart</p>
                                        <a href="shop.php" class="btn btn-grad btn-md mt-4">
                                            Continue shopping
                                        </a>
                                        <a href="cart.php" class="btn btn-primary text-white btn-md mt-4">
                                            Go to cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>' ;

  } 

  else

  {


//sale price is used if there is a sale on the product

    if ($row['sale_price'] > 0) {

      $price = $row['sale_price'];
      
    }else{

      $price = $row['product_price'];
    }


    $time = time();

    # Or add one of this product to the cart.
    $_SESSION['cart'][$pid]= array( 'quantity' => $qnty, 'price' => $price) ;


    echo ' <section class="slice sct-color-1">
                        <div class="container pb-5">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="text-center">
                                        <div class="d-block p-2">
                                         <i class="fas fa-cart-plus fa-5x"></i></div>
                                        <h2 class="heading heading-3 strong-600">Item Added!</h2>
                                        <p class="mt-3 px-5"> '.$row["product_name"].' has been added to your cart</p>
                                        <a href="shop.php" class="btn btn-grad btn-md mt-4">
                                            continue shopping
                                        </a>
                                        <a href="cart.php" class="btn btn-primary text-white btn-md mt-4">
                                            Go to cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>' ;
    
  }

}

# Close database connection.
mysqli_close($dbc);

}else{

  echo '    <section class="slice sct-color-1">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="text-center">
                                        <div class="d-block p-2"> 
                                            <i class="fas fa-times fa-5x"></i>
                                        </div>
                                        <h2 class="heading heading-3 strong-600">OOPS!</h2>
                                        <p class="mt-3 px-5">
                                            Please select the number of products you would like to purchase!
                                        </p>
                                        <button class="btn btn-danger" onclick="history.go(-1)"; ><i class="fas fa-backward"></i> Previous Page</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>';

  
  exit();
}


# Create navigation links.
echo '<p><a href="shop.php">Shop</a> | <a href="cart.php">View Cart</a> | <a href="forum.php">Forum</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;

# Display footer section.
include ( 'includes/footer.php' ) ;

?>