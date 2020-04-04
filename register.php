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


<!DOCTYPE html>
<html>
<head>
  <title><?php echo $page_title ?></title>
</head>
<link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="includes/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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

  # Check for an email address:
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email address.'; }
  else
  { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'email' ] ) ) ; }

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
    $q = "SELECT user_id FROM users WHERE email='$e'" ;
    $r = @mysqli_query ( $dbc, $q ) ;
    if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ;
  }
  
  # On success register user inserting into 'users' database table.
  if ( empty( $errors ) ) 
      
  {

    $cellphone = "$phonecode$phone_num";

    //$q = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";

    $q = "INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `reg_date`, `Address`, `Country_name`, `cellphone`, `user_image`, `city`, `gender`) VALUES (NULL, '$first_name', '$last_name', '$email', SHA1('$pass'), 'NOW()', '$address', '$Countryname', '$cellphone', '$user_image', '$city', '$gender');";

    $r = @mysqli_query ( $dbc, $q ) ;
    if ($r)
    { echo '<h1>Registered!</h1><p>You are now registered.</p><p><a href="login.php">Login</a></p>'; }
  
    # Close database connection.
    mysqli_close($dbc); 

    # Display footer section and quit script:
    include ('includes/footer.html'); 
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
      <label for="first_name">First name</label>
      <input type="text" class="form-control form-control-sm" id="first_name" name="first_name" required>
    </div>
    <div class="form-group col-md-6">
      <label for="last_name">Last name</label>
      <input type="text" class="form-control form-control-sm" id="last_name" name="last_name" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control form-control-sm" id="email" required>
    </div>
    <div class="form-group col-md-3">
      <label>Gender</label>
      <select class="form-control form-control-sm" id="gender" name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label>Preferred title</label>
      <select class="form-control form-control-sm" id="gender" name="gender">
        <option value="Mr">Mr</option>
        <option value="Mrs">Mrs</option>
        <option value="Ms">Ms</option>
        <option value="Dr">Dr</option>
        <option value="Miss">Miss</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control form-control-sm" id="address" placeholder="1234 Main St" name="address">
  </div>
  <div class="form-group">
    <label for="address2">Address 2</label>
    <input type="text" class="form-control form-control-sm" id="address2" placeholder="Apartment, studio, or floor" name="address2">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control form-control-sm input-sm" id="city" name="city" required>
    </div>
    <div class="form-group col-md-6">
      <label>Country</label>
      <select class="form-control form-control-sm input-sm" id="country" name="Countryname" required>
        <option selected="">Choose...</option>
        <?php echo fill_country($dbc); ?>
      </select>
    </div> <!-- form-group end.// -->
  </div>
    

  <div class="form-row">
    <div class="col-md-6 form-group">
    <label>Create password</label>
      <input class="form-control form-control-sm" type="password" name="pass1" required>
      <span class="help-block text-muted">Password must be 8-20 characters long</span>
  </div> <!-- form-group end.// -->  
  <div class="col-md-6 form-group">
    <label>Confirm password</label>
      <input class="form-control form-control-sm password-input" type="password" name="pass2" required>
  </div> 
  </div> 

  
  <div class="form-group">
    <div class="custom-control form-control-sm custom-checkbox">  
    <input type="checkbox" class="custom-control-input" id="checkbox">  
    <label class="custom-control-label" for="checkbox"><small>Remember Me</small></label>  
    </div>  
  </div> 

    <div class="form-group">
        <button type="submit" class="btn btn-grad btn-block p-0" value="register"> Register  </button>
    </div> <!-- form-group// --> 
<div class="text-center pb-3">
    <small class="text-muted">By clicking the 'Register' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
</div>                                          
</div> <!-- card-body end .// -->
<div class="border-top card-body text-center pt-2 pb-5">Have an account? <a href="login.php">Log In</a></div>
<!-- card.// -->
</form>
</div>


<?php 

# Display footer section.
include ( 'includes/login-footer.html') ; 


?>

<script>
  $(document).ready(function(){
    $('#country').change(function(){

      var cid = $(this).val();

      $.ajax({ 

        url:"load_country.php",
        method:"POST",
        data:
        {cid:cid},
        success:function(data){
          $("#phone_num").html(data);
        }
  
      });
    });
  });

</script>