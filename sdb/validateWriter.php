<?php

	error_reporting(-1);
	header("Content-type: text/html; charset=utf-8");
	require_once '../sdk.class.php';

	$email = $_POST["authemail"];
	$password = $_POST["authpwd"];

	$sdb = new AmazonSDB();
	$domain = 'TeamMangoWriters';

	$query = "SELECT Password FROM $domain WHERE email = '$email' ";
	$result = $sdb->select($query);
	$items = $result->body->Item();
	
	foreach($items as $item)
		$pwd = $item->Attribute->Value;	

	if (strcmp($pwd,$password) == 0) {
		header("Location: upload.php");	
	}
	else {
		header("Location: login_invalid.html");	
	}

?>

