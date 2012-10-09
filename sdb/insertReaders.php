<?php

	error_reporting(-1);

	header("Content-type: text/html; charset=utf-8");

	require_once '../sdk.class.php';

	$sdb = new AmazonSDB();

	$domain = 'TeamMangoReaders';

	$new_domain = $sdb->create_domain($domain);

	if ($new_domain->isOK())
	{
		$add_attributes = $sdb->batch_put_attributes($domain, array(
			'ahalya.srn@gmail.com' => array(
				'Name'    		=> 'Ahalya', 
				'email' 			=> 'ahalya.srn@gmail.com',
				'Password'  => 'asrn',
			),
			'kumari.radha3@gmail.com' => array(
				'Name'    		=> 'Kumari Radha', 
				'email' 			=> 'kumari.radha3@gmail.com',
				'Password'  => 'radha',
			),
		));
	}

?>
