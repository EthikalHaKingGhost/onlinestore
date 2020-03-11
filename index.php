

<?Php

session_start();

include "header.php"; ?>

  <ul class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#" class="breadcrumb-link">Home</a>
  </li>
  <li class="breadcrumb-item">
    <a href="#" class="breadcrumb-link">Products</a>
  </li>
  <li class="breadcrumbs-item">
    <a href="#" class="breadcrumb-link-active">iPhone</a>
  </li>
</ul>

  <h1 style="text-align: center;">Product Listing</h1>
    <p style="text-align: center;"> Shop and see some of our best deals!</p>

<ul class="products">

<?php include 'connect_db.php';

  //access products table from database
  $sql ="SELECT * FROM `products`";

      //create query to execute sql on database
      $query = mysqli_query($dbconnect, $sql);

    //statement to display day under condition
          if($query){
            //loop each row
            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
              //create variables for each field

                  $product_id = $row["product_id"];
                  $product_name =$row["product_name"];
                  $product_details = $row["product_details"];
                  $product_image = $row["product_image"];
                  $product_price =$row["product_price"];
                  $sale_price = $row["sale_price"];
                  $product_type = $row["product_type"];
                  $link = "details.php?pid=$product_id";

?>

    <li>
      <img class="responsive" src=images/<?php echo $product_image;?> alt="image">
        <p class="info"><a href="<?php echo $link ?>" class="btn-card"><?php echo $product_name; ?></a></p>
        <h5 class="info">Type: <?php echo $product_type; ?></h5>
        <h5 class="info">Price: $<?php echo $product_price; ?> TTD</h5>
    </li>

<?php

          /*<p class="detail"> <?php echo $product_details; ?></p> */

        }

      } else {
              echo "Site is under maintenance";
}

?>
</ul>

<?php include 'footer.php'; ?>
