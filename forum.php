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

?>

<div class="container-fluid m-0 p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light rounded-0">
                    <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-dark">Discussion</a></li>
                    <li class="breadcrumb-item active text-danger font-weight-bold" aria-current="page">How to Set Up Your New Phone?</li>
                </ol>
            </nav>
        </div>


<div class="container-fluid m-0 p-0 ">

<div class="text-center">

<div class="container-fluid py-5 bg-dark text-danger">
	<span class="h2">How to Setup your New Phone ?</span>
</div>

</div>

<div class="row">

<div class="col-md-3">
	
</div>

<div class="col-md-6 text-justify">

<div class="text-center py-3">
<img src="images/setupphone.jpg" class="img-fluid" >
</div>

<p>
	What a lovely new iPhone you have! Here’s how to get acquainted with it to ensure a two-to-four year lifetime, give or take, of happiness. Or just one, if you’re an annual upgrade person.</p>

<p>When you turn on your new iPhone, you’ll be greeted by the Setup Assistant, through which you’ll establish essentials like your Wi-Fi network and six-digit passcode, Face ID, your Apple ID and iCloud account, and whether you want to activate Find My Phone and Location Services. You’ll also be asked if you want to set up Siri (you do!), which includes saying a few phrases so the assistant can get to know your voice.</p>

<p>It sounds like a lot of decisions and inputs, but the whole process takes only a few minutes. Better yet, none of these choices are binding; you can find them all again later under Settings.</p>


<iframe width="655" height="340" src="https://www.youtube.com/embed/9P_TIzw6nIY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


<p class="pt-2">After you’re done with the basics, it’s time to make that beauty truly yours, by topping it off with all of your contacts, apps, and content. You can do this the easy way or the hard way. Which path you choose will likely depend on whether this is your first iPhone or iPad.</p>

<p>If you’re an Apple vet, you can simply select Restore from iCloud Backup or Restore from iTunes Backup (speaking of which, make sure to back up your old device before you do this). Then enter your Apple ID and password, and go grab a peppermint mocha while your iPhone restarts with all of your settings, preferences, apps, and more in place. In other words, it’ll be just like your old device, but … newer.</p>

</div>

<div class="col-md-3">
	
</div>

</div>

<?php 


$fullname = $_SESSION["first_name"]." ".$_SESSION["last_name"];

//user clicks Like button
if(isset($_GET['like'])){

	$postid = $_GET['like'];
	
	//like record insertion
	$likesql = "INSERT INTO post_feedback (post_id, user_id, feedback_type, feedback_date) VALUES('$postid', {$_SESSION[ 'user_id' ]}, 'like', NOW())";

	$likeqry = mysqli_query($dbc, $likesql);
	
	if($likeqry){

		$dellikesql = "DELETE FROM post_feedback WHERE post_id = '$postid' AND user_id = {$_SESSION['user_id']} AND feedback_type = 'dislike'";

		$dellikeqry = mysqli_query($dbc, $dellikesql);


  		$activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `activity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '$postid', 'liked', current_timestamp());";

  		$activity_qry = mysqli_query($dbc, $activity);

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

		$activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `activity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '$postid', 'disliked', current_timestamp());";

  		$activity_qry = mysqli_query($dbc, $activity);

	}

	else { echo "We were unable to record your feedback "; }

}


//user clicks unLike button
if(isset($_GET['unlike'])){

	$postid = $_GET['unlike'];
	
		$delunlikesql = "DELETE FROM post_feedback WHERE post_id='$postid' AND user_id = {$_SESSION['user_id']} AND feedback_type = 'like'";

		$delunlikeqry = mysqli_query($dbc, $delunlikesql);

		$activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `acitivity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '$postid', 'unliked', current_timestamp());";

  		$activity_qry = mysqli_query($dbc, $activity);
}



//user clicks unLike button
if(isset($_GET['undislike'])){

	$postid = $_GET['undislike'];
	
		$delundislikesql = "DELETE FROM post_feedback WHERE post_id='$postid' AND user_id = {$_SESSION['user_id']} AND feedback_type = 'dislike'";

		$delundislikeqry = mysqli_query($dbc, $delundislikesql);

		$activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `acitivity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '$postid', 'undisliked', current_timestamp());";

  		$activity_qry = mysqli_query($dbc, $activity);
}


if(isset($_GET["del"])){

    $deletepost = $_GET["del"];

// sql to delete a record in multiple tables using left join
$deletesql = "DELETE FROM forum WHERE forum.post_id = '$deletepost';";

 $deleted = mysqli_query($dbc, $deletesql);

 $deletesql2 = "DELETE FROM post_feedback WHERE post_feedback.post_id = '$deletepost'";

 $deleted2 = mysqli_query($dbc, $deletesql);

if (($deleted && $deleted2) > 0){

     echo '<div class="col-md-6 offset-md-3">
     <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message! </strong> Post ID '.$deletepost.' deleted Successfully.
            </div></div>';
}else{

	echo "failed";
}

}

# Display body section, retrieving from 'forum and users table for extra validation.
$forumsql = "SELECT * FROM forum, users WHERE users.user_id = forum.user_id ORDER BY `forum`.`post_date` DESC";
$forumqry = mysqli_query( $dbc, $forumsql ) ;
if ( mysqli_num_rows( $forumqry) > 0 )

