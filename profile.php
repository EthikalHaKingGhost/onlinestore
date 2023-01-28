<?php session_start();


if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }



$page_title = "My Profile";

if (isset($_GET["userid"])) {

$userprofileid = $_GET["userid"];

$page_title = "User Profile";

}else{

header("location: profile.php?userid=".$_SESSION["user_id"]);

}


$icon = " ";

include "connect_db.php";

include "includes/header.php";


//creating the follow record in the DB
    if(isset($_GET['follow'])){

        
    $followersql = "INSERT INTO `followers` (`connect_id`, `follower_id`, `followed_id`, `connect_date`) VALUES (NULL, {$_SESSION[ 'user_id' ]}, '$userprofileid', current_timestamp());";

    $followerqry = mysqli_query($dbc, $followersql);


     $fullname = $_SESSION["first_name"]." ".$_SESSION["last_name"];

    $activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `activity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '$userprofileid', 'followed', current_timestamp());";

    $activity_qry = mysqli_query($dbc, $activity);

    
    if($followerqry){

        $icon = '<i class="fas fa-user-friends fa-1x"></i>';

    }

    else { echo "We were unable to record your follow request "; }

    }
    



    //removing record for an Unfollow
    if(isset($_GET['unfollow'])){

        $delfollowsql = "DELETE FROM followers WHERE followed_id = '$userprofileid' AND follower_id = {$_SESSION['user_id']}";

        $delfollowqry = mysqli_query($dbc, $delfollowsql);

        $fullname = $_SESSION["first_name"]." ".$_SESSION["last_name"];

        $activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `activity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '$userprofileid', 'unfollowed', current_timestamp());";

        $activity_qry = mysqli_query($dbc, $activity);

        

        if($delfollowqry){

            $icon = " ";

        }

        else { 

            echo '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> We were unable to record your feedback 
            </div>';
         }
        }





 $userprofilesql = "SELECT * FROM users WHERE users.user_id = '$userprofileid'";

        $userprofileqry = mysqli_query($dbc, $userprofilesql);

        if (mysqli_num_rows($userprofileqry) > 0) {

            while($row = mysqli_fetch_assoc($userprofileqry)) {
                                $activeuser = $row["user_id"];
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
                                $bio = $row["bio"];

                                $reg_date = $row["reg_date"];
                                $new_date = date("M jS, Y h:i:s", strtotime("reg_date")); 

                                $birthdate = $row["date"];
                                $dateofbirth = date("M jS, Y", strtotime("birthdate")); 

                    }


            }else{

          
                ?>

                <section class="slice sct-color-1">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="text-center">
                                        <div class="d-block p-2">
                                            <i class="fas fa-user-times text-danger fa-5x"></i>
                                        </div>
                                        <h2 class="heading heading-3 strong-600">User no Longer a Member</h2>
                                        <p class="mt-5 px-5">
                                           This User has either been removed or is no longer a member of Topcellers account. 
                                        </p>
                                        <button class="btn btn-danger" onclick="history.go(-1)"; ><i class="fas fa-backward"></i> Previous Page</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <?php 

                

            }

