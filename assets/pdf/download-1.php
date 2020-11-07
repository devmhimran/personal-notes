<?php 
// include 'db/db.php';
// include 'db/function.php';
// include 'exportpdf.php';



// $file = $d_data['pdf'].".pdf";
echo $file =$_GET['file'].".pdf";
header("content-disposition: attatchment; filename= ". urlencode($file));
$fb = fopen($file, "r");
while (!feof($fb)) {
	echo fread($f, 8192);
	flush();
	fclose($fb);
}


	// header('location: index.php');