<?php 

include 'db/db.php';
include 'db/function.php';
session_start();
	$id= $_GET['id'];
	$sql= "SELECT * FROM posts where content_id='$id' ";
	$data= $conn -> query($sql);

	$f_d = $data -> fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/home.css">

</head>
<body>
	<div class="container">
		<div class="card mt-5">
			<div class="card-header">
				<h2><?php echo $f_d['content_title'];  ?></h2>
			</div>
			<div class="card-body">
				<p><?php echo $f_d['content_body'];  ?></p>
			</div>
		</div>

	</div>






	<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>