?>
<!-------User profile using wrap ------------>
<div class="container-fluid bg-light">
<div class="row justify-content-center">
<div class="col-md-8">
            <div class="wrap bg-secondary text-center" style="background-image: url(images/blur-background10.jpg); background-size: cover; background-position: center;">

                
                <?php 

                if ($_SESSION["user_id"] == $userprofileid){

                    echo '<a href="user-profile.php" title="Edit profile"><img class="blockico rounded-circle bg-light border border-secondary" src="'.$user_image.'" width="200px" height="200px"></a>';
                    
                }else{

                    echo '<img class="blockico rounded-circle bg-light border border-secondary" src="'.$user_image.'" width="200px" height="200px">';
                }


                ?>
                </div>
                <div class="row m-0 pt-5 bg-white justify-content-center">
                <h1 class="pt-5 pb-3">

                <?php 

                if ($_SESSION["user_id"] == $userprofileid){

                    ?>

                     <a href="user-profile.php" class="text-dark" title="Edit profile"><?php echo "$title " . " $first_name " . " $last_name "; ?> <i class="fas fa-edit"></i></a>

                    <?php
                    
                }else{

                

                echo "$title " . " $first_name " . " $last_name " . " $icon";

                }


                ?>

                            </h1>
                </div>
                <div class="row m-0 bg-white">
                    <div class="col-md-2 offset-md-5">

                <?php

                //checking database for a follow record
                $followsql = "SELECT * FROM followers WHERE follower_id = {$_SESSION[ 'user_id' ]} AND followed_id ='$userprofileid'";
            
                $followqry = mysqli_query($dbc, $followsql);
                
                //if no records exist
                if(mysqli_num_rows($followqry) == 0)
                {
                    
                    //if it's the viewer's profile
                    if($_SESSION[ 'user_id' ] !== $userprofileid){
                        //allow user to follow profile
                    ?>

                        <a class="btn btn-primary btn-sm btn-block" href="profile.php?userid=<?php echo $userprofileid; ?>&follow=<?php echo $userprofileid; ?>" title="UserID=<?php echo $userprofileid; ?>">
                            <span class="text-dark font-weight-bold">follow</span>
                        </a>
                
                    <?php

                    }else{

                        //do nothing 
                    }


                }else{
                            //allow user to Unfollow profile
                    ?>
                    
                    <a class="btn btn-outline-primary btn-sm btn-block" href="profile.php?userid=<?php echo $userprofileid; ?>&unfollow=<?php echo $userprofileid; ?>" title="UserID=<?php echo $userprofileid; ?>"><span class="text-dark font-weight-bold">Unfollow</span>
                    </a>    

                    <?php
                        }
                    ?>

                    </div>
                </div>

                <div class="row bg-white m-0 justify-content-center">
                    <div class="p-3">
                Followers: <span class=" badge rounded-1 bg-secondary text-white p-2">
                  
                  <?php

                  //Posts count all distinct posts from post_feedback table

                $flwcountsql = "SELECT * FROM followers WHERE followed_id = $userprofileid";

                if ($flwcountqry = mysqli_query($dbc, $flwcountsql))

                {
                    // Return the number of rows in result set
                    $count = mysqli_num_rows($flwcountqry);

                    mysqli_free_result($flwcountqry);

                }

                if($count > 0)

                echo $count;

            else{

                echo "No Followers";
                
                }


                  ?>

                </span>
                    </div>
                </div>

                    <div class="row m-0 p-5 pt-5 bg-white">
                    <div class="col-sm-2">
                        <label class="h6">Phone</label>
                    </div>
                    <div class="col-sm-10">
                    <p><?php echo $cellphone; ?></p>
                    </div>
                
                    
                    <div class="col-sm-2">
                        <label class="h6">Email</label>
                    </div>
                    <div class="col-sm-10">
                    <p><?php echo $email; ?></p>
                    </div>
                    
                    
                    <div class="col-sm-2">
                        <label class="h6">Gender</label>
                    </div>
                    <div class="col-sm-10">
                    <p>Male</p>
                    </div>
                    
                    
                    <div class="col-sm-2">
                        <label class="h6">Date of Birth</label>
                    </div>
                    <div class="col-sm-10">
                    <p><?php echo $dateofbirth; ?></p>
                    </div>
                    

                    <div class="col-sm-2 spacer">
                        <label class="h6">Bio</label>
                    </div>
                    <div class="col-sm-10 pr-5 text-justify">
                    <p class="font-italic"><?php echo $bio; ?></p>
                        </div>
                    
                </div>
            </div>
        </div>


<div class="col-md-6 offset-md-3 p-5">
 <h2>Recent Activity</h2>
 <!-- <hr class="my-4"> -->

 <div class="card">
 <div class="card-body">



 <?php

