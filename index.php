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

                            <small>Created at <?php
                                $date = strtotime($post_data['created_at']);
                                echo "Time: ".date('d/m/y',$date)."<br>";
                             ?></small>
                            <a href="#<?php echo $post_data['content_id']; ?>" class=" btn btn-info btn-sm " ><i class="far fa-eye"></i></a>
                            <a href="post-edit.php?id=<?php echo $post_data['content_id']; ?>" class=" btn btn-warning btn-sm "  ><i class="far fa-edit"></i></a>
                            <a id="data_delete" class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $post_data['content_id'];  ?>"><i class="far fa-trash-alt"></i></a>
                            <a href="#<?php echo $post_data['content_id']; ?>" class=" btn btn-info btn-sm " ><i class="fas fa-download"></i></a>
                        </div>
                    </div>                   
                </div>
              
           


          <!-- delete modal  start-->

         <!-- Button trigger modal -->


<!-- Modal -->


          <!-- delete modal end -->












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



        <script>
                CKEDITOR.replace( 'editor1' );
        </script>
<!-- <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

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

    $('a#data_delete').click(function(){
      let val = confirm('Are You Want To Delete ?');

      if( val == true){
        return true;
      }else{
        return false;
      } 
    });



</script>
</body>
</html>



