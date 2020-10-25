<!-- 

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Desi Developer</title>
 <title>Document</title>
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index-1.css">
</head>
<body>
 <a href="#modal1" class="modal-open">Open Modal</a>
 
 <div class="modal1" id="modal1">
    <div class="modal__content">
      <a href="#" class="modal__close">&times;</a>
      <h2 class="modal__heading">Desi Developer</h2>
      <p class="modal__paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis possimus inventore suscipit mollitia, odit aliquam laudantium praesentium porro hic asperiores expedita obcaecati earum ullam, nisi laborum accusamus, id placeat tenetur?
      Consequatur, neque. Explicabo, reiciendis quia distinctio eius facere pariatur expedita, amet hic alias illum harum inventore, ullam tempore quos. Quod, repellat ratione culpa qui harum blanditiis atque voluptatem iste id.
      Rerum veniam ipsum quisquam mollitia vel fuga dicta tempora. Magni, labore beatae eaque suscipit mollitia pariatur impedit accusantium explicabo aspernatur adipisci sapiente eveniet qui facilis in voluptas nisi! Ipsum, praesentium!
      Quos, ex. Ipsum asperiores quasi, nam atque voluptatibus reprehenderit repellat fuga pariatur consequatur quae hic, numquam commodi illo aut. Laborum et natus magni illum tenetur est, minus eligendi quisquam facilis.
      Quis enim sit facilis, dolor, ab quas sint sapiente ut voluptatibus excepturi dolorum, consequuntur doloremque error facere? Nisi vel placeat magni asperiores, id, aliquid quisquam eos et eum repellat molestiae.</p>
    </div>
 </div>




 <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html> -->













<?php
    include 'db/db.php';
    include 'db/function.php';
    $valid[] ='';
    if (isset($_POST['submit'])) {
    echo    $user_name = $_POST['user_name'];
    echo    $user_email = $_POST['user_email'];
    echo    $user_username = $_POST['user_username'];
    echo    $user_password = $_POST['user_password'];
    echo    $user_confirm_password = $_POST['user_confirm_password'];
    echo     $password_hash         = password_hash($user_password, PASSWORD_DEFAULT);

    // username check
    // -------------------------------
    $unique_username_check =  unique_check($conn,'user_username', 'user_data', $user_username);
    // email check
   // -------------------------------
     $unique_email_check =  unique_check($conn,'user_email', 'user_data', $user_email);

    // Confirm Password
   // -------------------------------
     if($user_password  == $user_confirm_password){
       $password_check = true;
     }else{
       $password_check =  false;
     }

     if(empty($user_name)){
       $valid_name =  "<p class='invailed-msg'>Enter Your Name</p>";
     }
     if(empty($user_username)){
       $valid_username =  "<p class='invailed-msg'>Enter Username</p>";
     }
     if(empty($user_email)){
       $valid_email =  "<p class='invailed-msg'>Enter Your Email</p>";
     }
     if(empty($user_password)){
       $valid_password = "<p class='invailed-msg'>Enter Password</p>";
     }
     if(empty($user_confirm_password)){
       $valid_confirm_password = "<p class='invailed-msg'>Enter Password</p>";
     }

     if ($unique_username_check == false ) {   
               $valid_username =  "<p class='invailed-msg'>Username already exists</p>";
               
               
           }
           
           if( $unique_email_check == false){
               $valid_email =  "<p class='invailed-msg'>Email already exists</p>";
           
           }
           if( $password_check == false){
               $valid_pass =  "<p class='invailed-msg'>Password doesn't match</p>";
           }

   

    // form-validation
    // -------------------------------
    if(empty($user_name )  || empty( $user_username) || empty($user_email) || empty($password_hash)){
        $valid[] =  "<p class='alert alert-danger'>All fields are required<button class='close' data-dissmiss='alert'>&times;</button></p>";
        }elseif ($unique_username_check == false) {
               $valid[] =  "<p class='alert alert-warning'>Couldn't Sign In !<button class='close' data-dissmiss='alert'>&times;</button></p>";
               // $valid_username =  "<p>Username already exits</p>";
        }elseif ($unique_email_check == false) {
           $valid[] =  "<p class='alert alert-warning'>Couldn't Sign In !<button class='close' data-dissmiss='alert'>&times;</button></p>";
           $valid_email =  "<p>Email already exits</p>";
        }elseif ($password_check == false) {
           $valid[] =  "<p class='alert alert-warning'>Couldn't Sign In !<button class='close' data-dissmiss='alert'>&times;</button></p>";
           $valid_pass =  "<p>Password doesn't match</p>";
           }else{

       
           // Photo validation + Upload DataBase
          // -----------------------------------
           $data = photo_upload($_FILES['user_photo'],'assets/img/user_img/');
           $photo_data = $data['file_name'];

           if ( $data['status'] == 'yes' ) {

                $sql = " INSERT INTO user_data ( user_name,user_email,user_username,user_photo,user_password) values ('$user_name ','$user_email','$user_username','$photo_data','$password_hash')";
                $conn -> query($sql);
               set_msg('Successfully Sign Up');


               header("location: index-1.php");
           }
           else{
               $valid[] =  "<p class='alert alert-warning'>Invaild file format<button class='close' data-dissmiss='alert'>&times;</button></p>";
           }                       
    }



    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Document</title>
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index-1.css">
</head>
<body>

    <div class="container">
        <div class="card w-50 mx-auto mt-5">
           
            <div class="card-body">
                <div class="form-title mb-3 ">
                    <h2>Registration</h2>
                </div>
                <?php 

						if ( count($valid)>0) {
							foreach ($valid as $v) {
								echo $v;
							}
						}
					
						get_msg();
					?>
               <form action="<?php $_SERVER['PHP_SELF']?>" method = "POST" enctype='multipart/form-data'>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Name" name="user_name">
                    <small class="text-danger">
                    <?php 
                        if (isset($valid_name)) {
                            echo $valid_name;
                        }
                    ?> 
                </small>
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" placeholder="Email" name="user_email">
                    <small class="text-danger">
                <?php 
                                            if (isset($valid_email)) {
                                                echo $valid_email;
                                                }
                                            ?> 
                </small>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Username" name="user_username">
                    <small class="text-danger"><?php 
                                            if (isset($valid_username)) {
                                                echo $valid_username;
                                                }
                                            ?> </small>
                </div>
                <div class="form-group">
                    <input class="form-control" type="file" placeholder="Photo" name="user_photo">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Password" name="user_password">
                    <small class="text-danger">
                                            <?php 
                                                if (isset($valid_pass)) {
                                                echo $valid_pass;
                                                }
                                            ?> 
                                        </small>
                                        <small class="text-danger">
                                            <?php 
                                                if (isset($valid_password)) {
                                                echo $valid_password;
                                                }
                                            ?>   
                                        </small>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Confirm Password" name="user_confirm_password">
                    <small class="text-danger">
                                            <?php 
                                                if (isset($valid_confirm_password)) {
                                                echo $valid_confirm_password;
                                                }
                                            ?>   
                                        </small>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Sign In" name="submit">
                </div>
               </form>
            </div>
        </div>
    </div>


 <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>