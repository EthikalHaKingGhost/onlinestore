<style>
 .carousel-item {
  height: 70vh;
  min-height: 600px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
 }

 .carousel-caption{top:220px;}

</style>

<header>
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
       <img class="d-block w-100" src="images/blur-background12.jpg"alt="image1">
        <div class="carousel-caption d-none d-md-block">
          <h2>IPHONES</h2>
          <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
          <a href="shop.php"><button class="btn btn-danger btn-lg">Shop Now</button></a>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/blur-background10.jpg"alt="image1">
        <div class="carousel-caption d-none d-md-block">
          <h2>SAMSUNG</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <a href="shop.php"><button class="btn btn-danger btn-lg">Shop Now</button></a>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/blur-background05.jpg"alt="image1">
        <div class="carousel-caption d-none d-md-block">
          <h2>HUAWEI</h2>
          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
          <a href="shop.php"><button class="btn btn-danger btn-lg">Shop Now</button></a>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</header>

