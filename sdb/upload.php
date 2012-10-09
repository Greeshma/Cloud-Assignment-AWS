<?php
/**
*
* Copyright (c) 2011, Charles S. Han.  All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions are met:
*
* - Redistributions of source code must retain the above copyright notice,
*   this list of conditions and the following disclaimer.
* - Redistributions in binary form must reproduce the above copyright
*   notice, this list of conditions and the following disclaimer in the
*   documentation and/or other materials provided with the distribution.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
* AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
* IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
* ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
* LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
* CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
* SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
* INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
* CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
* ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
**/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Books@TeamMango</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
                </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


</head>
<body>

<?php
function isImage($filename)
{
	$array = explode(".", $filename);
	if (count($array) != 2)
		return false;
	else {
		$ext = strtolower($array[1]);
		return (strcmp($ext, "png")==0 || strcmp($ext, "jpg")==0 || strcmp($ext, "jpeg")==0 || strcmp($ext, "gif")==0 || strcmp($ext, "bmp")==0 || strcmp($ext, "tif")==0 || strcmp($ext, "tiff")==0);
		//return true;
	}
}

	// Include the SDK
	require_once '../sdk.class.php';

	// Instantiate the class
	$s3 = new AmazonS3();
	$bucket = "BucketMango";

	$sdb = new AmazonSDB();
	$domain = 'TeamMangoBooks'; 


        // check whether a form was submitted
        if (isset($_POST['submit'])) {
                // retrieve post variables
		$file = $_FILES['file'];
		$filename = $file['name'];
		$tmpname = $file['tmp_name'];
		$contentType = $file['type'];
  
  
                // upload the filsbn = $_POST['isbn'];
	        $title = $_POST['title'];
        	$author = $_POST['author'];
	        $publisher = $_POST['publisher'];
        	$isbn = $_POST['isbn'];

	        $addBook = $sdb->batch_put_attributes($domain, array(
        	        "$isbn"=> array(
                	        'Title' => "$title",
                        	'Author' => "$author",
	                        'Publisher' => "$publisher"
        	        )
	        ));
                // upload the file
		$fileResource = fopen($tmpname, 'r');
try {
		$response = $s3->create_object($bucket, $filename, array('fileUpload' => $fileResource, 'contentType' => $contentType));
		if ($response->isOK())
                	echo "<strong>Upload of $filename succeeded.</strong>\n";
		else
                	echo "<strong>Upload of $filename failed.</strong>\n";
} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
}
        }
?>
<div class="container">
<div class="hero-unit">
<h1>Upload a file</h1>
<p>Please select a file by clicking the 'Browse' button and press 'Upload' to start uploading your file.</p></br>
</div>
<div>
<form action="" method="post" enctype="multipart/form-data" name="form" id="form">
        <input name="file" id="file" class="span2" type="file" /> </br>
	<input type="text" name="isbn" id="isbn" class="span2" placeholder="ISBN"/><br>
	<input type="text" name="title" id="title" class="span2" placeholder="Title"/><br>
	<input type="text" name="author" id="author" class="span2" placeholder="Author"/><br>
	<input type="text" name="publisher" id="publisher" class="span2" placeholder="Publisher"/><br>
        <input name="submit" class="btn btn-primary" type="submit" value="Upload"></br></br>
</form>
</div>
<!--div class=row>
<h1>Uploaded files</h1>
<?php
/*	$response = $s3->list_objects($bucket);
 
	$contents = $response->body->Contents;
	foreach ($contents as $content) {
		$filename = $content->Key;
		echo "<div><p>$filename</p>\n";
		if (isImage($filename)) {
			echo "<img width='150' height='100' src='file.php?bucket=$bucket&filename=$filename'/>Click here</div>\n";
		} else {
			echo "<h3>$filename<h3></div>\n";
		}
	}*/
?>
</div-->
</div>
</body>
</html>
