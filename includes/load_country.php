<?php

include "connect_db.php";

$output '';

if(isset($POST["cid"])){

	if($_POST["cid"] != ''){

		$sql = "SELECT * FROM countries WHERE cid = '".$_POST["cid"]."'";	
	}
	
	else{

		$sql = "SELECT * FROM countries";
	}

	$result = mysqli_query($dbc, $sql);

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

  {

    $output .= '<option>'.$row["phonecode"].'</option>';
  }

	echo $output;
}

?>