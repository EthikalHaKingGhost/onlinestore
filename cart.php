<?php # DISPLAY SHOPPING CART PAGE.

# Access session.
session_start() ;
 
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Cart' ;

include ( 'includes/header.php' ) ;


?>
 <div class="row">
        <div class="col-md-12 pt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light rounded-0">
                    <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="shop.php" class="text-decoration-none text-dark">Shop</a></li>
                    <li class="breadcrumb-item active text-danger font-weight-bold" aria-current="page">Shopping Cart</li>
                </ol>
            </nav>
        </div>
    </div>

<?php

# Check if form has been submitted for update.
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{


  # Update changed quantity field values.
  foreach ( $_POST['qty'] as $product_id => $product_qty )
  {
    # Ensure values are integers.
    $pid = (int) $product_id;
    $qty = (int) $product_qty;

    # Change quantity or delete if zero.
    if ( $qty == 0 or $qty < 0){ unset ($_SESSION['cart'][$pid]); } 
    elseif ( $qty > 0 ) { $_SESSION['cart'][$pid]['quantity'] = $qty; }
  }
}

# Initialize grand total variable.
$total = 0; 

# Display the cart if not empty.
if (!empty($_SESSION['cart']))
{

  # Connect to the database.
  require ('connect_db.php');
  

  # Retrieve all items in the cart from the 'shop' database table.
  $query = "SELECT * FROM products WHERE product_id IN (";
  foreach ($_SESSION['cart'] as $pid => $value) { $query .= $pid . ','; }
  $query = substr( $query, 0, -1 ) . ') ORDER BY product_id ASC';
  $result = mysqli_query ($dbc, $query);

?>

<form action="cart.php" method="post">
  <div class="container pb-5">
   <div class="card shopping-cart">
            <div class="card-header bg-dark text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Shipping cart
                <a href="shop.php" class="btn btn-grad btn-sm pull-right">Continiue shopping</a>
                <div class="clearfix"></div>
            </div>
            <div class="card-body p-5">

<?php
 
  while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC))

  {
    # Calculate sub-totals and grand total.
    $subtotal = $_SESSION['cart'][$row['product_id']]['quantity'] * $_SESSION['cart'][$row['product_id']]['price'];
    $total += $subtotal;
    $id = $row['product_id'];
    $link = "product_details.php?pid=$id";
    $image = $row['product_image'];
    $name =  $row['product_name'];
   $new_quantity =  "qty[{$row["product_id"]}]";
   $quantity = $_SESSION['cart'][$row['product_id']]['quantity'];
  $price =  $row['product_price'];
  $newsubtotal = number_format($subtotal, 2); 
  $_SESSION['total_price'] = number_format($total, 2);


    # Display the rows:

?>
<div class="row">
  <div class="col-md-2 py-2">
    <a href="<?php echo $link; ?> " title="View Details">
      <img src="images/<?php echo $image ?>" width="100" height="100" style="margin-bottom:15px;">
        </a>
    </div>

    <div class="col-md-10">
      <div class="row py-5 border-top">
  <div class="col-md-3">
    <span class="font-weight-bold h5"><?php echo $name; ?> </span>
    </div>
    
<label class="">Qty</label>
    <div class="col-sm-2">
      <input class="form-control form-control-sm text-center" type="number" 
      name="<?php echo $new_quantity; ?>" 
      value="<?php echo $quantity; ?>" 
      title="A zero value removes this item">
  </div>

  <div class="col-md-1 text-right">
  <i class="fas fa-times"></i>
  </div>

    <div class="col-md-2 text-right">
      
      <?php echo number_format($price, 2); ?>

    </div>

    <div class="col-md-3 text-right"> 
     <?php echo "$". number_format($subtotal, 2); ?>
    </div>
  </div>
</div>
</div>
</div>


  <?php
  
  }
  
  # Close the database connection.
  mysqli_close($dbc); 


# Display the total.
  ?> 
  
<div class="card-footer">
 <div class="row">
  
  <div class="col-md-3">
    <input type="submit" class="btn btn-grad" name="submit" value="Update My Cart">
</div>

 
<div class="col-md-7 p-0 my-auto">
  <span class="float-right">
    Total = <em class=" font-weight-bold">$<?php echo number_format($total, 2); ?></em></span>
 </div>

 <div class="col-md-2 pl-2">
    <a href="checkout.php?total=<?php echo $total; ?>" class="btn btn-success text-white">Checkout<i class="fas fa-cart-arrow-down"></i></a>
</div>

</div>
</div>

</div>
</div>
</form>

<?php

}


else


{ 

?>

 <section class="slice sct-color-1">
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
                    </section>


<?php

}

?>


<?php 

include ( 'includes/footer.php' ) ;

?>