<?php 
  

include 'db/db.php';
include 'db/function.php';

session_start();
if(!isset($_SESSION['id']) AND !isset($_SESSION['user_name']) AND !isset($_SESSION['user_username'])){
      header("location:log-in.php");
    }

if(isset($_GET['logout']) AND $_GET['logout'] == 'user-logout'){
  session_destroy();
  setcookie('user_re_log','',time() - (60*60*24*365));
  header("location:log-in.php");
}










$valid[] ='';





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['user_name']; ?></title>
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <!-- <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script> -->
      <script type="text/javascript" src="assets/tools/ckeditor/ckeditor.js"></script>
</head>
<body>
    <div class="container">
      <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="index.php">Home</a>
            <a href="post.php">Post</a>

          </div>
          <span class="side-menu" style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fas fa-bars"></i></span>
          <div class="right-side">
              <div class="profile">
                <div class="dropdown">
                  <a href="#" id="profile-dropdown"  type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/img/user_img/<?php echo $_SESSION['user_photo'];?>" alt=""></a>
                  <a class="logout" href="?logout=user-logout"><i class="fas fa-sign-out-alt"></i></a>
                  

  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <img class="drop-down-image" src="assets/img/user_img/<?php echo $_SESSION['user_photo'];?>" alt="">
    <p><b><?php echo $_SESSION['user_name'];?></b></p>
  </div>
</div>
                  
              </div>

          </div>
          <hr>
    </div>




<div class="container">
<div class="card w-100 mx-auto mt-5 mb-5">
  <div class="card-header">
    <h1>Post</h1>
  </div>
    <div class="card-body">
 <!--    <div class="card-title">
    <h2>Post</h2> -->
    <?php 

      if ( count($valid)>0) {
              foreach ($valid as $v) {
                echo $v;
              }
            }
          
            get_msg();


            $id = $_GET['id'];
            $sql = "SELECT * FROM posts WHERE content_id='$id'";

            $data =  $conn -> query($sql);
            $f_data = $data -> fetch_assoc();


    ?>
    <form action="<?php $_SERVER['PHP_SELF']?>" method = "POST" enctype='multipart/form-data'>
      <div class="form-group">
        <h3>Post Title</h3>
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="content_title" value="<?php echo $f_data['content_title']; ?>">
      </div>
      <textarea style="width: 100%;" class="ckeditor" name="editor" id=editor><?php echo $f_data['content_body']; ?></textarea>
       <button class="btn btn-warning mt-3" type="submit" name="update">Update</button>
       </form>
<!-- </div> -->
    </div>
       
       
   </div>
</div>




<script>CKEDITOR.replace( 'editor1' );</script>


<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}


// function toggle(){
//     var blur = document.getElementById('blur');
//     blur.classList.toggle('active');
//     var popup = document.getElementById('popup');
//     popup.classList.toggle('active');
// }


</script>
</body>
</html>


<?php
  //TechWorld3g - Please Support Us <3
  //Facebook : https://www.facebook.com/TechWorld3g 
  //Twitter : https://twitter.com/TechWorld3g 
  //Youtube : https://www.youtube.com/user/TechWorld3g 
  //Blog : https://tech-world3g.blogspot.com 
  //Donate : https://imraising.tv/u/techworld3g﻿

  include 'exportpdf.php';


session_start();

$file_name =  md5(rand());
$user_id = $_SESSION['id'];
if (isset($_POST['update'])) {
  $content_title  = $_POST['content_title'];
  $content_body   = $_POST['editor'];

  if (empty($content_title) || empty($content_body)) {
    $valid[] =  "<p class='alert alert-danger'>Please Fill this box<button class='close' data-dissmiss='alert'>&times;</button></p>";
  }else{
     $sql = " UPDATE posts SET  content_title ='$content_title' , content_body = '$content_body' , pdf = '$file_name' WHERE content_id = '$id'" ;
                 $conn -> query($sql);
                set_msg('Successfully Saved');


                header("location: index.php");
            }
  }













// echo $p = $_POST['editor'] ;
  //--------------------------//
  if((isset($_POST['editor'])) && (!empty(trim($_POST['editor'])))) //if content of CKEditor ISN'T empty
  {
    $posted_editor = trim($_POST['editor']); //get content of CKEditor
    $path = "assets/pdf/$file_name.pdf"; //specify the file save location and the file name
        
    exportPDF($posted_editor,$path); //exportPDF function returns TRUE

       
  }

  //Warning : if file already exists, it will be overwritten! 

    // header('location: post-edit.php');