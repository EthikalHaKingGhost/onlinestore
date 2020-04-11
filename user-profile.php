
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/darkly/bootstrap.min.css">
<link rel="stylesheet" href="image_upload/ImgUploader/croppie.css">

<?php session_start();

include "includes/header.php";

 ?>




    <style type="text/css">
        .img-fluid .img-profile {
        width: 150px;
        height: 150px;
        border:1px solid #6c757d;
}
    </style>



<?php 




if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

# Connect to the database.
require ('connect_db.php');

}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

if (!empty($_POST["first_name"])){ $new_first_name = $_POST["first_name"]; }

if (!empty($_POST["last_name"])) { $new_last_name = $_POST["last_name"]; }

if (!empty($_POST["title"])) { $new_title = $_POST["title"]; }

if (!empty($_POST["cellphone"])) { $new_number = $_POST["cellphone"];}

if (!empty($_POST["email"])){ $new_email = $_POST["email"]; }

if (!empty($_POST["address"])) { $new_address = $_POST["address"]; }

if (!empty($_POST["address2"])) { $new_address2 = $_POST["address2"]; }

if (!empty($_POST["country"])) { $new_country = $_POST["country"];}

if (!empty($_POST["city"])) { $new_city = $_POST["city"];}



$update = "UPDATE `users` SET `first_name` = '$new_first_name', `last_name` = '$new_last_name', `preferred_title` = '$new_title', `cellphone` = '$new_number', `email` = '$new_email', `address` = '$new_address', `address2` = '$new_address2', `countryname` = '$new_country', `city` = '$new_city' WHERE `users`.`user_id` = '$user_id'";

if ($dbc->query($update) === TRUE) {

    echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> Updated Successfully.
            </div>';

} else {

    echo "Error updating record: " . $dbc->error;
}

}


 $query = "SELECT * FROM users WHERE users.user_id = '$user_id'";

        $result = mysqli_query($dbc, $query);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {

                                $login_time = $row['login_time'];
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
                                $date = date("M jS, Y", strtotime("birthdate")); 

                                
                    }


            }else{

                echo "error no info to display";

            }



//changing TIME from database to actual time in text

    function seconds_from_time($login_time) {
    list($h, $m, $s) = explode(':', $login_time);
    return ($h * 3600) + ($m * 60) + $s;

}

$time = seconds_from_time("$login_time");

function secondsToTime($time) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$time");
    return $dtF->diff($dtT)->format('%a days %h hours %i minutes');

}

$timelaps = secondsToTime($time);
$empties = array('0 days', '0 hours', '0 minutes');



?>

<!-------Last logged in ------->

<form action="user-profile.php" method="post">
<div id="status"></div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="card p-2 text-center">

                    <form>
                        <div class="img-fluid m-2">

                         <img src=" <?php echo "images/"."$user_image" ?>"

                          class="rounded-circle img-profile" alt="avatar" id="image"/>

                        </div>
                        <h6>Upload a different photo...</h6>
                        <input type=file class="img-upload-input-bs" editor="#img-upload-panel" target="#image" status="#status" passurl="" pshape="circle" w=300 h=300 size="{150,150}"/></form>
 
                        <hr class="bg-white">

                    <label> <strong><?php echo "$title " . " $first_name " . " $last_name" ?></strong></label>
                    <label><?php echo $email; ?></label>
                    <label><small>Last Logged in:</small><small class="text-muted"><?php echo str_replace($empties, '', $timelaps); ?> ago</small></label>
                    <div><h5>Profile <span class="badge badge-danger">Admin</span></h5></div>  
            </div>
        </div>
            <div class="col-md-9">
                <div class="row">
                <div class="col-md-12">

                    <h4>Personal Info</h4>

                <hr class="bg-white">

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
                        <input class="form-control" type="text" name="date" value="<?php echo $date ?>" disabled>
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
                    <input type="text" class="form-control" id="address" value="<?php echo $address; ?>" name="address">
                  </div>
                  </div>

                  <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address 2</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="address2" value="<?php echo $address2; ?>" name="address2">
                  </div>
              </div>

                    <div class="form-group row">
                      <label for="colFormLabel" class="col-sm-2 col-form-label">City</label>
                      <div class="col-sm-10">
                      <input type="text" class="form-control text-capitalize" id="city" name="city" value="<?php echo $city; ?>">
                    </div>
                </div>

                     <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                          <select class="form-control input-sm" id="country" name="country">
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



 <!-------------------------- Upload image Bootstrap Modal ----------------------->
                          <div class="modal fade" id="img-upload-panel">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Upload Profile Photo</h4>
                                <button type="button" class="img-remove-btn-bs close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row container">
                                <div class="col">
                                    <div class="img-edit-container"></div>
                                </div>
                                </div>
                                <div class="row container text-center">
                                <div class="col">
                                    <button type="button" class="btn btn-secondary img-rotate-left"><i class="fas fa-undo"></i></button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-secondary img-rotate-right"><i class="fas fa-redo"></i></button>
                                </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary img-remove-btn-bs">Close</button>
                                <button type="button" class="btn btn-primary img-upload-btn-bs" name="upload_image">Upload</button>
                            </div>
                            </div>
                        </div>
                    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="image_upload/ImgUploader/croppie.min.js"></script>
<script src="image_upload/ImgUploader/imguploader.bs.minify.js"></script>


</body>
</html>
