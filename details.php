<?php 

session_start();

if(isset($_GET["pid"])){
    $product_id = $_GET["pid"];
}else{

    echo "Wrong url address, enroll id missing";

    exit();
}


?>

 <html>
    <head>
        <title>Products Home</title>
          <link href="style.css" rel="stylesheet" >
        <!---script to add icons to page-->
            <script src="https://kit.fontawesome.com/bc9aeacf84.js" crossorigin="anonymous"></script>
    </head>
        <body>

          <header class="main-header">
            <!--image logo with link to home(index) page-->  
              <div>
             <a href="index.php">
            <img src=" images/logo.png" class="logo" >
            </a>
          </div>

        <!--- search box in a div container-->
          <div class="search-box">
            <input class="search-text" type="text" name=" " placeholder="Search for Product">
              <a class="search-btn "href="#">
                <i class="fas fa-search"></i>
              </a>
          </div>

          <ul class="main-nav">
            <li><a href="homepage.php"><i class="fas fa-home"></i> HOME</a></li>
            <li class="dropdown">

              <a href="index.php"><i class="fab fa-shopify"></i> PRODUCTS <i class="fa fa-caret-down"></i></a>
              <ul class="drop-nav">
                <li class="flyout">
                  <a href="#">TOP-UP</a>
                   <ul class="flyout-nav">
                    <li><a href="#">Digicel</a></li>
                    <li><a href="#">Bmobile</a></li>        
                  </ul>
                </li>
                <li class="flyout">
                  <a href="#">Phones</a>
                  <ul class="flyout-nav">
                    <li><a href="#">iPhone</a></li>
                    <li><a href="#">Apple</a></li>
                    <li><a href="#">Samsung</a></li>        
                  </ul>
                </li>    
              </ul>
            </li>
            <li><a href="#"><i class="fas fa-info-circle"></i> ABOUT</a></li>
          </ul>
        </header>



<!-- breadcrumb for navigation -->

<?php 

  $dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());

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
                  $product_type = $row["product_type"];

?>

          <ul class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="homepage.php" class="breadcrumb-link">Home</a>
          </li>
          <li class="breadcrumb-item">
              <a href="index.php" class="breadcrumb-link">Products</a>
          </li>
          <li class="breadcrumb-item">
              <a href="index.php" class="breadcrumb-link"><?php echo $product_type; ?></a>
          </li>
          <li class="breadcrumbs-item">
              <a href="" class="breadcrumb-link-active"><?php echo $product_name; ?></a>
          </li>
            </ul>


<?php
                }
                } else {echo "Site is under maintenance";}
            ?>

<br>
<br>

<!------end of bread crumb ----->
<?php 

  $dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());


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

              }
              } else {echo "Site is under maintenance";}
          ?>   


 
  <div class="card-block">
  <div class="prod-card">
      <div class="img">
        <img src="images/Samsung-Galaxy-S10.jpg" alt="">
      </div>
      <div class="prod-info">
        <h2><?php echo $product_name; ?></h2>
          <span class="desc"><?php echo $product_type; ?></span>
          <span class="price"><?php 

                    if($sale_price <> 0 ){

                    echo '<p style="text-decoration:line-through; color:black;"> $'.$product_price.' TTD </p>';

                  }else{
                    echo '<p style="text-decoration:none;"> $'.$product_price.'TTD </p>'; 
                    
                  }
                  ?>

        <!----remove sale price when value is 0 ------>
            <p>       
                    <?php 

                    if($sale_price != 0){

                    echo '$'.$sale_price.' TTD'; 

                      }else{

                        echo "";
                      }

                      ?>
            </p></span>
          <h3>RAM size</h3>
          <span>
            <a href="#">32GB</a>
            <a href="#">64GB</a>
            <a href="#">128GB</a>
          </span>
          <h3>Capacity</h3>
          <span>
            <a href="#">Blue</a>
            <a href="#">red</a>
            <a href="#">orange</a>
          </span>
          <a class="addbtn" href="#"> <i class="ion-android-cart"></i>Add to Cart</a>
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
          <p><b>RAM:</b> 124GB</p>
          <p><b>Processor:</b> 3.5ghz</p>
          <p><b>Resolution:</b> 9.5"</p>
          <p><b>Capacity:</b> 500 GB</p>   
</div>
</div>
</div>
</div>
</div>
          <footer class="footer-nav">
            <nav>
              <div class="wrapper">
                <ul>
                  <li><a href="index.php">HOME</a></li>
                  <li><a href="about.php">ABOUT</a></li>
                  <li><a href="products.php">PRODUCTS</a></li>
                </ul>
              </div>
            </nav>  
        </footer>
    </body>
</html>