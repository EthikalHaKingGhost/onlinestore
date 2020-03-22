<?php 

session_start();


if(isset($_GET["pid"])){
    $product_id = $_GET["pid"];
}else{

    echo "Wrong url address, enroll id missing";

    exit();
}


if(isset($_POST["addtocart"])){


  echo "<div class='message'>
        <div class='alert alert-success alert-dismissible' name='alerts'>
            <a href='details.php?pid=$product_id' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong> Message! </strong> Added to Cart succesfully
        </div>
      </div>";

}


?>


 <html>
    <head>
        <title>Products Home</title>
          <link href="style.css" rel="stylesheet" >
        <!---script to add icons to page-->
        <link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">
    </head>
        <body>

          <div class="header-banner">
            <b>Email:</b>topcellers@mail.com <b>Phone:</b>1-868-726-7856 <b>Fax:</b>1-868-345-3425
          </div>

           <header class="main-header">
            <!--image logo with link to home(index) page-->  
              <div>
             <a href="homepage.php">
            <img src=" images/logo.png" class="logo" >
            </a>
          </div>

          <ul class="main-nav">
            <li><a href="homepage.php"><i class="fas fa-home"></i> HOME</a></li>
            <li class="dropdown">
              <a href="index.php"><i class="fa fa-shopping-basket"></i> SHOP</a>
            </li>
          </ul>

  


        </header>



<!-- breadcrumb for navigation -->

<?php 

  $dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());

  //access products table from database
  $sql ="SELECT * FROM `products` WHERE product_id = $product_id";

      //create query to execute sql on database
      $query = mysqli_query($dbconnect, $sql);

    //statement to display day under condition
          if($query){
            //loop each row
            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
              //create variables for each field

                  $product_name =$row["product_name"];
                  $product_type = $row["product_type"];

                }
                } else {echo "Site is under maintenance";}
            ?>

      <ul class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="homepage.php" class="breadcrumb-link">Home</a>
          </li>
          <li class="breadcrumb-item">
              <a href="index.php" class="breadcrumb-link">Products</a>
          </li>
          <!-- <li class="breadcrumb-item">
              <a href="index.php" class="breadcrumb-link"><?php echo $product_type; ?></a> --->
          </li>
          <li class="breadcrumbs-item">
              <a href="" class="breadcrumb-link-active"><?php echo $product_name; ?></a>
          </li>
      </ul>
      <br>

<!------end of bread crumb ----->
<?php 

  $dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());


  //access products table from database
  $sql ="SELECT * FROM products, images 
  WHERE products.product_id = images.product_id 
  AND products.product_id = $product_id";

      //create query to execute sql on database
      $query = mysqli_query($dbconnect, $sql);

    //statement to display day under condition
          if($query){
            //loop each row
            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
              //create variables for each field

                  $product_name =$row["product_name"];
                  $product_details = $row["product_details"];
                  $ram = $row["ram"];
                  $battery_size = $row["battery_size"];
                  $screen_size = $row["screen_size"];
                  $camera_pixels = $row["camera_pixels"];
                  $product_image = $row["product_image"];
                  $product_price =$row["product_price"];
                  $sale_price = $row["sale_price"];
                  $product_type = $row["product_type"];
                  $image_1 = $row["image_1"];
                  $image_2 = $row["image_2"];
                  $image_3 = $row["image_3"];
        
              }
              } else {
                echo "Site is under maintenance";
              }
          ?>   


<!--- image slider for detail page ---->

  <div class="card-block">
  <div class="prod-card">     
<div class="container">
    <ul class="thumb">

      <li><a class="img1" href="images/<?php echo $image_1; ?>" target="imgBox"><img src="images/<?php echo $image_1; ?>"></a></li>

      <li><a class="img1" href="images/<?php echo $image_2; ?>" target="imgBox"><img src="images/<?php echo $image_2; ?>"></a></li>

      <li><a class="img1" href="images/<?php echo $image_3; ?>" target="imgBox"><img src="images/<?php echo $image_3; ?>"></a></li>
    </ul>
    <div class="imgBox"><img src="images/<?php echo $product_image; ?>"></div>
  </div>

<!----JQuery for Product images and thumbnails----->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">

//setting up function
$(document).ready(function(){ 

//mouse hover to activate function
$('.thumb a').mouseover(function(e){ 
e.preventDefault();

//change the image in the image box 
$('.imgBox img').attr("src", $(this).attr("href")); 
  });
  
});
</script>



      <div class="prod-info">

        <h2><?php echo $product_name; ?></h2>

          <p class="desc"><?php echo $product_type; ?></p>

          <span class="price bouncein"><?php 
                    if($sale_price <> 0 ){

                    echo '<span class="price" style="text-decoration:line-through; color:black;"> $'.$product_price.' TTD </span>';

                  }else{
                    echo '<span class="price"  style="text-decoration:none; font-size:25px; 
                        font-weight: 900;"> $'.$product_price.'TTD </span>'; 
                    
                  }
                  ?>

        <!----remove sale price when value is 0 ------>

            <span style="color:#e74c3c;
                        font-size: 25px; 
                        font-weight: 900;"> 

                    <?php 

                    if($sale_price != 0){

                    echo '$'.$sale_price.' TTD'; 

                      }else{

                        echo "";
                      }

                      ?>
            </span>
          </span>




