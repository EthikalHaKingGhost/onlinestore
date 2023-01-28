
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/darkly/bootstrap.min.css">
<link rel="stylesheet" href="image_upload/ImgUploader/croppie.css">

<?php session_start();

if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

$page_title = "{$_SESSION["first_name"]} " . " {$_SESSION["last_name"]}";

include ('includes/topbar.php');

include ('includes/header.php');

?>
    <div class="container-fluid p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light rounded-0">
                    <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="shop.php" class="text-decoration-none text-dark">Shop</a></li>
                    <li class="breadcrumb-item active font-weight-bold text-danger" aria-current="page">Create Product</li>
                </ol>
            </nav>
    </div>



<?php



if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

# Connect to the database.
require ('connect_db.php');

}


$errors = array();

if (isset($_POST["add_product"]))
{

if (!empty($_POST["name"])) { $name = $_POST["name"]; }else{$errors[] = 'Enter your product name.';}

if (!empty($_POST["details"])) { $details = $_POST["details"]; }else{$errors[] = 'Enter your product details.';}

if (!empty($_POST["price"])){ $price = $_POST["price"]; }else{$errors[] = 'Enter your product price.';}

if (!empty($_POST["count"])){ $count = $_POST["count"]; }else{ $errors[] = 'Enter the number of products .';}

if (!empty($_POST["sale"])) { $sale = $_POST["sale"]; }else{$errors[] = 'Enter your discount price.';}

if (!empty($_POST["ram"])) { $ram = $_POST["ram"]; }else{$errors[] = 'Enter your Ram size.';}

if (!empty($_POST["battery"])) { $battery = $_POST["battery"];}else{$errors[] = 'Enter your battery size.';}

if (!empty($_POST["resolution"])) { $resolution = $_POST["resolution"];}else{$errors[] = 'Enter your screen resolution';}

if (!empty($_POST["camera"])) { $camera = $_POST["camera"];}else{$errors[] = 'Enter your camera size';}



if (empty($errors)){


$uploadOk = 1;

if ($_FILES['fileToUpload']['error'] == 0){

    $one = $_FILES['fileToUpload'];
    
$target_dir = "images/";

 require ('upload1.php'); 

}else{

echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> error uploading file or no file selected.
            </div>';
}


if ($_FILES['fileToUpload2']['error'] == 0){

    $two = $_FILES['fileToUpload2'];
    
$target_dir  = "images/";

 require ('upload2.php'); 


}else{

echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> error uploading file or no file selected.
            </div>';
}


if ($_FILES['fileToUpload3']['error'] == 0){

    $three = $_FILES['fileToUpload3'];
    
$target_dir  = "images/";

 require ('upload3.php'); 


}else{

echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> error uploading file or no file selected.
            </div>';
}



}


if (empty($errors) && ($uploadOk == 1)){


 //echo "<meta http-equiv='refresh' content='3'>";

$insertsql = "INSERT INTO `products` (`product_id`, `product_name`, `tags` `product_details`, `product_price`, `stock_count`, `sale_price`, `ram`, `battery_size`, `screen_size`, `camera_pixels`) VALUES (NULL, '$name', '$details', '$price', '$count', '$sale', '$ram', '$battery', '$resolution', '$camera')";


if (mysqli_query($dbc, $insertsql)){

     $lastprodid = mysqli_insert_id($dbc);


//insert cat id and product_id into category assign
     $insertcat = "INSERT INTO `images` (`image_id`, `product_id`, `image_1`, `image_2`, `image_3`) VALUES (NULL, '$lastprodid', '$image1', '$image2', '$image3');"; 

     $insertcatqry = mysqli_query($dbc, $insertcat);


//select the category where category = category
     $catidsql = "SELECT category_id FROM `product_category` WHERE category = '$category'";

     //grab the category id
        $row = mysqli_fetch_assoc(mysqli_query($dbc, $catidsql));

        $category_id = $row["category_id"];


//insert cat id and product_id into category assign
     $insertcat = "INSERT INTO `category_assign` (`assign_id`, `category_id`, `product_id`) VALUES (NULL, '$category_id', '$lastprodid');"; 

     $insertcatqry = mysqli_query($dbc, $insertcat);


   echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> Add product Successfully.
            </div>';

}else{

    echo "failed";
}


}
    
    else

{

        echo '<h1 class="text-dark font-weight-bold">Error!</h1><p class="text-danger font-weight-bold" id="err_msg">The following error(s) occurred:<br>';

        foreach ($errors as $msg)

        {
            echo " - $msg<br>";
        }

        echo 'Please try again.</p>';
       
        
    }

}

