<?php

	error_reporting(-1);
	header("Content-type: text/html; charset=utf-8");
	require_once '../sdk.class.php';

	$email = $_POST['reademail'];
	$password = $_POST['readpwd'];

	$sdb = new AmazonSDB();
	$domain = 'TeamMangoReaders';

	$query = "SELECT Password FROM $domain WHERE email = '$email' ";
	$result = $sdb->select($query);
	$items = $result->body->Item();
	
	foreach($items as $item)
		$pwd = $item->Attribute->Value;	

	if (strcmp($pwd,$password) == 0) {
		header("Location: ./dload.php");	
	}
	else {
		$html .= "Invalid Email id or Password ";
	}

?>

<!DOCTYPE html>
<html>
<body>
<?php 
	echo $html;
?>
</body>
</html>
