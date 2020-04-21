
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $page_title; ?></title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="includes/megamenu.css">
    <link rel="stylesheet" href="includes/style.css">
  <link rel="stylesheet" href="fonts/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white p-1 pt-2 m-0">
  <div class="container">
  <a class="navbar-brand p-0 m-0" href="home.php"><img src="images/logo.png" height="45px" alt="image"></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item active m-auto">
        <a class="nav-link active" href="home.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="forum.php">Forum</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="shop.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Store</a>
        <div class="dropdown-menu mega-menu rounded-0 border-0" aria-labelledby="navbarDropdown"> 
          <div class="row">
            <div class="col-md-4 px-4">
              <img src="images/logo3.png" alt="eg" class="img-fluid">
              <em class="text-justify text-muted"><small>Purchase the top phones today!</small></em>
            </div>
            <div class="col-md-4 text-center">

<?php 

require ("connect_db.php");

?> <p><a href="shop.php"><strong class="sub-menu-heading h6 border-bottom">Shop</a></strong></p>

<?php

$query = "SELECT * FROM product_category";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

      $category = $row["category"];
      $category_id = $row["category_id"];
      $link = "shop.php?cid=$category_id";

      ?>
        <p>
          <a href="<?php echo $link; ?>" class="menu-link"><?php echo $category; ?></a>
        </p>

      <?php
    }
}

?>
      </div>

            <div class="col-md-4 text-center">
              <p><strong class="sub-menu-heading h6 border-bottom">Orders</strong></p>
              <p><a href="trackorders.php" class="menu-link">Order Tracking</a></p>
              <p><a href="cart.php" class="menu-link">View Cart</a></p>
              <p><a href="checkout.php" class="menu-link">Checkout</a></p>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile<span class="sr-only">(current)</span></a>
      </li>
    </ul>

    <!--------user login avatar----->

<?php 

include "connect_db.php";

if (isset($_SESSION["user_id"])){

          $user_id = $_SESSION["user_id"];

   $query = "SELECT * FROM users WHERE users.user_id = '$user_id'";

                            $result = mysqli_query($dbc, $query);

                        while($row = mysqli_fetch_assoc($result)) {

                          $user_image = $row["user_image"];
                          $first_name = $row["first_name"];
}

echo 
  '<ul class="navbar-nav ml-auto">
            <div class="nav-item dropdown">'

                ?>
                  <a href="javascript:void(0);" data-toggle="dropdown" data-sidebar="true" aria-expanded="false" class="text-decoration-none text-danger">
                  <span><img class="mr-2 bg-custom rounded-circle" src="<?php echo $user_image; ?>" alt=""><span class="text-capitalize badge badge-dark p-2"><?php
                  if (!empty($_SESSION["first_name"])){
                      echo $_SESSION["first_name"]; 
                      }else{
                       echo "Profile";
                      }
                  ?>
                    
                  </span></span></a>
              
               <li class="dropdown-menu dropdown-menu-right bg-shadow" aria-labelledby="navbarDropdown"> 
                    <a class="dropdown-item text-dark" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                    <a class="dropdown-item text-dark" href="user-profile.php"><i class="fas fa-user-cog" aria-hidden="true"></i> Edit Profile</a>
                      <a data-toggle="modal" data-target="#logoutModal" class="dropdown-item" href="javascript:void(0);"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Logout</a>
                  </li>
              
            </div>
      </ul>

      <?php

}else{

echo 
'<div class="nav-item">
  <a href="login.php" class="btn btn-dark btn-md text-white">Login</a>
</div>';

}

?>

<div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content rounded-0">
      <div class="modal-header">
        <h4>Log Out <i class="fa fa-lock"></i></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">
        <p><small><i class="fa fa-question-circle"></i>Are you sure you want to log-out?</small><br/></p>
        <div class="actionsBtns">
            <form action="goodbye.php" method="post">
                <input type="hidden" name="${_csrf.parameterName}" value="${_csrf.token}"/>
                <input type="submit" class="btn btn-default btn-dark btn-sm rounded-0" value="Logout" />
                  <button class="btn btn-grad btn-sm rounded-0" data-dismiss="modal">Cancel</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</nav>

  
  <div class="container p-5">
    <div class="col-md-6 offset-md-3">
      <form action="shop.php" method="post">
<div class="input-group">
  <input type="text" class="form-control" name="search" placeholder="Search for product...">
      <span class="input-group-btn">
        <input class="btn btn-grad rounded-0" value="Search" type="submit">
      </span>
</div>
</form>
    </div>
</div>
