<?php #DISPLAY COMPLETE LOGGED OUT PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Goodbye' ;

include ( 'includes/header.php' ) ;

require "connect_db.php";

$fullname = $_SESSION["first_name"]." ".$_SESSION["last_name"];

   $activity = "INSERT INTO `user_activity` (`activity_id`, `user_id`, `fullname`, `user_image`, `activity_details`, `activity_log`, `acitivity_date`) VALUES (NULL, '{$_SESSION["user_id"]}', '$fullname', '{$_SESSION["user_image"]}', '{$_SESSION["user_id"]}', 'Logged out', current_timestamp());";

   $activity_qry = mysqli_query($dbc, $activity);

//close database
mysqli_close($dbc);

# Clear existing variables.
$_SESSION = array() ;
  
# Destroy the session.
session_destroy() ;

# Display body section.
echo '

<section class="slice sct-color-1 pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <div class="text-center">
                                        <div class="d-block p-2"> 
                                            <img src="images/goodbye.png" >
                                        </div>
                                        <h2 class="heading heading-3 strong-400 font-italic">To See You Leave!</h2>
                                        <p class="mt-3 px-3">
                                           Thank you for shopping with us, Please click below to login again.  
                                           <i class="fas fa-smile-beam text-danger"></i>
                                        </p>
                                        <a href="login.php" class="btn btn-danger text-decoration-none text-white"><i class="fas fa-user"></i> Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>';

# Display footer section.
include ( 'includes/footer.php' ) ;

?>