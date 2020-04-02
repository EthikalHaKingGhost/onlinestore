<?php # DISPLAY COMPLETE REGISTRATION PAGE.

# Set page title and display header section.
$page_title = 'Register' ; ?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $page_title ?></title>
</head>
<link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="includes/style.css">
<body>

<style>

  body {
    background-image: url(images/cover.jpg) !important;
    background-size: cover;
    background-repeat: none;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;

  }
</style>

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
    { $p = mysqli_real_escape_string( $dbc, trim( $_POST[ 'pass1' ] ) ) ; }
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
    $q = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";
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


<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">
  <div class="card">
  <header class="card-header bg-info text-white text-center p-0">
    
      <span aria-label="Click me to go back to home page">
        
          <a href="home.php"><small class="mb-0"><img src="images/rhino.png"></small></a>

      </span>
  </header>                  
<div class="card-body">
<form>
  <div class="form-row">
    <div class="col form-group">
      <label class="m-0">First name </label>   
        <input type="text" class="form-control form-control-sm" name="first_name">
    </div> <!-- form-group end.// -->
    <div class="col form-group">
      <label class="m-0">Last name </label>
        <input type="text" class="form-control form-control-sm" name="last_name">
    </div> <!-- form-group end.// -->
  </div> <!-- form-row end.// -->

<div class="form-row">
    <div class="form-group col-md-6">
      <label class="m-0">City</label>
      <input type="text" class="form-control form-control-sm" name="city">
    </div> <!-- form-group end.// -->
    <div class="form-group col-md-6">

<!----------countries included to database ------------------>
      <label class="m-0 text-dark">Country</label>
      <select id="countryname" class="form-control form-control-sm" name="countryname">
        <option selected="">Choose...</option>
        <?php include "connect_db.php"; 
        $sql = "SELECT * FROM countries LIMIT 20";
        $result = mysqli_query($dbc, $sql);
        if($result){
        //loop each row
          while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $id = $row["cid"];
            $countrycode = $row["Countrycode"];
            $countryname = $row["Countryname"];
            ?>
            <option value="<?php echo $cid ?>"><?php echo $countryname; ?></option>
            <?php
          }
        }else{
          echo "error in sql";
        }
        ?>
      </select>
    </div> <!-- form-group end.// -->
  </div> <!-- form-row.// -->

<!----------countries end// ------------------>
  <div class="form-group">
      <label class="form-check form-check-inline m-0">
      <input class="form-check-input" type="radio" name="gender" value="option1" checked>
      <span class="form-check-label"> Male </span>
    </label>
    <label class="form-check form-check-inline m-0">
      <input class="form-check-input" type="radio" name="gender" value="option2">
      <span class="form-check-label"> Female</span>
    </label>
  </div> <!-- form-group end.// -->
  <div class="form-group">
    <label class="m-0">Email address</label>
    <input type="email" class="form-control form-control-sm">
    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div> <!-- form-group end.// -->
  <div class="form-group">
    <label class="m-0">Create password</label>
      <input class="form-control form-control-sm" type="password" name="pass1">
  </div> <!-- form-group end.// -->  
  <div class="form-group">
    <label class="m-0">Confirm password</label>
      <input class="form-control form-control-sm" type="password" name="pass2">
  </div> <!-- form-group end.// -->  
    <div class="form-group">
        <button type="submit" class="btn btn-info btn-block p-0" value="register"> Register  </button>
    </div> <!-- form-group// --> 
<div class="text-center">
    <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
</div>                                          
</form>
</div> <!-- card-body end .// -->
</div>
<div class="border-top card-body text-center pt-2 pb-5">Have an account? <a href="login.php">Log In</a></div>
</div> <!-- card.// -->
</div> <!-- col.//-->

</div> <!-- row.//-->


</div> 
<!--container end.//-->
        </form>
      </div>
    </div>
  </div>


<?php 

# Display footer section.
include ( 'includes/login-footer.html') ; 

?>
