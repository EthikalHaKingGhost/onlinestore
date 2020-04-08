<?php # DISPLAY COMPLETE REGISTRATION PAGE.
# Set page title and display header section.
$page_title = 'Register';

include "connect_db.php";

function fill_country($dbc)
{

    $output = '';

    $query = "SELECT * FROM countries;";
    $result = mysqli_query($dbc, $query);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

    {

        $output .= '<option class="text-center">' . $row["Countryname"] . '</option>';
    }

    return $output;

}

function title($dbc)
{

    $output = '';

    $query = "SELECT * FROM preferred_title ;";
    $result = mysqli_query($dbc, $query);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

    {

        $output .= '<option>' . $row["title"] . '</option>';

    }

    return $output;

}

function fill_gender($dbc)
{

    $output = '';

    $query = "SELECT * FROM gender;";
    $result = mysqli_query($dbc, $query);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

    {

        $output .= '<option>' . $row["gender_type"] . '</option>';
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
<link rel="stylesheet" href="datepicker/jquery.datepicker2.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


<body>

<?php
# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    # Connect to the database.
    require ('connect_db.php');

    # Initialize an error array to check each field.
    $errors = array();

    
    if (empty($_POST['first_name']))

    {
        $errors[] = 'Enter your first name.';
    }

    else

    {
        $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
    }

    # Check for a last name.
    if (empty($_POST['last_name']))

    {
        $errors[] = 'Enter your last name.';
    }

    else
    {
        $last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
    }

    if (!empty($_POST['gender']))

    {
        $gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
    }

    if (!empty($_POST['title']))

    {
        $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
    }

    if (empty($_POST['address']))

    {
        $errors[] = 'Enter your Address.';
    }

    else

    {
        $address = mysqli_real_escape_string($dbc, trim($_POST['address']));
    }

    if (empty($_POST['address2']))

    {
        $errors[] = 'Enter your alternate Address.';
    }

    else

    {
        $address2 = mysqli_real_escape_string($dbc, trim($_POST['address2']));
    }

    if (empty($_POST['city']))

    {
        $errors[] = 'Enter your city.';
    }

    else

    {
        $city = mysqli_real_escape_string($dbc, trim($_POST['city']));
    }

    if (empty($_POST['cellphone']))

    {
        $errors[] = 'Enter your phone number.';
    }

    else
    {
        $cellphone = mysqli_real_escape_string($dbc, trim($_POST['cellphone']));
    }

    if (empty($_POST['country']))
    {
        $errors[] = 'Enter your country.';
    }

    else
    {
        $country = mysqli_real_escape_string($dbc, trim($_POST['country']));
    }

    if (empty($_POST['date']))

    {
        $errors[] = 'Enter your date of birth';
    }

    else
    {
        $dob = $_POST["date"]; // Get the input from form
        $date = explode("-", $dob);
        // explode it with the delimiter
        $date = "$date[2]-$date[0]-$date[1]";

        $date = mysqli_real_escape_string($dbc, trim($date));
    }

    # Check for an email address:
    if (empty($_POST['email']))

    {
        $errors[] = 'Enter your email address.';
    }

    else

    {
        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    }

    # Check for a password and matching input passwords.
    if (!empty($_POST['pass']))

    {

        if ($_POST['pass'] != $_POST['pass2'])

        {
            $errors[] = 'Passwords do not match.';

        }
        else

        {
            $pass = mysqli_real_escape_string($dbc, trim($_POST['pass']));
        }

    }

    else
    {
        $errors[] = 'Enter your password.';
    }

    # Check if email address already registered.
    if (empty($errors))

    {

        $query = "SELECT user_id FROM users WHERE email = '$email'";

        $result = @mysqli_query($dbc, $query);

        if (mysqli_num_rows($result) != 0)

        echo 'Email address already registered. <a href="login.php">Login</a>';


      exit();

    }

    # On success register user inserting into 'users' database table.
    if (empty($errors))

    {

        $query = "INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `gender`, `preferred_title`, `cellphone`, `email`, `address`, `address2`, `countryname`, `city`, `pass`, `reg_date`, `date`) VALUES (NULL, '$first_name', '$last_name', '$gender', '$title', '$cellphone', '$email', '$address', '$address2', '$country', '$city', SHA1('$pass'), NOW(), '$date');";

        if (@mysqli_query($dbc, $query))

        {

          //include 'includes/register-success.html'; 



            echo "<script>
                      $('#myModal').modal('show')
                  </script>";

        }

        else

        {
            echo "Error: " . $query . "<br>" . mysqli_error($dbc);
        }

        # Close database connection.
        mysqli_close($dbc);

        # Display footer section and quit script:
        include ('includes/login-footer.html');

        exit();

    }

    # Or report errors.
    else

    {

        echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred:<br>';

        foreach ($errors as $msg)

        {
            echo " - $msg<br>";
        }

        echo 'Please try again.</p>';
        # Close database connection.
        
    }

}

?>


<div class="container-fluid pl-5 pr-5 text-white">
<div class="text-center">

  <a href="shop.php"><img src="images/logo2.png" height="175" loading="lazy" >
  <span aria-label="Click me to go back to Shop"></a></span>

</div> 

  <div class="col-md-6 offset-md-3 border-top mt-2">

  <form action="register.php" method="post">
  <div class="form-row mt-4">
    <div class="form-group col-md-6">
      <label for="first_name" autocomplete="off"><small>First name</small></label>
      <input type="text" class="form-control form-control-sm" id="first_name" name="first_name">
    </div>
    <div class="form-group col-md-6">
      <label for="last_name"><small>Last name</small></label>
      <input type="text" class="form-control form-control-sm" id="last_name" name="last_name">
    </div>
  </div>
  <div class="form-row" autocomplete="off">
    <div class="form-group col-md-6">
      <label for="email"><small>Email</small></label>
      <input type="email" name="email" class="form-control form-control-sm" id="email">
    </div>
    <div class="form-group col-md-3" autocomplete="off">
      <label><small>Gender</small></label>
      <select class="form-control form-control-sm" id="gender" name="gender">
        <?php echo fill_gender($dbc) ?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label><small>Preferred title</small></label>
      <select class="form-control form-control-sm" id="title" name="title">
        <?php echo title($dbc); ?>
      </select>
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
  <label for="date-input"><small>Date of Birth</small></label>
    <input class="form-control form-control-sm" type="text" name="date" id="date" data-select="datepicker">
  </div>
    <div class="form-group col-md-6">
      <label for="cellphone"><small>Phone</small></label>
      <input type="tel" class="form-control form-control-sm" id="cellphone" placeholder="eg. 999-999-9999" name="cellphone">
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
      <input type="text" class="form-control form-control-sm input-sm" id="city" name="city">
    </div>
    <div class="form-group col-md-6">
      <label><small>Country</small></label>
      <select class="form-control form-control-sm input-sm" id="country" name="country" required>
        <option>Choose...</option>
        <?php echo fill_country($dbc); ?> 
      </select>
    </div> <!-- form-group end.// -->
  </div>
    

  <div class="form-row">
    <div class="col-md-6 form-group">
    <label><small>Create password</small></label>
      <input class="form-control form-control-sm" type="password" name="pass">
      <span class="help-block text-light small">Password must be 8-20 characters long</span>
  </div> <!-- form-group end.// -->  
  <div class="col-md-6 form-group">
    <label><small>Confirm password</small></label>
      <input class="form-control form-control-sm password-input" type="password" name="pass2">
  </div> 
  </div> 

    <div class="form-group">
        <button type="submit" class="btn btn-grad btn-block p-0" value="register"><strong>Register</strong></button>
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
include ('includes/login-footer.html');

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

<link rel="stylesheet" type="text/css" href="fonts/css/all.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="datepicker/jquery.datepicker2.min.js"></script>
<script src="datepicker/jquery.datepicker2.js"></script>
