<?php

    include 'db/db.php';
    include 'db/function.php';
    $valid[] ='';
    if(isset($_POST['submit'])){

echo $user_name             = $_POST['user_name'];
echo $user_username         = $_POST['user_username'];
echo $user_email             = $_POST['user_email'];
echo $user_password         = $_POST['user_password'];
echo $user_confirm_password = $_POST['user_confirm_password'];
    // $user_photo            = $_POST['user_photo'];
echo   $password_hash         = password_hash($user_password, PASSWORD_DEFAULT);
                
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

                 $sql = " INSERT INTO user_data ( user_name ,user_email,user_username,user_photo,user_password) values ('$user_name ','$user_email','$user_username','$photo_data','$password_hash')";
                 $conn -> query($sql);
                set_msg('Successfully Sign Up');


                header("location: registration.php");
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
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/registration.css">
</head>
<body>
    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-center">
                    <h3>Sign Up</h3>
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
                    <input class="btn btn-success btn-block" type="submit" value="Sign Up" name="submit">
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