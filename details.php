<?php 

session_start();

if(isset($_GET["pid"])){
    $product_id = $_GET["pid"];
}else{

    echo "Wrong url address, enroll id missing";

    exit();
}


include 'header.php'; ?>

<?php include 'connect_db.php';

  //access products table from database
  $sql ="SELECT * FROM `products` WHERE products.product_id = $product_id";

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

?>

    <li>
      <img class="responsive" src=images/<?php echo $product_image;?> alt="image">
        <p class="info"><?php echo $product_name; ?></a></p>
        <p class="detail"> <?php echo $product_details; ?></p> 
        <h5 class="info">Type: <?php echo $product_type; ?></h5>
        <h5 class="info">Price: $<?php echo $product_price; ?> TTD</h5>
    </li>

<?php

    }

      } else {
              echo "Site is under maintenance";
}



include 'footer.php'; ?>