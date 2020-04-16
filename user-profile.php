
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/darkly/bootstrap.min.css">
<link rel="stylesheet" href="image_upload/ImgUploader/croppie.css">

<?php session_start();

include "includes/header.php";


if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

# Connect to the database.
require ('connect_db.php');

}



 $query = "SELECT * FROM users WHERE users.user_id = '$user_id'";

        $result = mysqli_query($dbc, $query);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {

                                
                                $_SESSION['user_image'] = $row['user_image'];
                                $first_name = $row["first_name"];
                                $last_name = $row["last_name"];
                                $gender = $row["gender"];
                                $title = $row["preferred_title"];
                                $cellphone= $row["cellphone"];
                                $email = $row["email"];
                                $address = $row["address"];
                                $address2 = $row["address2"];
                                $country = $row["countryname"];
                                $city = $row["city"];
                                $user_image = $row["user_image"];

                                $reg_date = $row["reg_date"];
                                $new_date = date("M jS, Y h:i:s", strtotime("reg_date")); 

                                $birthdate = $row["date"];
                                $dateofbirth = date("M jS, Y", strtotime("birthdate")); 

                                
                                //processing post date value
                                $now = strtotime(date("m/d/Y h:i:s a", time()));
                                $login_time = strtotime($row['login_time']);
                                
                                //difference in seconds
                                $newdate = ($now - $login_time) - 21600;
                                
                                if($newdate < 3600){
                                    //posted within one hour
                                    $datelogin = round($newdate/60);
                                    $login_date = $datelogin . " minute(s) ago.";
                                }
                                elseif($newdate < 86400){
                                    //posted within one day
                                    $datelogin = round($newdate/3600);
                                    $login_date = $datelogin . " hour(s) ago.";
                                }
                                else {
                                    //posted over a day ago
                                    $datelogin = round($newdate/86400);
                                    $login_date = $datelogin . " day(s) ago.";
                                }

                    }


            }else{

                echo "error no info to display";

            }



if (isset($_POST["update_profile"]))
{

if (!empty($_POST["first_name"])){ $new_first_name = $_POST["first_name"]; }else{ $new_first_name = $first_name; }

if (!empty($_POST["last_name"])) { $new_last_name = $_POST["last_name"]; }else{$new_last_name = $last_name;}

if (!empty($_POST["title"])) { $new_title = $_POST["title"]; }else{$new_title = $title;}

if (!empty($_POST["cellphone"])) { $new_number = $_POST["cellphone"];}else{$new_number = $cellphone;}

if (!empty($_POST["email"])){ $new_email = $_POST["email"]; }else{$new_email = $email;}

if (!empty($_POST["address"])) { $new_address = $_POST["address"]; }else{$new_address = $address;}

if (!empty($_POST["address2"])) { $new_address2 = $_POST["address2"]; }else{$new_address2 = $address2;}

if (!empty($_POST["country"])) { $new_country = $_POST["country"];}else{$new_country = $country;}

if (!empty($_POST["city"])) { $new_city = $_POST["city"];}else{$new_city = $city;}


$update = "UPDATE `users` SET `first_name` = '$new_first_name', `last_name` = '$new_last_name', `preferred_title` = '$new_title', `cellphone` = '$new_number', `email` = '$new_email', `address` = '$new_address', `address2` = '$new_address2', `countryname` = '$new_country', `city` = '$new_city' WHERE `users`.`user_id` = '$user_id'";

echo "<meta http-equiv='refresh' content='3'>";

if (mysqli_query($dbc, $update)) {

    echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> Updated Successfully.
            </div>';

} else {

    echo "Error updating record: " . $dbc->error;
}

}

//Image Upload to server

if(isset($_POST["uploadimg"])) {

    require 'connect_db.php';
    $uploadOk = 1;

if ($_FILES['fileToUpload']['error'] == 0){


echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> the file is ok to upload.
            </div>';
  
    require ('upload.php');

}else{

echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> error uploading file or no file selected.
            </div>';
}

if ($uploadOk == 1){

        $sql = "UPDATE `users` SET `user_image` = '$target_file' WHERE `users`.`user_id` = '$user_id';";

        echo "<meta http-equiv='refresh' content='3'>";

        $queryresult = mysqli_query($dbc, $sql);

    }

}

?>



<!-------Last logged in ------->

