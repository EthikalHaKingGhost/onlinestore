<?php 
session_start();

if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

$page_title = "Orders Tracking";

include 'includes/header.php'; 

?>

<div class="container-fluid">
<div class="display-4 text-center">Track Your Orders</div>
<hr>

                <div class="col-md-8 offset-md-2 p-5">

                <div class="container">

                <div class="row">
                    <div class="col-sm-2"> 
                    </div>
                    <div class="col-sm my-auto font-weight-bold">
                      <p class="">Product</p>
                    </div>
                    <div class="col-sm my-auto font-weight-bold">
                      <p class="">Cost </p>
                    </div>
                    <div class="col-sm my-auto font-weight-bold">
                      <p class="">Date Purchase</p>
                    </div>
                </div>


<?php

require ('connect_db.php');

    $orderdetails = "SELECT * FROM `orders`, products, order_contents, images WHERE products.product_id = images.product_id AND products.product_id = order_contents.product_id AND order_contents.order_id = orders.order_id AND orders.user_id = {$_SESSION['user_id']} ORDER BY `orders`.`order_date` DESC LIMIT 15";


                  $orderqry = mysqli_query($dbc, $orderdetails);

                   if($orderqry){

                  while($row = mysqli_fetch_array($orderqry, MYSQLI_ASSOC)){


                    $order_date = $row["order_date"];

                    $orderdate = date("M jS, Y H:i:s", strtotime("order_date")); 

                ?>

                <div class="row border border-right-0 border-left-0 border-bottom-0 border-right-0">
                    <div class="col-sm-2">
                      <img src="<?php echo $row['images_1'];?>" class="img-fluid">
                    </div>
                    <div class="col-sm my-auto">
                      <p class=""><?php echo $row["product_name"]; ?></p>
                    </div>
                    <div class="col-sm my-auto">
                      <p class=""><?php echo $row["price"]; ?></p>
                    </div>
                    <div class="col-sm my-auto">
                      <p class=""><?php echo $orderdate; ?></p>
                </div>
            </div>

        <?php
        }
        }
        ?>

                </div>
            </div>
            </div>

<?php include 'includes/footer.php'; ?>