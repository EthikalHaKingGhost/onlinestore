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
      <li><a href="#"><i class="fas fa-home"></i> HOME</a></li>
      <li><a href="#"><i class="fas fa-info-circle"></i> ABOUT</a></li>
      <li class="dropdown">

        <a href="#"><i class="fab fa-shopify"></i> PRODUCTS</a>
        <ul class="drop-nav">
          <li class="flyout">
            <a href="#">TOP-UP</a>
             <ul class="flyout-nav">
              <li><a href="#">DIGICEL</a></li>
              <li><a href="#">BMOBILE</a></li>        
            </ul>
          </li>
          <li class="flyout">
            <a href="#">Phones</a>
            <ul class="flyout-nav last">
              <li><a href="#">iPhone</a></li>
              <li><a href="#">Apple</a></li>
              <li><a href="#">Samsung</a></li>        
            </ul>
          </li>    
        </ul>
      </li>
    </ul>
  </header>