<!-- DELETE PART -->
<?php
	
	include('db/db.php');
	
	$id = $_GET['id'];

	 $sql ="DELETE FROM posts WHERE content_id='$id'" ;
	 $conn -> query($sql);
	header('location: index.php');


?>