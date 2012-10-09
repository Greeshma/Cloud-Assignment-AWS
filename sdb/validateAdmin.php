<?php

	error_reporting(-1);
	header("Content-type: text/html; charset=utf-8");
	require_once '../sdk.class.php';

	$email = $_POST['reademail'];
	$password = $_POST['readpwd'];

	if (strcmp("root",$password) == 0 && strcmp("Admin", $email == 0)) {
		header("Location: form.html");	
	}
	else {
		$html .= "Invalid User Name or Password ";
	}

?>

<!DOCTYPE html>
<html>
<body>
<?php 
?>
</body>
</html>
