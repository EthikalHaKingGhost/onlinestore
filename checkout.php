<?php # DISPLAY CHECKOUT PAGE.

# Access session.
session_start() ;



# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Checkout' ;

include ( 'includes/header.php' ) ;

# Check for passed total and cart.
if ( isset( $_GET['total'] ) && ( $_GET['total'] > 0 ) && (!empty($_SESSION['cart']) ) )
{

  # Open database connection.
  require ('connect_db.php');
  
  # Store buyer and order total in 'orders' database table.
  $ordersql = "INSERT INTO orders ( user_id, total, order_date ) VALUES (". $_SESSION['user_id'].",".$_GET['total'].", NOW() ) ";

  $orderqry = mysqli_query ($dbc, $ordersql);
  
  # Retrieve current order number.
  $order_id = mysqli_insert_id($dbc) ;
  
  # Retrieve cart items from 'shop' database table.
  $productsql = "SELECT * FROM products WHERE product_id IN (";
  foreach ($_SESSION['cart'] as $pid => $value) { $productsql .= $pid . ','; }


  $productsql = substr( $productsql, 0, -1 ) . ') ORDER BY product_id ASC';
  $productres = mysqli_query ($dbc, $productsql);

  # Store order contents in 'order_contents' database table.
  while ($row = mysqli_fetch_array ($productres, MYSQLI_ASSOC))
  {

    $query = "INSERT INTO order_contents (order_id, product_id, quantity, price )
    VALUES ( $order_id, ".$row['product_id'].",".$_SESSION['cart'][$row['product_id']]['quantity'].",".$_SESSION['cart'][$row['product_id']]['price'].")" ;

    $result = mysqli_query($dbc, $query);
  }
  
  # Close database connection.
  mysqli_close($dbc);

  # Display order number.
  echo "<p>Thanks for your order. Your Order Number Is #".$order_id."</p>";

  # Remove cart items.  
  $_SESSION['cart'] = NULL ;
}
# Or display a message.
else { echo '<p>There are no items in your cart.</p>' ;

 }

# Create navigation links.
echo '<p><a href="shop.php">Shop</a> | <a href="forum.php">Forum</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;

# Display footer section.
include ( 'includes/footer.php' ) ;

?>