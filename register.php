<?php # DISPLAY COMPLETE REGISTRATION PAGE.

# Set page title and display header section.
$page_title = 'Register' ; 


include "connect_db.php"; 
        
function fill_country($dbc){

$output = '';

$sql = "SELECT * FROM countries;";
$result = mysqli_query($dbc, $sql);

  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

  {
    
    $output .= '<option class="text-center">'.$row["Countryname"].'</option>';
  }

  return $output;

}


function fill_phone($dbc){

$output = '';

$sql = "SELECT * FROM countries ;";
$result = mysqli_query($dbc, $sql);

  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

  {

    $output .= '<option>'.$row["phonecode"].'</option>';

  }

  return $output;

}

?>    

<style type="text/css">
 body {
  background: grey;
  font-family: 'Montserrat', sans-serif;
  font-size:10px;
  background-image: url(images/background.jpg);
  background-repeat: none;
  background-attachment: fixed;
  background-size: cover;
}

</style>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $page_title ?></title>
</head>
<link rel="stylesheet" href="includes/style.css">
<link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">
<link rel="stylesheet" type="text/css" href="datepicker/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="datepicker/jquery.datepicker2.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="datepicker/jquery.datepicker2.min.js"></script>
<script src="datepicker/jquery.datepicker2.js"></script>

<body>

<?php

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 
  
  # Initialize an error array.
  $errors = array();

  # Check for a first name.
  if ( empty( $_POST[ 'first_name' ] ) )
  { $errors[] = 'Enter your first name.' ; }
  else
  { $fn = mysqli_real_escape_string( $dbc, trim( $_POST[ 'first_name' ] ) ) ; }

  # Check for a last name.
  if (empty( $_POST[ 'last_name' ] ) )
  { $errors[] = 'Enter your last name.' ; }
  
  else
  { $ln = mysqli_real_escape_string( $dbc, trim( $_POST[ 'last_name' ] ) ) ; }

   
    if (empty( $_POST[ 'date' ] ) )
      { $errors[] = 'Enter your date of birth' ; }

   else{

    $dob = $_POST["date"];  // Get the input from form

    $dob = explode("/",$dob);  // explode it with the delimiter

    $date = mysqli_real_escape_string( $dbc, trim($dob) ) ; }



  # Check for an email address:
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email address.'; }
  else
  { $email = mysqli_real_escape_string( $dbc, trim( $_POST[ 'email' ] ) ) ; }

  # Check for a password and matching input passwords.
  if ( !empty($_POST[ 'pass1' ] ) )
  {
    if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
    { $errors[] = 'Passwords do not match.' ; }
    else
    { $pass = mysqli_real_escape_string( $dbc, trim( $_POST[ 'pass1' ] ) ) ; }
  }
  else { $errors[] = 'Enter your password.' ; }
  
  # Check if email address already registered.
  if ( empty( $errors ) )
  {
    $query = "SELECT user_id FROM users WHERE email='$email'" ;
    $r = @mysqli_query ( $dbc, $query ) ;
    if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ;
  }
  
  # On success register user inserting into 'users' database table.
  if ( empty( $errors ) ) 
      
  {

    $cellphone = "$phonecode$phone_num";

    //$q = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";

    $q = "INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `reg_date`, `address`, `country`, `cellphone`, `user_image`, `city`, `gender`, `address2`, `preferred_title`) VALUES (NULL, '$first_name', '$last_name', '$email', 'SHA1('$pass')', 'NOW()', '$address', '$countryname', '$cellphone', '', '$city', '$gender', '$address2', '$preferred_title');";

    $r = @mysqli_query ( $dbc, $q ) ;
    if ($r)
    { echo '<h1>Registered!</h1><p>You are now registered.</p><p><a href="login.php">Login</a></p>'; }
  
    # Close database connection.
    mysqli_close($dbc); 

    # Display footer section and quit script:
    include ('includes/login-footer.html'); 
    exit();
  }
  # Or report errors.
  else 
  {
    echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred:<br>' ;
    foreach ( $errors as $msg )
    { echo " - $msg<br>" ; }
    echo 'Please try again.</p>';
    # Close database connection.
    mysqli_close( $dbc );
  }  
}
?>

