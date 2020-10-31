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
                            <a  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">View</a>


                            <!-- Button trigger modal -->
                        </div>                   
                    </div>
                </div>




<?php 

      

    if (isset($_POST['submit'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];

  if(empty($username)){
    $username_valid = "<p class='invailed-msg'>Username/Email Required</p>";
   }
   if(empty($password)){
    $pass_valid = "<p class='invailed-msg'>Password Required</p>";
   }

   if(empty($username)||empty($password)){
    $valid =  "<p class='invailed-msg'>All fields are required<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";

   }else{

    $sql_username = "SELECT * FROM user_data WHERE user_username ='$username'|| user_email ='$username'";
    $l_data = $conn -> query($sql_username);
    $f_data = $l_data -> fetch_assoc();
    if( $l_data-> num_rows == 1) {
        
        if(password_verify($user_password, $f_data['password'] ) == false){   
          $modal_id =  $post_data['content_title'];

      }else{
            $valid =  "<p class='invailed-msg'>Wrong Password<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";
        }

    }else{
        $valid =  "<p class='invailed-msg'>wrong username<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";
    }
   

    }
}




?>          

<div class="modal1" id="<?php echo $post_data['content_id']; ?>">
  <div class="background">
    <div class="modal__content">
    <a href="#" class="modal__close">&times;</a>
    <h2 class="modal__heading"><?php echo $post_data['content_title']; ?></h2>
    <p class="modal__paragraph"><?php echo $post_data['content_body']; ?></p>
  </div>
  </div>
</div>

            
          

            <!-- Modal start -->

            
  
        <!-- Modal end -->
      
        





        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content w-75">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <form class="mt-5" action="<?php $_SERVER['PHP_SELF']?>" method = "POST">
          <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder="Username/Email">

          </div>
          <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Password">
          </div>
          <div class="form-group">
            <input class="form-control btn btn-info" type="submit" name="submit" value="Submit">
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Modal end -->
       
        </div>
          <?php endwhile; ?>
</div>
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



