<?php

	error_reporting(-1);

	header("Content-type: text/html; charset=utf-8");

	require_once '../sdk.class.php';

	$sdb = new AmazonSDB();

	$domain = 'TeamMangoWriters';

	$new_domain = $sdb->create_domain($domain);

	if ($new_domain->isOK())
	{
		$add_attributes = $sdb->batch_put_attributes($domain, array(
			'matthieu@ruessner.ch' => array(
				'Name'    		=> 'Matthieu Ruessner', 
				'email' 			=> 'matthieu@ruessner.ch',
				'Password'  => 'mango',
			),
			'nitheeshkl@gmail.com' => array(
				'Name'    		=> 'Nitheesh K L', 
				'email' 			=> 'nitheeshkl@gmail.com',
				'Password'  => 'kln',
			),
		));
	}

?>
