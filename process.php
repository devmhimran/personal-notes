<?php
	//TechWorld3g - Please Support Us <3
	//Facebook : https://www.facebook.com/TechWorld3g 
	//Twitter : https://twitter.com/TechWorld3g 
	//Youtube : https://www.youtube.com/user/TechWorld3g 
	//Blog : https://tech-world3g.blogspot.com 
	//Donate : https://imraising.tv/u/techworld3g﻿

	include 'exportpdf.php';
include 'db/db.php';
include 'db/function.php';

session_start();








$user_id = $_SESSION['id'];
	$file_name =  md5(rand());
if (isset($_POST['save'])) {
  $content_title  = $_POST['content_title'];
  $content_body   = $_POST['editor'];

  if (empty($content_title) || empty($content_body)) {
    $valid[] =  "<p class='alert alert-danger'>Please Fill this box<button class='close' data-dissmiss='alert'>&times;</button></p>";
  }else{
     $sql = " INSERT INTO posts (user_id, content_title, content_body, pdf) values ( '$user_id' ,'$content_title','$content_body','$file_name')";
                 $conn -> query($sql);
                set_msg('Successfully Saved');


                header("location: post.php");
            }
  }














// echo $p = $_POST['editor'] ;
	//--------------------------//
	if((isset($_POST['editor'])) && (!empty(trim($_POST['editor'])))) //if content of CKEditor ISN'T empty
	{
		$posted_editor = trim($_POST['editor']); //get content of CKEditor
		$path = "assets/pdf/$file_name.pdf"; //specify the file save location and the file name
				
		if(exportPDF($posted_editor,$path)) //exportPDF function returns TRUE
		{					
			echo "File has been successfully exported!";
		}
		else //exportPDF function returns FALSE
		{
			echo "Failed to export the pdf file!";
		}				
	}
	else //if content of CKEditor IS empty
	{
		echo "Error : Empty content!";
	}

	//Warning : if file already exists, it will be overwritten! 

		// header('location: post.php');