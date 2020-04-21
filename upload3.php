<?php

$image3 = $target_dir . basename($three["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($image3,PATHINFO_EXTENSION));


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

$image3 = $target_dir .date_format($date,'m-d-Y_g-i-s').$three['name'];


if (file_exists($image3)) {

    echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong>Sorry, file already exists.
            </div>';


    $uploadOk = 0;

}

if ($three["size"] > 500000) {

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

    if (move_uploaded_file($three["tmp_name"], $image3)) {

        echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong>The file '. basename($three['name']). ' has been uploaded successfully.
            </div>';

    } else {


echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong>Sorry, there was an error uploading your file.
            </div>';
   
    }

}









