<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="includes/style.css">
  <link rel="stylesheet" href="fonts/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="datepicker/jquery.datepicker2.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="datepicker/jquery.datepicker2.min.js"></script>
<script src="datepicker/jquery.datepicker2.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  
  
</head>
<body>


<?php  

if (isset($_POST["test"])){

      
else{ 

$dob = $_POST["date"];  // Get the input from form

 $date= explode("-",$dob); 
     // explode it with the delimiter

$date = "$date[2]-$date[1]-$date[0]";

}

?>

<div class="jumbotron">
	
</div>
<form action="test.php" method="post">
<input class="form-control" type="text" name="date" id="date" data-select="datepicker">
<input type="submit" name="test" value="test">
</form>

<?php echo $date; ?>

<script type="text/javascript">

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



