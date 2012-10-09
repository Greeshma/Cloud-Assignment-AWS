<?php

	error_reporting(-1);
	header("Content-type: text/html; charset=utf-8");
	require_once '../sdk.class.php';
	
	$name = $_POST['uname_r'];
	$email = $_POST['email_r'];
	$pwd = $_POST['pwd_r'];
	$repwd = $_POST['repwd_r'];

	if(empty($name))
	{
		echo' please enter your correct username';
	}
	
else	if (empty ($pwd ))
	{
		echo'password is empty';
		return false;
	}
	
else	if(empty($repwd))
	{
		echo 'please enter the passwords';
	}
else	if($pwd !== $repwd)
	{
		echo'passwords donot match';
		return false;
	}
else {


	$sdb = new AmazonSDB();
	$domain = 'TeamMangoReaders';
	
	        $query = "SELECT email FROM $domain WHERE email = '$email' ";
	$result = $sdb->select($query);
	$items = $result->body->Item();

	foreach($items as $item) 
		$itemname = $item->Attribute->Value;


      if (!empty($itemname))
                echo 'email already exist';
	else
	{
	$addReader = $sdb->batch_put_attributes($domain, array(
		"$email" => array(
			'Name' => "$name", 
			'Password' => "$pwd",
			'email' => "$email"
		)
	));
	echo "Reader added successfully";
	}
}
?>

