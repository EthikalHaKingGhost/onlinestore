<?php # DISPLAY COMPLETE PRODUCTS PAGE.
# Access session.
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['user_id']))
{
    require ('login_tools.php');
    load();
}

# Set page title and display header section.
$page_title = 'Shop';

include ('includes/header.php');

require ('connect_db.php');

    //checking if sort was applied


# Retrieve items from 'shop' database table.

?>

<div class="container shop-container pt-5">
		
	<div class="row">
		<div class="col-md-12 pt-3">
			<nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white rounded-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="category.html">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sub-category</li>
                </ol>
            </nav>
		</div>
		<div class="col-md-3 ">
            <div class="col-md-12 p-0 m-0">
                <form action="shop.php" method="post">
                    <select name="orderA"> 
                        <option value="product_name">Name</option>
                        <option value="product_price">Price</option>
                        <option value="sale_price">Sale</option>
                    </select>


                    <select name="sort"> 
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                    <input type="submit" value="Sort Products">
                </form>
            </div>
      
			<div class="card rounded-0">
                <div class="card-header text-center bg-dark text-white text-uppercase rounded-0"><i class="fa fa-list"></i> Categories</div>
                <ul class="list-group rounded-0 category_block">

                <!------- Categories selection  in card  --------------->

                <?php

                $query = "SELECT product_id FROM products";

                if ($result = mysqli_query($dbc, $query))

                {
                    // Return the number of rows in result set
                    $rowcount = mysqli_num_rows($result);

                    mysqli_free_result($result);

                }

                ?>

                    <a href="shop.php" class="text-decoration-none"><li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded-0">All Phones<span class="badge badge-danger badge-pill"><?php echo $rowcount ?></span></li></a>

                    
                <?php

                    //count the number of products in each category and output
                    $query = "SELECT *, (SELECT COUNT(category_id) FROM category_assign WHERE category_assign.category_id = product_category.category_id) num FROM product_category";

                    $result = mysqli_query($dbc, $query);

                    if (mysqli_num_rows($result) > 0)
                    {

                        while ($row = mysqli_fetch_assoc($result))
                        {

                            $category_id = $row["category_id"];
                            $category = $row["category"];
                            $numofprod = $row["num"];
                            $link_cat = "shop.php?cid=$category_id";
                    ?>
                    
                    <a href="<?php echo $link_cat ?>" class="text-decoration-none"><li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded-0"><?php echo $category; ?><span class="badge badge-danger badge-pill"><?php echo $numofprod; ?></span></li></a>

                <?php

                    }
                }

                ?>
                    
           </ul>
        </div>



<style type="text/css">

    input .price_filter1[type="number"]:disabled, input .price_filter2[type="number"]:disabled{
        background: #eee;
    }

    input .price_filter1[disabled="disabled"], input .price_filter1[disabled="disabled"]{
        background: #eee;
    }


</style>



        <div class="col-md-12 pt-3 m-0 p-1">
   <form action="shop.php" method="post">
        <!-- Price -->
        <h5 class="headline">
          <span>Price</span>
        </h5>
        <div class="radio">
          <input type="radio" name="price" id="shop-filter-price_1" value="product_price <= 5000 AND sale_price <= 5000">
          <label for="shop-filter-price_1">Under $5000</label>
        </div>
        <div class="radio">
          <input type="radio" name="price" id="shop-filter-price_2" value="product_price >= 5000 AND product_price <= 6000 OR sale_price >= 5000 AND sale_price <= 6000">
          <label for="shop-filter-price_2">$5000 to $6000</label>
        </div>
        <div class="radio">
          <input type="radio" name="price" id="shop-filter-price_3" value="product_price >= 6000 AND product_price <= 7000 OR sale_price >= 6000 AND sale_price <= 7000">
          <label for="shop-filter-price_3">$6000 to $7000</label>
        </div>
        <div class="form-group shop-filter_price">
          <div class="row p-0 m-0">
              <button type="submit" class="btn btn-grad btn-block" id="filter_button">Go</button>
            </div>
          </div>
      </form>
</div>

