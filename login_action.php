<?php # PROCESS LOGIN ATTEMPT.

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{

  //save this user and pass as cookie if remember checked end
  # Open database connection.
  require ( 'connect_db.php' ) ;

  # Get connection, load, and validate functions.
  require ( 'login_tools.php' ) ;

  # Check login.
  list ( $check, $data ) = validate ( $dbc, $_POST[ 'email' ], $_POST[ 'pass' ] ) ;

  # On success set session data and display logged in page.
  if ( $check )

  {

echo "passthrough";

    # Access session.
    session_start();
    $_SESSION[ 'user_id' ] = $data[ 'user_id' ] ;
    $_SESSION[ 'first_name' ] = $data[ 'first_name' ] ;
    $_SESSION[ 'last_name' ] = $data[ 'last_name' ] ;
    $_SESSION[ 'login_time' ] = $data[ 'login_time' ] ;
    $_SESSION[ 'usertype' ] = $data[ 'usertype' ] ;
    $_SESSION[ 'user_image' ] = $data[ 'user_image' ] ;
    $_SESSION["address"] = $data[ 'address' ] ;
    $_SESSION["address2"] = $data[ 'address2' ] ;
    $_SESSION["country"] = $data[ 'countryname' ] ;
    $_SESSION["city"] = $data[ 'city' ] ;
    $user_id = $_SESSION[ 'user_id' ];

    print_r ($_SESSION[ 'usertype' ]);


 require ( 'connect_db.php' ) ;

          $fullname = $_SESSION["first_name"]." ".$_SESSION["last_name"];

          $activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `acitivity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '{$_SESSION["user_id"]}', 'Logged in', current_timestamp());";

          $activity_qry = mysqli_query($dbc, $activity);
          

$update = "UPDATE `users` SET `login_time` = time() WHERE `user_id` = '$user_id'";

if ($dbc->query($update) === TRUE) {

echo "upated";

}

    load ( 'home.php' ) ;

  }
  # Or on failure set errors.
  else { $errors = $data; } 

  # Close database connection.
  mysqli_close( $dbc ) ; 
}

# Continue to display login page on failure.
include ( 'login.php' ) ;

?>