$activitysql = "SELECT * FROM followers WHERE follower_id = {$_SESSION[ 'user_id' ]} AND followed_id ='$userprofileid'";

        $activityqry = mysqli_query($dbc, $activitysql);

        if ((mysqli_num_rows($activityqry) > 0) or ($_SESSION["user_id"] == $userprofileid)) {


 $sql = "SELECT * FROM user_activity WHERE user_id = '$userprofileid' ORDER BY user_activity.activity_date LIMIT 5";

 $query = mysqli_query( $dbc, $sql ) ;

 if(mysqli_num_rows($query) > 0){

 while ($row = mysqli_fetch_array( $query, MYSQLI_ASSOC ))
 {

 $fullname = $row['fullname'];
 $activity_log = $row['activity_log'];
 $activity_date = strtotime($row['activity_date']);
 $activity_details = $row['activity_details'];

 //processing post date value
 $now = strtotime(date("m/d/Y h:i:s a", time()));
 //difference in seconds
 $actdate = ($now - $activity_date) - 21600;


 if($actdate < 3600){
 //posted within one hour
 $newdate = round($actdate/60);
 $activitytime = $newdate . " minute(s) ago.";
 }
 elseif($actdate < 86400){
 //posted within one day
 $newdate = round($actdate/3600);
 $activitytime = $newdate . " hour(s) ago.";
 }
 else {
 //posted over a day ago
 $newdate = round($actdate/86400);
 $activitytime = $newdate . " day(s) ago.";
 }

 if($activity_log == "placeorder"){
    
 ?>

 <div class="alert alert-success" role="alert">
 <?php echo $fullname." placed an order. <b>".$activitytime.
"</b>"; ?>
 </div>
 <?php

 }


 elseif($activity_log == "postedmessage"){
 ?>
 <div class="alert alert-primary" role="alert">
 <?php echo $fullname." created a post. <b>".$activitytime."</b>"
; ?>
 </div>

 <?php
 }


 elseif($activity_log == "updatedprofile"){
 ?>
 <div class="alert alert-success" role="alert">
 <?php echo $fullname." updated their profile picture <b>".$activitytime."</b>"
; ?>
 </div>

 <?php
 }


  elseif($activity_log == "Loggedin"){
 ?>
 <div class="alert alert-success" role="alert">
 <?php echo $fullname." Logged into account <b>".$activitytime."</b>"
; ?>
 </div>

 <?php
 }


  elseif($activity_log == "Loggedout"){
 ?>
 <div class="alert alert-danger" role="alert">
 <?php echo $fullname. " Logged out from account <b>".$activitytime."</b>"; ?>
 </div>

 <?php
 }



 elseif($activity_log == "updatedprofilepic"){
 ?>
 <div class="alert alert-primary" role="alert">
 <?php echo $fullname." Updated their profile picture. <b>".$activitytime."</b>"
; ?>
 </div>

 <?php
 }


 elseif($activity_log == "liked"){
 ?>
 <div class="alert alert-primary" role="alert">
 <?php echo $fullname." liked a post <b>".$activitytime."</b>";
?>
 </div>

 <?php
 }

 elseif($activity_log == "unliked"){
 ?>
 <div class="alert alert-danger" role="alert">
 <?php echo $fullname." unliked a post <b>".$activitytime."</b>";
?>
 </div>

 <?php
 }

 elseif($activity_log == "disliked"){
 ?>
 <div class="alert alert-danger" role="alert">
 <?php echo $fullname." disliked a post <b>".$activitytime."</b>";
?>
 </div>

 <?php
 }


 elseif($activity_log == "undisliked"){
 ?>
 <div class="alert alert-success" role="alert">
 <?php echo $fullname." removed diliked from post <b>".$activitytime."</b>";
?>
 </div>

 <?php
 }


 elseif($activity_log == "followed"){
 ?>
 <div class="alert alert-warning" role="alert">
 <?php echo $fullname." followed user <b>".$activitytime."</b>";
?>
 </div>
 <?php
 }


 elseif($activity_log == "unfollowed"){
 ?>
 <div class="alert alert-danger" role="alert">
 <?php echo $fullname." unfollowed user. <b>".$activitytime.
"</b>"; ?>
 </div>

 <?php
 }

 elseif($activity_log == "Registered"){

 $currentuser = $_SESSION['user_id'];

 if($currentuser == $userprofileid){
 ?>
<div class="alert alert-secondary" role="alert">
 <?php echo " You registered <b>".$activitytime."</b>"; ?>

 </div>
 <?php

 }

 else {

 ?>
 <div class="alert alert-secondary" role="alert">
 <?php echo $fullname." registered <b>".$activitytime."</b>"; ?>
 </div>
 <?php
 }
 }

}
}else{


    echo "<em class='text-center'>User has not been active</em>";

}

}else{

echo "<em class='text-center'>Please follow to see recent activity! </em>";
}
?>
 </div>
 </div>
 </div>
 </div>





<?php include "includes/footer.php"; ?>