<!-- Checkboxes -->
<div class="col-md-12 pt-3">
<form action="shop.php" method="post">
        <h5 class="headline">
          <span>Screen Resolution</span>
        </h5>

        <div class="radio">
          <input type="radio" value="screen_size >= 4.7 AND screen_size <= 6.1" name="resolution" id="shop-filter-radio" checked>
          <label for="shop-filter-radio">4.7" to 6.1"</label>
        </div>
        <div class="radio">
          <input type="radio" value="screen_size >= 6.1 AND screen_size <= 6.47" name="resolution" id="shop-filter-radio">
          <label for="shop-filter-radio">6.1" to 6.47"</label>
        </div>
        <div class="radio">
          <input type="radio" value="screen_size >= 6.47 AND screen_size <= 6.7" name="resolution" id="shop-filter-radio">
          <label for="shop-filter-radio">6.47" to 6.7"</label>
        </div>
    <div class="form-group shop-filter_price">
          <div class="row p-0 m-0">
              <button type="submit" class="btn btn-grad btn-block" id="resolution">Go</button>
            </div>
          </div>
    </div>    
</form>
                

<div class="col-md-12 pt-3">
        <h5 class="headline">
          <span>Battery Capacity</span>
        </h5>
        <div class="checkbox">
          <input type="checkbox" value="" name="battery" id="shop-filter-checkbox_1" checked="">
          <label for="shop-filter-checkbox_1">2900mah</label>
        </div>
    </div>  


    <div class="col-md-12 pt-3">
        <h5 class="headline">
          <span>RAM</span>
        </h5>
        <div class="checkbox">
          <input type="checkbox" value="" name="" id="shop-filter-checkbox_1" checked="">
          <label for="shop-filter-checkbox_1">4GB</label>
        </div>
    </div>  
</div>

		<div class="col-md-9">
			<div class="row">

				<div class="col-md-12">
					<ul class="list-group">
                    
<?php

if (isset($_POST["orderA"])){
        //selected values as variables
        $orderA = $_POST['orderA'];
        $sort = $_POST['sort'];
        $sortsql = "ORDER BY ".$orderA." ".$sort;
        
        $query = "SELECT * FROM products $sortsql";

} else if (isset($_POST["price"])){

        $price = $_POST['price'];

$query = "SELECT * FROM products WHERE ".$price." ORDER BY product_price ASC";

}else if (isset($_GET["cid"])){

$cat_id = $_GET["cid"];

$query = "SELECT * FROM products, product_category, category_assign WHERE category_assign.category_id = product_category.category_id AND products.product_id = category_assign.product_id AND category_assign.category_id = '$cat_id'";

}else if(isset($_POST["resolution"])){

$resolution = $_POST['resolution'];

$query = "SELECT * FROM `products` WHERE ".$resolution." ORDER BY `products`.`screen_size` ASC";



}else{
  
$query = "SELECT * FROM products";

}

$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) > 0)