?>

            <div class="col-md-6 offset-md-3">
                <div class="row">
                <div class="col-md-12">

                    <h1 class="mb-3 border-bottom">Add Product</h1>


        <form action="adminform.php" method="post" enctype="multipart/form-data">

                <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                            <select class="form-control" id="title" name="title">           
                                <?php 

                                $query = "SELECT * FROM product_category";
                                    $result = mysqli_query($dbc, $query);

                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

                                    { $category = $row["category"];

                                ?>

                                     <option><?php echo $category; ?></option>

                                <?php 
                                    

                                    }  
                                ?>


                            </select>
                            <label  class="figure-caption">Choose Category...</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fname" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control text-capitalize" minlength="5" maxlength="30" name="name">
                          <label  class="figure-caption">Minimum 5 characters long.</label>
                        </div>
                    </div>


                      <div class="form-group row">
                        <label for="bio" class="col-sm-2 col-form-label">Product Description</label>
                        <div class="col-sm-10">
                          <textarea type="text" maxlength="300" minlength="20" rows="5" cols="45" class="form-control font-italic" name="details" required></textarea>
                          <label  class="figure-caption">Maximum 300 characters long.</label>
                        </div>
                      </div>

                    <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label">RAM Size</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control text-capitalize"  name="ram" required>
                          <label  class="figure-caption">E.g 1GB</label>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label">Battery Size</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control text-capitalize" name="battery" required>
                          <label  class="figure-caption">E.g 1000mah</label>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label">Screen Size</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control text-capitalize" id="lname" name="resolution" required>
                          <label  class="figure-caption">E.g 4.7"</label>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label">Camera Size</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control text-capitalize" name="camera" required>
                          <label  class="figure-caption">E.g 12MP</label>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label">Product Price</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control text-capitalize" name="price" required>
                          <label  class="figure-caption">E.g 5000</label>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label">Sale Price</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control text-capitalize"  name="sale">
                          <label  class="figure-caption">E.g 5000</label>
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="fileToUpload" class="col-sm-2 col-form-label">Display</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" required>
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="fileToUpload" class="col-sm-2 col-form-label">Image1</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control-file" name="fileToUpload2" id="fileToUpload" required>
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="fileToUpload" class="col-sm-2 col-form-label">Image2</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control-file" name="fileToUpload3" id="fileToUpload" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label">Stock Count</label>
                        <div class="col-sm-10">
                          <input type="number" min="0" max="99" class="form-control text-capitalize"  name="count">
                        </div>
                      </div>



                    <hr class="border-bottom">

                    <div class="row">
                        <div class="col-md-6 offset-md-6 pb-5">
                            <button type="submit" class="btn btn-danger" name="add_product"><i class='fas fa-file-upload'></i> Add Product</button>
                        </div>
                    </div>
                  </div>
                </div>



<div class="container">

<?php

if(isset($_REQUEST["del"])){

    $deleteprod = $_REQUEST["del"];

// sql to delete a record in multiple tables using left join
$deletesql = "DELETE products, category_assign FROM products INNER JOIN category_assign ON Products.product_id = category_assign.product_id WHERE products.product_id = '$deleteprod'";

 $deleted = mysqli_query($dbc, $deletesql);

if (($deleted) > 0 ){

    echo "Record deleted successfully";

} else {

    echo "<em class='text-danger'> Error deleting record </em>" . mysqli_error($dbc);
}

}


?>



<h1>All Products</h1>
<?php 

$query = "SELECT * FROM products, images WHERE products.product_id = images.product_id ORDER BY `products`.`product_id` DESC";

$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) > 0)

{


            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {

                $product_id = $row["product_id"];
                $product_name = $row["product_name"];
                $product_details = $row["product_details"];
                $image1 = $row["image_1"];
                $product_price = $row["product_price"];
                $sale_price = $row["sale_price"];
                $link = "product_details.php?pid=$product_id";
                $battery = $row["battery_size"];
                $camera = $row["camera_pixels"];
                $ram = $row["ram"];
                $sale = (($sale_price / $product_price) * (100 / 10));

?>
                
                 <li class="list-group-item rounded-0 border border-right-0 border-left-0 border-bottom-0">
                        <div class="row"> 
                        <div class="col-md-3">
                            <a href="<?php echo $link; ?>" class="text-decoration-none text-dark ">
                        <img src="<?php echo $image1; ?>" alt="phone" class="img-fluid">
                            </a>
                            </div>


                            <div class="col-md-9 m-0 p-0">
                              <a href="#" data-toggle="modal" data-target="#myModal"><span class="float-right" ><i class="fas fa-trash-alt"></i></span></a>
                                



<!---------- modal for delete icon ---------->

                <div class="col-md-6 offset-md-3">

                                  <!-- The Modal -->
                                  <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                      
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Delete</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                        
                                          Are you sure you want to delete  <?php echo $product_name ?> from the store ?
                                        </div>
                                        
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <a class="btn btn-danger btn-sm text-light" href="adminform.php?del=<?php echo $product_id; ?>">Delete</a>
                                          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
                                        </div>
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div>





                            <a href="<?php echo $link; ?>" class="text-decoration-none text-dark">
                                <h6 class="font-weight-bold mb-2"><?php echo "$product_name" . ", " . "$battery" . ", " . "$camera" . ", " . " $ram "; ?></h6>
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

    mysqli_close($dbc);

    ?>
</div>

            </div>

       
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script src="image_upload/ImgUploader/croppie.min.js"></script>
<script src="image_upload/ImgUploader/imguploader.bs.minify.js"></script>




</body>
</html>
