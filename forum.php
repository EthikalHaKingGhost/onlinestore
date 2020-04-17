<?php # DISPLAY COMPLETE FORUM PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Forum' ;
include ( 'includes/header.php' ) ;

# Open database connection.
require ( 'connect_db.php' ) ;

//user clicks Like button
if(isset($_GET['like'])){
	$postid = $_GET['like'];
	
	//like record insertion
	$likesql = "INSERT INTO post_feedback (post_id, user_id, feedback_type, feedback_date) VALUES('$postid', {$_SESSION[ 'user_id' ]}, 'like', NOW())";

	$likeqry = mysqli_query($dbc, $likesql);
	
	if($likeqry){

		$dellikesql = "DELETE FROM post_feedback WHERE post_id='$postid' AND user_id = {$_SESSION['user_id']} AND feedback_type = 'dislike'";

		$dellikeqry = mysqli_query($dbc, $dellikesql);
	}

	else { echo "We were unable to record your like feedback "; }

}

//user clicks on Dislike Button
if(isset($_GET['dislike'])){

	$postid = $_GET['dislike'];
	
	$dislikesql = "INSERT INTO post_feedback(post_id, user_id, feedback_type, feedback_date) VALUES('$postid', {$_SESSION[ 'user_id' ]}, 'dislike', NOW())";

	$dislikeqry = mysqli_query($dbc, $dislikesql);
	
	if($dislikeqry){

		$deldislikesql = "DELETE FROM post_feedback WHERE post_id = '$postid' AND user_id = {$_SESSION['user_id']} AND feedback_type = 'like'";

		$deldislikeqry = mysqli_query($dbc, $deldislikesql);
	}

	else { echo "We were unable to record your feedback "; }

}



//user clicks unLike button
if(isset($_GET['unlike'])){
	$postid = $_GET['unlike'];
	
		$delunlikesql = "DELETE FROM post_feedback WHERE post_id='$postid' AND user_id = {$_SESSION['user_id']} AND feedback_type = 'like'";

		$delunlikeqry = mysqli_query($dbc, $delunlikesql);
}

//user clicks unLike button
if(isset($_GET['undislike'])){
	$postid = $_GET['undislike'];
	
		$delundislikesql = "DELETE FROM post_feedback WHERE post_id='$postid' AND user_id = {$_SESSION['user_id']} AND feedback_type = 'dislike'";

		$delundislikeqry = mysqli_query($dbc, $delundislikesql);
}


# Display body section, retrieving from 'forum' database table.
$forumsql = "SELECT * FROM forum" ;
$forumqry = mysqli_query( $dbc, $forumsql ) ;
if ( mysqli_num_rows( $forumqry) > 0 )
{
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-3">

</div>	

<div class="col-md-7">	
  
<?php
  while ( $row = mysqli_fetch_array( $forumqry, MYSQLI_ASSOC ))
  {
	  
	//processing post date value
	$now = strtotime(date("m/d/Y h:i:s a", time()));
	$postdate = strtotime($row['post_date']);
	//difference in seconds
	$datedif = ($now - $postdate) - 21600;
	
	if($datedif < 3600){
		//posted within one hour
		$datecalc = round($datedif/60);
		$posted = $datecalc . " minute(s) ago.";
	}
	elseif($datedif < 86400){
		//posted within one day
		$datecalc = round($datedif/3600);
		$posted = $datecalc . " hour(s) ago.";
	}
	else {
		//posted over a day ago
		$datecalc = round($datedif/86400);
		$posted = $datecalc . " day(s) ago.";
	}
?>


<div class="card box-shadow rounded-0 text-dark">
	<div class=" my-0 mx-3 card-body">
			<div class="row my-0">              
				
				<label class="text-capitalize pb-0 h5"><img class="rounded-circle" width="50" src="<?php echo "images/"."$user_image" ?>" alt="Image">

		<a href="profile.php?userid=<?php echo $row['user_id']; ?>">
			<?php echo $row['first_name'] .' '. $row['last_name']; ?>
		</a>

		<span class="text-muted text-lowercase mt-0 pt-0 small"><?php echo $posted ?></span></label>

            </div>
            
          	<div class="row">
			<p class="list-inline-item m-0 font-weight-bold text-capitalize"><?php echo $row['subject']; ?></p>
        	</div>

        	<div class="row">
              <p class="text-justify"><?php echo $row['message']; ?></p>
            </div>

            <?php 
			//assign variable for PostID
			$likepost = $row['post_id'];


			//checking database for a like record
				$checksql1 = "SELECT * FROM post_feedback WHERE user_id = {$_SESSION[ 'user_id' ]} AND post_id = '$likepost'";

				$checkquery1 = mysqli_query($dbc, $checksql1);

			//if no records exist
				if(mysqli_num_rows($checkquery1) == 0)

				{

					?>
           <div class="row">
               <ul class="list-inline d-sm-flex ml-auto my-0">
                <li class="list-inline-item">
                  <a class="text-decoration-none text-info" href="forum.php?like=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
                    <i class="far fa-thumbs-up"></i>
                    178
                  </a>
                </li>

                <li class="list-inline-item">
                  <a class="text-decoration-none text-info" href="href="forum.php?dislike=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>"">
                    <i class="far fa-thumbs-down"></i>
                    34
                  </a>
                </li>
            </div>

<?php

		}else{


			//checking database for a like record
				$checksql = "SELECT * FROM post_feedback WHERE user_id = {$_SESSION[ 'user_id' ]} AND post_id = '$likepost' AND feedback_type = 'like' ";

				$checkquery = mysqli_query($dbc, $checksql);

			//if no records exist
				if(mysqli_num_rows($checkquery) == 0)

				{

?>
           <div class="row">
               <ul class="list-inline d-sm-flex ml-auto my-0">
                <li class="list-inline-item">
                	<a class="text-decoration-none text-info" href="forum.php?like=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
					<i class="far fa-thumbs-up"></i>
                    178
                  </a>
                </li>

                <li class="list-inline-item">
                  <a class="text-decoration-none text-info" href="forum.php?undislike=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
                    <i class="fas fa-thumbs-down"></i>
                    34
                  </a>
                </li>
            </div>
<?php
			}else{

			$checksql2 = "SELECT * FROM post_feedback WHERE user_id = {$_SESSION[ 'user_id' ]}AND post_id = '$likepost' AND feedback_type = 'dislike' ";

				 	$checkquery2 = mysqli_query($dbc, $checksql2);

				 	//if(mysqli_num_rows($checkquery2) == 0)
				 	if (mysqli_num_rows($checkquery) > 0)

					{	

					?>

			<div class="row">
               <ul class="list-inline d-sm-flex ml-auto my-0">
                <li class="list-inline-item">
                  <a class="text-decoration-none text-info" href="forum.php?unlike=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
                    <i class="fas fa-thumbs-up"></i>
                    178
                  </a>
                </li>

                <li class="list-inline-item">
                  <a class="text-decoration-none text-info" href="forum.php?dislike=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
                    <i class="far fa-thumbs-down"></i>
                    34
                  </a>
                </li>
            </div>

				<?php

						}
					}

				}
					?>
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