<div id="status"></div>
        <div class="container mt-5 text-dark">
            <div class="row">
                <div class="col-md-3">
                    <div class="card p-2 text-center">

                        <div class="img-fluid m-2">

                         <a href="<?php echo $user_image; ?>"><img src="<?php echo $user_image; ?>"

                          class="rounded-circle img-profile" alt="avatar" id="image"/></a>

                        </div>
                        <h6>Upload a different photo...</h6>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmImage">
                        Change Image
                        </button>  
                 

                    <!-- The Modal -->
                    <div class="modal" id="confirmImage">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Change Image</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                            <label>Are you sure you want to change this image?</label>
                            <div>
                                <img src="<?php echo $user_image; ?>" class="img-fluid rounded-circle" width="100">
                            </div>
                          </div>

                          <!-- Modal footer -->
                        <form action="user-profile.php" method="post" enctype="multipart/form-data">
                          <div class="modal-footer">
                            Select image:
                            <input type="file" name="fileToUpload" name="" class="btn btn-dark" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="uploadimg" class="btn btn-info">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </form>

                          </div>

                        </div>
                      </div>
                    </div>


            <hr class="bg-white">

                    <label> <strong><?php echo "$title " . " $first_name " . " $last_name" ?></strong></label>
                    <label><em><?php echo $email; ?></em></label>
                    <label><small>Last Logged in:</small><small class="text-muted"> <?php echo $login_date ?></small></label>
                    <div><h5>Profile <span class="badge badge-danger">Admin</span></h5></div>  
            </div>
        </div>
            <div class="col-md-9">
                <div class="row">
                <div class="col-md-12">

                    <h4>Personal Info</h4>

                <hr class="bg-white">

        <form action="user-profile.php" id="profileimg" method="post">

                <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Preferred Title</label>
                            <div class="col-sm-10">
                            <select class="form-control" id="title" name="title">           
                                <option><?php echo $title; ?> </option>
                                <option disabled>_________</option>

                                <?php 

                                $query = "SELECT * FROM preferred_title ;";
                                    $result = mysqli_query($dbc, $query);

                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

                                    { $preferred_title = $row["title"];

                                ?>

                                     <option><?php echo $preferred_title; ?></option>

                                <?php 
                                    

                                    }  
                                ?>


                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control text-capitalize" id="colFormLabel" value="<?php echo $first_name; ?>" name="first_name">
                        </div>
                    </div>

                      <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control text-capitalize" id="colFormLabel" Value="<?php echo $last_name; ?>" name="last_name">
                        </div>
                      </div>

                    <div class="form-group row">
                      <label for="colFormLabel" class="col-sm-2 col-form-label">Date of Birth</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="date" value="<?php echo $dateofbirth ?>" disabled>
                      </div>
                    </div>

                <h4 class="pt-5">Contact Info</h4>

                <hr class="bg-white">

                <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="colFormLabel" value="<?php echo $email; ?>" name="email">
                        </div>
                    </div>
                

                <div class="form-group row">
                          <label for="colFormLabel" class="col-sm-2 col-form-label">Cellphone</label>
                          <div class="col-sm-10">
                          <input type="tel" class="form-control" id="cellphone" placeholder="eg. 999-999-9999" name="cellphone" value="<?php echo $cellphone; ?>">
                    </div>
                </div>


                <h4 class="pt-5">Address</h4>

                <hr class="bg-white">

  
                  <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address 1</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="colFormLabel" value="<?php echo $address; ?>" name="address">
                  </div>
                  </div>

                  <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address 2</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="colFormLabel" value="<?php echo $address2; ?>" name="address2">
                  </div>
              </div>

                    <div class="form-group row">
                      <label for="colFormLabel" class="col-sm-2 col-form-label">City</label>
                      <div class="col-sm-10">
                      <input type="text" class="form-control text-capitalize" id="colFormLabel" name="city" value="<?php echo $city; ?>">
                    </div>
                </div>

                     <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                          <select class="form-control input-sm" id="colFormLabel" name="country">
                            <option><?php echo $country; ?></option>
                            <option disabled>_________</option>
                            <?php 

                                $query = "SELECT * FROM countries ;";
                                    $result = mysqli_query($dbc, $query);

                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

                                    { $country_name = $row["Countryname"];

                                ?>

                                     <option><?php echo $country_name; ?></option>

                                <?php 
                                    

                                    }  
                                ?>


                          </select>
                        </div>
                  </div>

                    <hr class="bg-white">

                    <div class="row">
                        <div class="col-md-6 offset-md-6 pb-5">
                            <input type="submit" class="btn btn-danger" value="Update Profile" name="update_profile">
                        </div>
                    </div>
                  </div>
                </div>
            </div>
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
