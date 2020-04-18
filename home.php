<?php 

# Access session.
session_start() ; 

# Set page title and display header section.
$page_title = 'Home'; ?>


<?php 
include ( 'includes/topbar.php' );


include ( 'includes/header.php' );

include ('includes/slider1.php'); ?>


<!--------------------->

<div class="jumbotron jumbotron-fluid bg-dark text-light">
  <div class="container">
    <h3 class="display-5">Call US NOW</h3>
    <p class="lead">Our contact team is always available for your needs, contact us anytime at +1-868-567-6878 or send us a message!</p>
    <a href="contactus.php"><button class="btn btn-info btn-lg">Message</button></a>
  </div>
</div>



<?php 


include ( 'includes/latest_arrivals.php' ) ;

include ( 'includes/footer.php' ) ;
?>