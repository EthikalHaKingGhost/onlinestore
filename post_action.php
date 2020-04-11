<?php # PROCESS MESSAGE POST.

# Access session.
session_start();

# Make load function available.
require ( 'login_tools.php' ) ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { load() ; }

# Set page title and display header section.
$page_title = 'Post Error' ;
include ( 'includes/header.html' ) ;

# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  # Check Subject and Message Input.
  if ( empty($_POST['subject'] ) ) { echo '<p>Please enter a subject for this post.</p>'; }
  if ( empty($_POST['message'] ) ) { echo '<p>Please enter a message for this post.</p>'; }

  # On success add post to forum database.
  if( !empty($_POST['subject']) &&  !empty($_POST['message']) )

  {
    # Open database connection.
    require ( 'connect_db.php' ) ;

  $user_id = $_SESSION["user_id"];
  $firstname = $_SESSION['first_name'];
  $lastname =  $_SESSION['last_name'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

# Grab the user image and other data
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

            $user_image = $row["user_image"];
 
    }
}
	
  
    # Execute inserting into 'forum' database table.
    $query= "INSERT INTO forum(first_name,last_name,subject,message,post_date,user_image) 
          VALUES ('$firstname','$lastname','$subject','$message',NOW(),'$user_image' )";
    $result = mysqli_query ( $dbc, $query ) ;

    # Report error on failure.
    if (mysqli_affected_rows($dbc) != 1) { echo '<p>Error</p>'.mysqli_error($dbc); } else { load('forum.php'); }
    
    # Close database connection.
    mysqli_close( $dbc ) ; 
    }
 } 
 
# Create a hyperlink back to the forum page.
echo '<p><a href="forum.php">Forum</a>' ;
 
# Display footer section.
include ( 'includes/footer.html' ) ;

?>