<div class="container-fluid pl-5 pr-5 text-white">
<div class="text-center">

  <a href="shop.php"><img src="images/logo.png" loading="lazy" width="150px" height="150px">
  <span aria-label="Click me to go back to Shop"></a></span>

</div> 

  <div class="col-md-6 offset-md-3">
  <form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="first_name" autocomplete="off"><small>First name</small></label>
      <input type="text" class="form-control form-control-sm" id="first_name" name="first_name" required>
    </div>
    <div class="form-group col-md-6">
      <label for="last_name"><small>Last name</small></label>
      <input type="text" class="form-control form-control-sm" id="last_name" name="last_name" required>
    </div>
  </div>
  <div class="form-row" autocomplete="off">
    <div class="form-group col-md-6">
      <label for="email"><small>Email</small></label>
      <input type="email" name="email" class="form-control form-control-sm" id="email" required>
    </div>
    <div class="form-group col-md-3" autocomplete="off">
      <label><small>Gender</small></label>
      <select class="form-control form-control-sm" id="gender" name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label><small>Preferred title</small></label>
      <select class="form-control form-control-sm" id="gender" name="gender">
        <option value="Mr">Mr</option>
        <option value="Mrs">Mrs</option>
        <option value="Ms">Ms</option>
        <option value="Dr">Dr</option>
        <option value="Miss">Miss</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
  <label for="date-input"><small>Date of Birth</small></label>
    <input class="form-control form-control-sm" type="text" name="date" id="date" data-select="datepicker" required>
  </div>
    <div class="form-group col-md-6">
      <label for="cellphone"><small>Phone</small></label>
      <input type="tel" class="form-control form-control-sm" id="cellphone" placeholder="XXX-XXX-XXXX" name="cellphone" required>
    </div>
  </div>
  <div class="form-group">
    <label for="address" autocomplete="off"><small>Address</small></label>
    <input type="text" class="form-control form-control-sm" id="address" placeholder="1234 Main St" name="address">
  </div>
  <div class="form-group">
    <label for="address2" autocomplete="off"><small>Address 2</small></label>
    <input type="text" class="form-control form-control-sm" id="address2" placeholder="Apartment, studio, or floor" name="address2">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="city" autocomplete="off"><small>City</small></label>
      <input type="text" class="form-control form-control-sm input-sm" id="city" name="city" required>
    </div>
    <div class="form-group col-md-6">
      <label><small>Country</small></label>
      <select class="form-control form-control-sm input-sm" id="country" name="Countryname" required>
        <option>Choose...</option>
        <?php echo fill_country($dbc); ?>
      </select>
    </div> <!-- form-group end.// -->
  </div>
    

  <div class="form-row">
    <div class="col-md-6 form-group">
    <label><small>Create password</small></label>
      <input class="form-control form-control-sm" type="password" name="pass1" required>
      <span class="help-block text-light small">Password must be 8-20 characters long</span>
  </div> <!-- form-group end.// -->  
  <div class="col-md-6 form-group">
    <label><small>Confirm password</small>Confirm password</label>
      <input class="form-control form-control-sm password-input" type="password" name="pass2" required>
  </div> 
  </div> 

    <div class="form-group">
        <button type="submit" class="btn btn-grad btn-block p-0 text-light" value="register">Register</button>
    </div> <!-- form-group// --> 
<div class="text-center pb-3">
    <small class="text-light">By clicking the 'Register' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
</div>                                          
</div> <!-- card-body end .// -->
<div class="border-top card-body text-center pt-2 pb-5"><small>Have an account?<a href="login.php">Log In</a></small></div>
<!-- card.// -->
</form>
</div>


<?php 

# Display footer section.
include ( 'includes/login-footer.html') ; 


?>

<script type="text/javascript">


//Date of birth plugin (by jqueryscript.net)

 dateFormat: function(date) {
    return $.datePicker.defaults.pad(date.getMonth() + 1, 2) + '-' + $.datePicker.defaults.pad(date.getDate(), 2) + '-' + date.getFullYear();
  },
  dateParse: function(string) {
    var date = new Date();
    if (string instanceof Date) {
      date = new Date(string);
    } else {
      var parts = string.match(/(\d{1,2})-(\d{1,2})-(\d{4})/);
      if ( parts && parts.length == 4 ) {
        date = new Date( parts[3], parts[1] - 1, parts[2] );
      }
    }
    return date;
  }

</script>