{


?>

<div class="comments section">

<div class="row">


<div class="col-md-3">

</div>	


<div class="col-md-6">

<h2 class="h2 pb-2">Comments</h2>

<p class="font-italic pb-2 pl-1"><a href="#typecomment" class="text-decoration-none">Type a comment</a></p>

<?php

  while ( $row = mysqli_fetch_array( $forumqry, MYSQLI_ASSOC )){

  	$postuser = $row["user_id"];

	  
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

<hr>
<div class="row pl-2 pr-3">

	<div class="col-sm-2">
		<img class="rounded-circle" width="50" height="50px" src="<?php echo $row["user_image"]; ?>" alt="Image">
	</div>



<div class="col-sm-10">
	<?php 

	//if ($_SESSION["usertype"] !== 'Admin') {
		



		$delforum = "SELECT * FROM forum WHERE forum.user_id = '{$_SESSION['user_id']}' AND forum.post_id = '{$row['post_id']}'";

		$delforumqry = mysqli_query( $dbc, $delforum );

  	
		//if no records exist
				if(mysqli_num_rows($delforumqry) > 0)
				{
					
					//if it's the viewer's profile
					if($_SESSION[ 'user_id' ] !== $postuser){
						//allow user to follow profile
						
					}
					else{
						
						?>
						
					<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><span class="float-right" ><i class="fas fa-trash-alt text-dark"></i></span></a>
					<?php

					}
				}

				else 

				{
							//allow user to Unfollow profile
					
				}

?>
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
                                        
                                          Are you sure you want to delete  this post ?
                                        </div>
                                        
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <a class="btn btn-danger btn-sm text-light" href="forum.php?del=<?php echo $row['post_id']; ?>">Delete</a>
                                          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
                                        </div>
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div>



<div class="row pr-3">

	<div class="text-capitalize h5">
		<a href="profile.php?userid=<?php echo $row['user_id']; ?>" class="text-decoration-none">
			<?php echo $row['first_name'] .' '. $row['last_name']; ?>
		</a>

		<span class="text-muted text-lowercase small"><?php echo $posted ?></span>

	</div>
</div>
            
            
          	<div class="row">
			<p class="list-inline-item m-0 font-weight-bold text-capitalize"><?php echo $row['subject']; ?></p>
        	</div>

        	<div class="row">
              <p class="text-justify font-italic"><?php echo $row['message']; ?></p>
            </div>

            <?php 
			//assign variable for PostID
			$likepost = $row['post_id'];

			//like count
 			$countsql1 = "SELECT feedback_type, post_id FROM post_feedback WHERE feedback_type = 'like' AND post_id = '$likepost'";

                if ($countqry = mysqli_query($dbc, $countsql1))

                {
                    // Return the number of rows in result set
                    $likes = mysqli_num_rows($countqry);

                    mysqli_free_result($countqry);

                }


               //dislike count 
                $countsql2 = "SELECT feedback_type, post_id FROM post_feedback WHERE feedback_type = 'dislike' AND post_id = '$likepost'";

                if ($countqry2 = mysqli_query($dbc, $countsql2))

                {
                    // Return the number of rows in result set
                    $dislikes = mysqli_num_rows($countqry2);

                    mysqli_free_result($countqry2);

                }



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
                  <a class="text-decoration-none text-info" id="refresh" href="forum.php?like=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
                    <i class="far fa-thumbs-up fa-x1"></i>
                    <?php echo $likes ?>
                  </a>
                </li>

                <li class="list-inline-item">
                  <a class="text-decoration-none text-info" id="refresh1" href="forum.php?dislike=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
                    <i class="far fa-thumbs-down fa-x1"></i>
                    <?php echo $dislikes ?>
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
                	<a class="text-decoration-none text-info" id="refresh" href="forum.php?like=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
					<i class="far fa-thumbs-up fa-x1"></i>
                    <?php echo $likes ?>
                  </a>
                </li>

                <li class="list-inline-item">
                  <a class="text-decoration-none text-info" id="refresh" href="forum.php?undislike=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
                    <i class="fas fa-thumbs-down fa-x1"></i>
                    <?php echo $dislikes ?>
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
                  <a class="text-decoration-none text-info" id="refresh" href="forum.php?unlike=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
                    <i class="fas fa-thumbs-up fa-x1"></i>
                    <?php echo $likes ?>
                  </a>
                </li>

                <li class="list-inline-item">
                  <a class="text-decoration-none text-info" id="refresh" href="forum.php?dislike=<?php echo $row['post_id']; ?>" title="PostID=<?php echo $row['post_id']; ?>">
                    <i class="far fa-thumbs-down fa-x1"></i>
                    <?php echo $dislikes ?>
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
<?php

				//Posts count all distinct posts from post_feedback table

                $postsql = "SELECT post_id FROM forum";

                if ($postsresults = mysqli_query($dbc, $postsql))

                {
                    // Return the number of rows in result set
                    $posts = mysqli_num_rows($postsresults);

                    mysqli_free_result($postsresults);

                }
?>


			<hr>

<div class="row p-1">
<div class="col">
		<p class="font-italic inline-text pl-1 float-left py-3" id="typecomment">Add a comment or <a href="goodbye.php">logout?</a></p>

		<b class="font-italic inline-text font-weight-bold float-right py-3"><?php echo "$posts " . " post(s)"; ?></b>
</div>
</div>





</div>
<div class="col-md-3">
	
</div>
</div>
</div>

<?php

}

else {

 echo '<p>There are currently no messages.</p>' ;
  }
?>

<?php include 'includes/post.html'; ?>

</div>

<?php

# Close database connection.
mysqli_close( $dbc ) ;

?>



 <?php 

# Display footer section.
include ( 'includes/footer.php' ) ;

?>



