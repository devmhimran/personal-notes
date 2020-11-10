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
    <link rel="stylesheet" href="assets/css/post.css">
    <!-- <script src="assets/js/ckeditor.js"></script> -->
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
                  <img src="assets/img/user_img/<?php echo $_SESSION['user_photo'];?>" alt="">
                  <a class="dropdown" href="?logout=user-logout"><i class="fas fa-sign-out-alt"></i></a>
              </div>

          </div>
    </div>




<div class="container">
<div class="card  mx-auto mt-5">
 <!--  <div class="card-header">
    <h1>Post</h1>
  </div> -->
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


    ?>
    <form action="process.php" method = "POST" enctype='multipart/form-data'>
      <div class="form-group">
        <h3>Create Doccument</h3>
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="content_title">
      </div>
      <textarea style="width: 100%;" class="ckeditor" name="editor" id=editor></textarea> <!-- CKEditor  !-->
       <!-- when you c w-100lick this button, you will go to process.php !-->
      <button class="btn btn-primary mt-3" type="submit" name="save">Save</button>
      <!-- <button class="btn btn-info  mt-3" type="submit-1" value="Export to pdf" id="export">Export to pdf</button> -->
       </form>
<!-- </div> -->
    </div>
       
       
   </div>
</div>




                <script>
                        CKEDITOR.replace( 'editor1' );
                </script>


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