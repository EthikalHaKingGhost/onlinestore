
<?Php

session_start();

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

<!---- breadcrumb end ---->



<!---------------------------- product listing ----------------------------->

<div class="product_box">
<h1 class="bounce">Products</h1>
<p>Shop for some of the best deals!</p>

<ul class="products">

<?php 

$dbconnect = mysqli_connect("localhost","root","","topcellersdb") OR die(mysqli_connect_error());

  //access products table from database
  $sql ="SELECT * 
  FROM products, images 
  WHERE products.product_id = images.product_id";

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
        $image_1 = $row["image_1"];
        $product_price =$row["product_price"];
        $sale_price = $row["sale_price"];
        $product_type = $row["product_type"];
        $link = "details.php?pid=$product_id";

        $sale = (($sale_price/$product_price) * (100/10));

                  

?>

    <li>
      
      <div class="card">
        <a class="detail-link" href="<?php echo $link ?>">
      <img class="responsive" src=images/<?php echo $image_1;?> alt="image">
        <h2 class="info"><?php echo $product_name; ?></h2>
        <p class="info"><?php echo $product_type; ?></p>
        <h3 class="info">$<?php echo $product_price; ?> TTD</h3>

        <h4 class="info" style="color:red;">

          <?php 

//check if product has a discout and display with code to prevent displaying over 100% sale.
          if($product_price < $sale_price) {

                    echo '<h4 class="info" style="color:white;"> no sale</h4>';

          }elseif($sale == 0){

                    echo '<h4 class="info" style="color:white;"> no sale</h4>';

                  }else{

                    echo "$".round($sale)."% OFF"; 
                  }

          ?>

        </h4>
        </a>
        </div>
      
        </li>
    

        <?php
            }
            } else {echo "Site is under maintenance";}
        ?>

    </ul>
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
        <li><a href="index.php">HOME</a></li>
        <li><a href="products.php">PRODUCTS</a></li>
      </ul>
    </div>
  </nav>
    
</footer>
</body>
</html>
