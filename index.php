
<?Php

session_start();

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

<!---- breadcrumb ---->
        <ul class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="homepage.php" class="breadcrumb-link">Home</a>
          </li>
          <li class="breadcrumb-item">
              <a href="index.php" class="breadcrumb-link-active">Products</a>
          </li>
        </ul>
    <br>
<br>
<!---- breadcrumb end ---->



<!---------------------------- product listing ----------------------------->

<div class="product_box">
  <h1>Product Listing</h1>
<p style="text-align: center;">Shop for some of the best deals!</p>
<ul class="products">


<?php 

$dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());

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

                  $sale = (($sale_price/$product_price) * 100);

                  
                  


?>
    <li>
      <img class="responsive" src=images/<?php echo $product_image;?> alt="image">
        <p class="info"><a href="<?php echo $link ?>" class="btn-card"><?php echo $product_name; ?></a></p>
        <h2 class="info">Price: $<?php echo $product_price; ?> TTD</h2>
        <h4 class="info" style="color:red;">


          <?php 

//check if product has a discout and display with code to prevent displaying over 100% sale.
          if($product_price < $sale_price) {

                    echo "";

          }elseif($sale == 0){

                    echo "";

                  }else{

                    echo "$".round($sale)."% OFF"; 
                  }

          ?>

        </h4>
    </li>

<?php
    }
    } else {echo "Site is under maintenance";}
?>
</ul>
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
