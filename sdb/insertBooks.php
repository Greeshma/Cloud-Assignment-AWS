<?php

	error_reporting(-1);

	header("Content-type: text/html; charset=utf-8");

	require_once '../sdk.class.php';

	$sdb = new AmazonSDB();

	$domain = 'TeamMangoBooks';

	$new_domain = $sdb->create_domain($domain);

	if ($new_domain->isOK())
	{
		$add_attributes = $sdb->batch_put_attributes($domain, array(
			'1933988665' => array(
				'Title'    		=> 'HTML5 Up and Running', 
				'Author' 			=> 'Mark Pilgrim',
				'Publisher'  => 'Google Press',
			),
			'19867573586' => array(
				'Title'    		=> 'Data Communication and Networking',
				'Author' 			=> 'Behrouz A Forouzan',
				'Publisher'  => 'McGraw-Hill',
			),
			'18678687684' => array(
				'Title'    		=> 'Database Management Systems',
				'Author' 			=> 'Ramakrishnan Gehrke',
				'Publisher'  => 'McGraw-Hill',
			),
		));
}
?>
