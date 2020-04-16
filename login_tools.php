<?php # LOGIN HELPER FUNCTIONS.

# Function to load specified or default URL.
function load( $page = 'login.php' )
{
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER['REQUEST_URI']) ;
  
  $Url = $_SERVER['REQUEST_URI'];
  
  $parts = parse_url($url);
  
  
  $newUrl = $parts['scheme'] . '://' . $parts['host'] . $parts['path'] . '/' . $page;;
  
  # Execute redirect then quit. 
  header( "Location: $newUrl" ) ; 

  exit() ;
}


# Function to check email address and password. 
function validate( $dbc, $email = '', $pass = '')
{
  # Initialize errors array.
  $errors = array() ; 

  # Check email field.
  if ( empty( $email ) )

  { $errors[] = 'Enter your email address.' ; } 

  else  { $email = mysqli_real_escape_string( $dbc, trim( $email ) ) ; }

  # Check password field.
  if ( empty( $pass ) ) 

  { $errors[] = 'Enter your password.' ; }

  else { $pass = mysqli_real_escape_string( $dbc, trim( $pass ) ) ; }

  # On success retrieve user_id, first_name, and last name and login_time from 'users' database.
  if ( empty( $errors ) ) 

  {
    $loginquery = "SELECT user_id, first_name, last_name, login_time FROM users WHERE email ='$email' AND pass = SHA1('$pass')" ; 

    $loginresult = mysqli_query($dbc, $loginquery) ;

    if(mysqli_num_rows($loginresult) == 1){  

    $row = mysqli_fetch_array ( $loginresult, MYSQLI_ASSOC );

    return array( true, $row ) ; 

    }

    # Or on failure set error message.
    else { $errors[] = 'Email address and password not found.' ; }
  }
  # On failure retrieve error message/s.
  return array( false, $errors ) ; 
}
