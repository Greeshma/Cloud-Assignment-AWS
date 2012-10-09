<?php

	error_reporting(-1);
	header("Content-type: text/html; charset=utf-8");
	require_once '../sdk.class.php';

	$name = $_POST['uname_w'];
	$email = $_POST['email_w'];
	$pwd = $_POST['pwd_w'];
	$repwd =$_POST['repwd_w'];

	 if(empty($name))
        {
                echo' please enter your correct username\n';
        }

        else if (empty ($pwd ))
        {
               echo'password is empty';
        }

else         if(empty($repwd))
        {
              echo'please enter the passwords';
        }
     else    if(strcmp($pwd, $repwd))
        {
              echo'passwords donot match';
        }
else {        
	$sdb = new AmazonSDB();
        $domain = 'TeamMangoWriters';
        
        $query = "SELECT email FROM $domain WHERE email = '$email' ";
	$result = $sdb->select($query);
	$items = $result->body->Item();

	foreach($items as $item) 
		$itemname = $item->Attribute->Value;


      if (!empty($itemname))
                echo 'email already exist';
	
	else {
	$addReader = $sdb->batch_put_attributes($domain, array( 
		"$email" => array (                
                        'Name' => "$name",
                        'email' => "$email",
                        'Password' => "$pwd"
              )
	));
	echo "Author added successfully";
}}
?>
