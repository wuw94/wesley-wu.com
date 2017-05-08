<?php
	// Display all errors that appear
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	$mysqli = new mysqli("localhost", "pon-user", "7vsv76olpca", "pon");

	$name = $mysqli->real_escape_string($_GET['name']);
	$password = $mysqli->real_escape_string($_GET['password']);
	$email = $mysqli->real_escape_string($_GET['email']);
	$hash = $_GET['hash'];
 
	$secretKey="485AD1953719843C46CE785ECBF74";

	$real_hash = md5($name . $password . $email . $secretKey);

	if ($real_hash == $hash)
	{
		$result = mysqli_query($mysqli, "INSERT INTO account VALUES ('$name', '$password', '$email');");
	}
	$mysqli->close();
?>
