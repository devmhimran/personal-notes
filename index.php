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

    <div class="container" id="blur">
      <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="index.php">Home</a>
            <a href="post.php">Post</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
          </div>
          <span class="side-menu" style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fas fa-bars"></i></span>
          <div class="right-side">
              <div class="profile">
                  <img src="assets/img/user_img/<?php echo $_SESSION['user_photo'];?>" alt="">
                  <a class="dropdown" href="?logout=user-logout"><i class="fas fa-sign-out-alt"></i></a>
              </div>

          </div>

    <hr>
          
        <div class="row">
            <?php  
            

            $user_id = $_SESSION['id'];
            $sql_post = "SELECT * FROM posts WHERE user_id ='$user_id'";
            $data = $conn -> query($sql_post);
            // $post_data = $data -> fetch_assoc()
                // $f_data = $data -> fetch_assoc();
                
            while ($post_data = $data -> fetch_assoc()):
            ?>
            <div class="col-md-4"> 
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="main-text">
                            <p>
                               <b><?php echo $post_data['content_title']; ?></b>
                            </p>
                            <a href="#<?php echo $post_data['content_id']; ?>" class=" btn btn-info btn-sm "  class="">View</a>
                        </div>
                    </div>                   
                </div>
              
           

            </div>
            <div class="modal1" id="<?php echo $post_data['content_id']; ?>">
              <div class="background">
                <div class="modal__content">
                <a href="#" class="modal__close">&times;</a>
                <h2 class="modal__heading"><?php echo $post_data['content_title']; ?></h2>
                <p class="modal__paragraph"><?php echo $post_data['content_body']; ?></p>
              </div>
              </div>
            </div>
            <?php endwhile; ?>


            <?php  ?>
            <!-- Modal start -->

            
  
        <!-- Modal end -->
      
        
       
        </div>




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



