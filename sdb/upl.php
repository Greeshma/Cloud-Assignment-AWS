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
    <!-- Le fav and touch icons -->
  </head>

  <body>

    <div class="container">
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
				<h1>Welcome!</h1>
				<p>Upload your file!</p>
	</div>
<form action="http://ec2-23-22-140-205.compute-1.amazonaws.com/sdb/upload.php" method="POST">
	<input type="hidden" id="isbn" name="isbn" value="<?php echo $_GET['isbn'];?>"/>
	<input type="hidden" id="hide" name="hide" value"">
	<input type="file" id="fname" name="fname" class="btn btn-primary" value="Upload" onchange="uploadFile(this.files)"/> </br>
	<input type="submit" class="btn btn-primary" value="Submit"/>
			</br>
</form>

			<hr>

      <footer>
        <p>&copy; Team Mango 2012</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
