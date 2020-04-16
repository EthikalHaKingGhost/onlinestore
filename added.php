<?php # DISPLAY SHOPPING CART ADDITIONS PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Cart Addition' ;

include ( 'includes/header.php' ) ;

# Get passed product id and assign it to a variable.
if ( isset( $_GET['add'] ) ) $pid = $_GET['add'] ; 

# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve selective item data from 'shop' database table. 
$query = "SELECT * FROM products WHERE product_id = $pid" ;

$result = mysqli_query( $dbc, $query ) ;

if ( mysqli_num_rows( $result ) == 1 )
{
  $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );

  # Check cart for product

  if ( isset( $_SESSION['cart'][$pid] ) )

  { 

    # Add one more of this product.
    $_SESSION['cart'][$pid]['quantity']++; 





    echo '<p>Another '.$row["product_name"].' has been added to your cart</p>';



  } 

  else


  {




    # Or add one of this product to the cart.
    $_SESSION['cart'][$pid]= array ( 'quantity' => 1, 'price' => $row['product_price'] ) ;
    echo '<p>A '.$row["product_name"].' has been added to your cart</p>' ;


    
  }
}

# Close database connection.
mysqli_close($dbc);

# Create navigation links.
echo '<p><a href="shop.php">Shop</a> | <a href="cart.php">View Cart</a> | <a href="forum.php">Forum</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;

# Display footer section.
include ( 'includes/footer.php' ) ;

?>