<?php # DISPLAY COMPLETE FORUM PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Forum' ;

include ( 'includes/header.php' ) ; ?> 


<style type="text/css">
	
.box-shadow{
 box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
 width:100%;
  }

</style>

<div class="container-fluid">

<div class="row">

<div class="col-md-3">

</div>	

<div class="col-md-7">	

<?php

# Open database connection.
require ( 'connect_db.php' ) ; 


if(isset($_GET['like'])){

	$feedback_id = $_GET['like'];
	
	$query = "INSERT INTO `post_feedback` (`feedback_id`, `post_id`, `user_id`, `feedback_type`, `feedback_date`) VALUES (NULL, '$feedback_id', '{$_SESSION[ 'user_id' ]}', 'like', NOW())";

	$result = mysqli_query($dbc, $query);
	
	if($result){

		echo "Thank you for liking the content";
	}
	else { echo "We were unable to record your positive feedback "; }
}

if(isset($_GET['dislike'])){

	$feedback_id = $_GET['dislike'];

	$query = "INSERT INTO `post_feedback` (`feedback_id`, `post_id`, `user_id`, `feedback_type`, `feedback_date`) VALUES (NULL, '$feedback_id', '{$_SESSION[ 'user_id' ]}', 'dilike', NOW())";
	

	$result = mysqli_query($dbc, $query);
	
	if($result){

		echo "Thank you for your honest feedback";
	}

	else { echo "We were unable to record your feedback "; }
}




# Display body section, retrieving from 'forum' database table.
$query = "SELECT * FROM forum" ;

$result = mysqli_query( $dbc, $query) ;

if ( mysqli_num_rows( $result ) > 0 )

{
  

  while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ))

  {

  	$first_name = $row['first_name'];
  	$last_name = $row['last_name'];
  	$message = $row['message'];
  	$subject = $row['subject'];
  	$user_image = $row["user_image"];

//processing post date value
	$now = strtotime(date("m/d/Y h:i:s a", time()));
	$post_date = strtotime($row['post_date']);
	//difference in seconds
	$newdate = ($now - $post_date) - 21600;
	
	if($newdate < 3600){
		//posted within one hour
		$date = round($newdate/60);
		$dateposted = $date . " minute(s) ago.";
	}
	elseif($newdate < 86400){
		//posted within one day
		$date = round($newdate/3600);
		$dateposted = $date . " hour(s) ago.";
	}
	else {
		//posted over a day ago
		$date = round($newdate/86400);
		$dateposted = $date . " day(s) ago.";
	}

//checking database for a like record
$sql = "SELECT * FROM post_feedback WHERE user_id ={$_SESSION[ 'user_id' ]}";
			
$feedback = mysqli_query($dbc, $sql);
				
		if($feedback){

					$like = $row['post_id'];

					$dislike = $row['post_id'];
				}
			
			?>


<div class="card box-shadow rounded-0 text-dark">
	<div class=" my-0 mx-3 card-body">
			<div class="row my-0">              
				
				<label class="text-capitalize pb-0 h5"><img class="rounded-circle" width="50" src="<?php echo "images/"."$user_image" ?>" alt="Image"><?php echo " $first_name " . " $last_name " ?><span class="text-muted text-lowercase mt-0 pt-0 small"><?php echo $dateposted ?></span></label>

            </div>
            
          	<div class="row">
			<p class="list-inline-item m-0 font-weight-bold text-capitalize"><?php echo $subject; ?></p>
        	</div>

        	<div class="row">
              <p class="text-justify"><?php echo $message; ?></p>
            </div>

           <div class="row">
               <ul class="list-inline d-sm-flex ml-auto my-0">
                <li class="list-inline-item">
                  <a class="text-decoration-none text-info" href="forum.php?like=<?php echo $like; ?>">
                    <i class="fa fa-thumbs-up"></i>
                    178
                  </a>
                </li>

                <li class="list-inline-item">
                  <a class="text-decoration-none text-info" href="forum.php?dislike=<?php echo $dislike; ?>">
                    <i class="fa fa-thumbs-down"></i>
                    34
                  </a>
                </li>
            </div>
</div>
</div>

<?php

  }
 
?>

<div class="col-md-2">
	
</div>

</div>
</div>
</div>

<?php

}


else { echo '<p>There are currently no messages.</p>' ; }

# Create navigation links.
echo '<p><a href="post.php">Post Message</a> | <a href="shop.php">Shop</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;

# Close database connection.
mysqli_close( $dbc ) ;



  
# Display footer section.
include ( 'includes/footer.php' ) ;


?>
