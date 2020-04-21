<?php

$image1 = $target_dir . basename($one["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($image1,PATHINFO_EXTENSION));


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif"){
 

echo '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong>Sorry, only JPG, JPEG, PNG & GIF files are allowed.
            </div>';

    $uploadOk = 0;
}


$date=date_create();

$image1 = $target_dir .date_format($date,'m-d-Y_g-i-s').$one['name'];


if (file_exists($image1)) {

    echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong>Sorry, file already exists.
            </div>';


    $uploadOk = 0;

}

if ($one["size"] > 500000) {

echo '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong>Sorry, your file is too large.
            </div>';


    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {


echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong>Sorry, your file was not uploaded.
            </div>';


// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($one["tmp_name"], $image1)) {

        echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong>The file '. basename($one['name']). ' has been uploaded successfully.
            </div>';

    } else {


echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong>Sorry, there was an error uploading your file.
            </div>';
   
    }

}