<!--------------product Storage size ---------------->

<h3>Available Capacity:</h3>
    <span>

                      <?php 

  $dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());


          //access products table from database
          $sql ="SELECT * FROM storage_sizes, product_storage, products 
          WHERE products.product_id = product_storage.product_id
          AND product_storage.storage_id = storage_sizes.storage_id  
          AND products.product_id = $product_id";

              //create query to execute sql on database
              $query = mysqli_query($dbconnect, $sql);

                //statement to display day under condition
                if($query){
                  //loop each row
                  while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                    //create variables for each field
                        $storage_id = $row["storage_id"];
                        $storagesize = $row["storagesize"];
                
                        ?>

                        <a class="storage" href="#"><?php echo $storagesize; ?></a>

                        <?php

                        }

                        }else{

                           echo "Site is under Maintenance";
                        }

                        ?>
 
  </span>


<!----------product colors--------------->

      <h3>Available Colors</h3>
      <span>

          <?php 

  $dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());


  //access products table from database
  $sql ="SELECT * FROM colors, product_color, products 
          WHERE products.product_id = product_color.product_id
          AND product_color.color_id = colors.color_id  
          AND products.product_id = $product_id";

      //create query to execute sql on database
      $query = mysqli_query($dbconnect, $sql);

    //statement to display day under condition
          if($query){
            //loop each row
            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
              //create variables for each field
                  $color_id = $row["color_id"];
                  $colorhex = $row["colorhex"];
                
              ?>

            <a class="colors" href="#" style="background-color:<?php echo $colorhex; ?>;"></a>

              <?php

              }

              }else{
                echo "Site is under maintencance";
              }

              ?>

          </span>


    <form method="post" action="details.php?pid=<?php echo $product_id; ?>">
       <button name="addtocart" class="addbtn"><i class="ion-android-cart"></i>Add to Cart</button>
    </form>        
  </div>
  <div class="pagination">

          <?php 

  $dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());

  $sql ="SELECT * FROM products WHERE product_id < $product_id ORDER BY product_id DESC LIMIT 1";
      $query = mysqli_query($dbconnect, $sql);
          if($query){
            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                
              $prevproduct_id = $row["product_id"];

              }

              }

            ?>

              <a href="details.php?pid=<?php echo $prevproduct_id; ?>" class="previous round"><i class="fas fa-angle-left"></i></a>





<?php 

$dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());

  $sql ="SELECT * FROM products WHERE product_id > $product_id ORDER BY product_id ASC LIMIT 1";
      $query = mysqli_query($dbconnect, $sql);
          if($query){
            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                
              $nextproduct_id = $row["product_id"];

              }

              }

            ?>


<a href="details.php?pid=<?php echo $nextproduct_id; ?>" class="next round"><i class="fas fa-angle-right"></i></a>

</div>
</div>




    <div class="row">
        <div class="column"> 
          <h3>Description:</h3>
            <p> <?php echo $product_details; ?></p>
            <p> <b>Brand:</b> <?php echo $product_type; ?></p> 
        </div>               


        <div class="column">
            <h3>Specifications</h3>
              <p><b>RAM: </b><?php echo $ram; ?></p>
              <p><b>Processor: </b><?php echo $battery_size; ?></p>
              <p><b>Resolution: </b><?php echo $screen_size; ?></p>
              <p><b>Camera: </b><?php echo $camera_pixels; ?></p>   
        </div>
      </div>
    </div>
  </div>
</div>

<!----------Scroll to the top of the page ---------->

<a id="topofpage" title="Top Of Page" href="index.php"><i class="fas fa-chevron-up"></i></a>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript">

        /*Scroll to top when arrow up clicked BEGIN*/
        $(window).scroll(function() {
            var height = $(window).scrollTop();
            if (height > 100) {
                $('#topofpage').fadeIn();
            } else {
                $('#topofpage').fadeOut();
            }
        });

        $(document).ready(function() {
            $("#topofpage").click(function(event) {
                event.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });

        });

    </script>


<footer class="footer-nav">
  <nav>
    <div class="wrapper">
      <ul>
        <li><a href="homepage.php">HOME</a></li>
        <li><a href="index.php">PRODUCTS</a></li>
      </ul>
    </div>
  </nav>  
</footer>

</body>
</html>