<?php
	// Display all errors that appear
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	$mysqli = new mysqli("localhost", "pon-user", "7vsv76olpca", "pon");

	if (mysqli_connect_errno())
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}


	// Strings must be escaped to prevent SQL injection attack. 
	$name = $mysqli->real_escape_string($_GET['name']);
	//$hash = $_GET['hash'];
 
	$secretKey="mySecretKey"; # Change this value to match the value stored in the client javascript below

	$real_hash = md5($name . $secretKey);


	//if($real_hash == $hash)
	if (true)
	{
		$result = mysqli_query($mysqli, "SELECT COUNT(name) FROM user WHERE name='$name';");
		echo mysqli_fetch_row($result)[0];
        }
	else
	{
	}
?>