{

if (isset($_POST["search"]) && $_POST["search"] !== '')
    
    {

        $search = $_POST["search"];

        $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%' OR product_details LIKE '%$search%' OR product_price LIKE '%$search%' OR screen_size LIKE '%$search%' OR camera_pixels LIKE '%$search%' OR ram LIKE '%$search%' OR battery_size LIKE '%$search%' OR sale_price LIKE '%$search%'";

        $searchresult = mysqli_query($dbc, $sql);

        $searchcount = mysqli_num_rows($searchresult);

        if (mysqli_num_rows($searchresult) == 0)
        {

            $feedback = "There are no products fou1nd with <h6>" . "$search" . "</h6>";

            echo $feedback;

        }
        else
        {

            while ($row = mysqli_fetch_array($searchresult, MYSQLI_ASSOC))
            {

                $product_id = $row["product_id"];
                $product_name = $row["product_name"];
                $product_details = $row["product_details"];
                $image = $row["product_image"];
                $product_price = $row["product_price"];
                $sale_price = $row["sale_price"];
                $link = "product_details.php?pid=$product_id";
                $battery = $row["battery_size"];
                $camera = $row["camera_pixels"];
                $ram = $row["ram"];
                $sale = (($sale_price / $product_price) * (100 / 10));

?>
                
                 <li class="list-group-item rounded-0">
                        <div class="row"> 
                        <div class="col-md-3">
                            <a href="<?php echo $link; ?>" class="text-decoration-none text-dark ">
                        <img src="<?php echo "images/" . "$image"; ?>" alt="phone" class="img-fluid">
                            </a>
                            </div>

                            <div class="col-md-9 m-0 p-0">
                            <a href="<?php echo $link; ?>" class="text-decoration-none text-dark">
                                <h6 class="font-weight-bold mb-2"><?php echo "$product_name" . ", " . "$battery" . ", " . "$camera" . ", " . " $ram " . "()"; ?></h6>
                            </a>

                             <ul class="list-inline small">
                                <a href="#" class="text-decoration-none text-dark">
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item ml-1">34</li>
                                </a>
                            </ul>


                            <div class="d-flex align-items-center justify-content-between mt-1 text-dark">
                                <h6 class="font-weight-bold my-2">
                        <?php
                #echo sale price if there is a sale
                if ($sale_price > 0)
                {

                    echo "$" . "$sale_price";

                }
                else
                {

                    echo "$" . "$product_price";
                }

?>
                                     
                                 </h6>
                            </div>

                        <?php

                if ($product_price < $sale_price)
                {

                    echo '';

                }
                else if ($sale == 0)
                {

                    echo '';

                }
                else
                {

?>

                        <span class="badge badge-danger font-weight-bold"><?php echo "$" . round($sale) . "% OFF"; ?></span>
                        <?php
                }

?>
                         </div>
                    </div>
                </li>
            </a>
                  <?php
            }

        }

    }
    else
    {

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {

            $product_id = $row["product_id"];
            $product_name = $row["product_name"];
            $product_details = $row["product_details"];
            $image = $row["product_image"];
            $product_price = $row["product_price"];
            $sale_price = $row["sale_price"];
            $link = "product_details.php?pid=$product_id";
            $battery = $row["battery_size"];
            $camera = $row["camera_pixels"];
            $ram = $row["ram"];

            

            $calc = ($sale_price / $product_price * 100/1);
            $sale = (100 - $calc); 

?>
                <!-- list group item-->
                 <li class="list-group-item rounded-0">
                    <!-- Custom content-->
                        <div class="row"> 
                        <div class="col-md-3">
                            <a href="<?php echo $link ?>" class="text-decoration-none text-dark ">
                        <img src="<?php echo "images/" . "$image" ?>" alt="phone" class="img-fluid">
                            </a>
                            </div>

                            <div class="col-md-9 m-0 p-0">
                            <a href="<?php echo $link ?>" class="text-decoration-none text-dark">
                                <h6 class="font-weight-bold mb-2"><?php echo "$product_name" . ", " . "$battery" . ", " . "$camera" . ", " . " $ram " . "()" ?></h6>
                            </a>

                             <ul class="list-inline small">
                                <a href="#" class="text-decoration-none text-dark">
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                                    <li class="list-inline-item ml-1">34</li>
                                </a>
                            </ul>


                            <div class="d-flex align-items-center justify-content-between mt-1 text-dark">
                                <h6 class="font-weight-bold my-2">
                        <?php

            #echo sale price if there is a sale
            if (empty($sale_price))

            {


                echo "$" . "$sale_price";

            }
            else
            {

                echo "$" . "$product_price";
            }

?>
                                     
                                 </h6>
                            </div>

                        <?php

            #check if product has a discout and display with code to prevent displaying over 100% sale.
            if ($sale_price == 0 ){

                echo " ";

            }

            else

            {
                        ?>
                        <span class="badge badge-danger font-weight-bold"><?php echo "$" . round($sale) . "% OFF"; ?></span>
                        <?php

            }

?>

                         </div>
                    </div> <!-- End -->
                </li>
            </a><!-- End -->

                      <?php
        }

    }

}
else
{
    echo '<p>There are currently no items in this shop.</p>';
}

?>
              
           		</ul> <!-- list group item -->
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php

include ('includes/latest_arrivals.php');



?>

<!----------- radio button for price -------------->
<script>

function enable(enabled){
    
  var price1 = document.getElementById('price_filter1'), 
  price2 = document.getElementById('price_filter2');
      
  if(enable){
    price1.removeAttribute('disabled');
    price2.removeAttribute('disabled');

  } else {
    price1.setAttribute('disabled','disabled');
    price2.setAttribute('disabled','disabled');
  }
}

</script>

<?php include ('includes/footer.php'); ?>
