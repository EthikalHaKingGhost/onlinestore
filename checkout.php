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

  $fullname = $_SESSION["first_name"]." ".$_SESSION["last_name"];

  $activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `activity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '$order_id', 'placeorder', current_timestamp());";

  $activity_qry = mysqli_query($dbc, $activity);
  
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

?>

<div class="container-fluid bg-light">
  <div class="display-4 text-center">Thank You For Your Order!</div>
  <div class="text-center text-muted"> We appreciate wonderful customers like you. At Topcellers we value every purchase.</div>
  <div class="spaceer pb-5"></div>
<div class="col-md-6 offset-md-3">
<ul class="list-group bg-white">
<li class="list-group-item bg-danger text-white" aria-disabled="true"><label class="font-weight-bold h5">Order Confirmation</label>

  <a href="shop.php"  class="btn btn-sm btn-light text-dark text-decoration-none">continue Shopping</a>
  <a href="trackorders.php"  class="btn btn-sm btn-warning text-light text-decoration-none">View Orders</a>

  <label class="float-right h5"><?php echo "#".$order_id ?></label></li>
                       
<?php

require ('connect_db.php');

    $orderdetails = "SELECT * FROM `orders`, products, order_contents, images WHERE images.product_id = products.product_id AND products.product_id = order_contents.product_id AND order_contents.order_id = orders.order_id AND orders.order_id = '$order_id'";

                  $orderqry = mysqli_query($dbc, $orderdetails);

                   if($orderqry){

                  while($row = mysqli_fetch_array($orderqry,MYSQLI_ASSOC)){

                          $total = $row["total"];
                          $name = $row["product_name"];
                          $battery = $row["battery_size"];
                          $camera = $row["camera_pixels"];
                          $ram = $row["ram"];
                          $quantity = $row["quantity"];
                          $image1 = $row["image_1"];

                          $price = $row["price"];
                          $fullprice = $row["product_price"];
                          $discount = $fullprice - $price;

                          $id = $row["product_id"];


                          ?>


                        <li class="list-group-item list-group-item-action">
                        <div class="row">
                        <div class="col-md-2">
                        <img src="<?php echo $image1 ?>" class="img-fluid" href="product_details.php?pid=<?php echo $id ?>">
                        </div>

                        <div class="col-md-10">

                        <div class="h6 font-weight-bold"><?php echo "$name" . ", " . "$battery" . ", "."$camera". ", " . "$ram"; ?></div>
                        <div class="h6"><?php echo '$'.number_format($price, 2). ' X ' .$quantity; ?></div>
                        <label class="text-muted small font-italic">
                          <?php

                          if ($price != $fullprice  ){
                               echo 'You saved $' .number_format($discount, 2);
                           }else{
                              echo "Purchased fullprice";
                           }
                         ?>
                         </label>
                         <div><a href="product_details.php?pid=<?php echo $id ?>" class="text-decoration-none text-danger">View item</a></div>
                      </div>
                      </div>
                      </li>

                          <?php

                        }
                      }

                      ?>
                      <li class="list-group-item bg-danger text-white"><label class="font-weight-bold h5">Total</label> <label class="float-right h5">$ <?php echo number_format($total, 2); ?></label></li>
                      </ul>
                      </div>

<?php



 # Remove cart items.  
  $_SESSION['cart'] = NULL ;

#remove total price
  $_SESSION["total_price"] = NULL;


}
# Or display a message.
else { 

echo ' <section class="slice sct-color-1">
                        <div class="container pb-5">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="text-center">
                                        <div class="d-block p-2">
                                            <i class="fab fa-shopify  fa-5x"></i>
                                        </div>
                                        <h2 class="heading heading-3 strong-600">Your cart is empty.</h2>
                                        <p class="mt-5 px-5">
                                            Your cart is currently empty. Return to our shop and check out the latest offers.
                                            We have some great items that are waiting for you.
                                        </p>
                                        <a href="shop.php" class="btn btn-grad btn-lg mt-4">
                                            Go shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>' ;

 }

  # Close database connection.
  mysqli_close($dbc);

# Create navigation links.
echo '<p><a href="shop.php">Shop</a> | <a href="forum.php">Forum</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;
?>
</div>
<?Php
# Display footer section.
include ( 'includes/footer.php' ) ;

?>