<?php 

include 'connect_db.php';

//access products table
$sql ="SELECT * FROM products";

//create query to execute sql on database
$query = mysqli_query($dbconnect, $sql);


?>

<?Php include "header.php"; ?>


<div class="container">
  <h1>Product Listing</h1>


  <hr>
  

<ul class="products">
<?php

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

?>

  <li>
    <img class="responsive" src=images/<?php echo $product_image;?> alt="image">
      <h4 class="name"><?php echo $product_name; ?></h4>
      <p class="detail"><?php echo $product_details; ?></p>
      <h5 class="info">Type: <?php echo $product_type; ?></h5>
      <h5 class="info">Price: <?php echo $product_price; ?></h5>
  </li>

<?php

  }

} else {
        echo "error with query";
    }

?>
</ul>
</div>

</body>
</html>
