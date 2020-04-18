<?php include "connect_db.php"; ?>


<div class="container text-dark pb-5">

    <h5 class="pt-5 pb-0 mb-0">Latest Arrivals</h5>
    <label class="figure-caption">View our Latest products</label>
    <hr>
    <div class="row text-centerp-5">


<?php

$sql ="SELECT * FROM `products` WHERE sale_price ORDER BY `products`.`sale_price` DESC LIMIT 4";

      $result = mysqli_query($dbc, $sql);

          if($result){
     
            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
          
          $product_id = $row["product_id"];
          $product_name =$row["product_name"];
          $product_details = $row["product_details"];
          $product_image = $row["product_image"];
          $product_price =$row["product_price"];
          $sale_price = $row["sale_price"];
          $link = "product_details.php?pid=$product_id";
          $sale = (($product_price/$sale_price) * (100/10));


?>


  <div class="col-md-3 text-center">
            
            <br/>
            <img class="img-thumbnail" src="images/<?php echo $product_image;?>" width="150" height="150" alt="phone">
            <br/>
            <h5><?php echo $product_name; ?></h5>
            <a href="<?php echo $link ?>" class="btn btn-dark text-light">View Product<br/></a>
          </div>

<?php

    }
        } else {echo "Site is under maintenance";}

    ?>
      
</div>
</div>