<?php # PROCESS MESSAGE POST.

# Access session.
session_start();

# Make load function available.
require ( 'login_tools.php' ) ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { load() ; }

# Set page title and display header section.
$page_title = 'Post Error' ;

# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{


  # Check Subject and Message Input.
  if ( empty($_POST['subject'] ) ) { 
 echo '<p>A post subject is required.</p>'; 
 }
  

 if ( empty($_POST['message'] ) ) {
 echo '<p>A message is required for posting.</p>'; 
 }

  # On success add post to forum database.
  if( !empty($_POST['subject']) &&  !empty($_POST['message']) )
  {
    # Open database connection.
    require ( 'connect_db.php' ) ;
  
    # Execute inserting into 'forum' database table.


  $forumsql= "INSERT INTO forum(user_id, first_name, last_name, subject, message, post_date) 
          VALUES ('{$_SESSION['user_id']}','{$_SESSION['first_name']}','{$_SESSION['last_name']}','{$_POST['subject']}','{$_POST['message']}',NOW())";

    $forumres = mysqli_query ( $dbc, $forumsql ) ;


    $fullname = $_SESSION['first_name']." ".$_SESSION['last_name'];

    $postid = mysqli_insert_id($dbc);

    $activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `acitivity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '$postid', 'postedmessage', current_timestamp());";

      $activity_qry = mysqli_query($dbc, $activity);


    # Report error on failure.
    if (mysqli_affected_rows($dbc) != 1) { echo '<p>Error</p>'.mysqli_error($dbc); } else { load('forum.php'); }
    
    # Close database connection.
    mysqli_close( $dbc ) ; 
    }
 } 




?>

