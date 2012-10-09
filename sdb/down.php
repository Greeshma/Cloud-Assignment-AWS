<?php
require_once '../sdk.class.php';
$s3=new AmazonS3();
$filename=$_POST['filen'];
$objInfo = $s3->get_object_headers('BucketMango', $filename);
$obj = $s3->get_object('BucketMango', $filename);
//$url = $s3->get_object_url('BucketMango', $filename, '5 minutes');
header('Content-type: ' . $objInfo->header['_info']['content_type']);
echo $obj->body;
echo $url;
?>
