<?php

	error_reporting(-1);
	header("Content-type: text/html; charset=utf-8");
	require_once '../sdk.class.php';

	$isbn = $_POST['isbn'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$publisher = $_POST['publisher'];
	$fname = $_POST['fname'];
	$sdb = new AmazonSDB();
	$domain = 'TeamMangoBooks';

	$addBook = $sdb->batch_put_attributes($domain, array(
		"$isbn"=> array(
			'Title' => "$title", 
			'Author' => "$author", 
			'Publisher' => "$publisher"
		)
	));

//	gloval $var=$isbn;

	if ($addBook->isOK()) {
		header("Location: ./upl.php?isbn=$isbn");
	}
	else {
		header("Location: ./error.html");
	}

?>

<html>
<body>
<?php
?>
</body>
</html>
