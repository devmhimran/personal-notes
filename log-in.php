<?php 
    
    include 'db/db.php';
    include 'db/function.php';

if (isset($_POST['log_in'])) {
   $username = $_POST['username'];
   $user_password = $_POST['user_password'];

  if(empty($username)){
    $username_valid = "<p class='invailed-msg'>Username/Email Required</p>";
   }
   if(empty($user_password)){
    $pass_valid = "<p class='invailed-msg'>Password Required</p>";
   }

   if(empty($username)||empty($user_password)){
    $valid =  "<p class='invailed-msg'>All fields are required<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";

   }else{

    $sql_username = "SELECT * FROM user_data WHERE user_username ='$username'|| user_email ='$username'";
    $data = $conn -> query($sql_username);
    $f_data = $data -> fetch_assoc();
    if( $data -> num_rows == 1) {
        
        if(password_verify($user_password, $f_data['password'] ) == false){

            session_start();
            $_SESSION['id'] = $f_data['id'];
            $_SESSION['user_name'] = $f_data['user_name'];
            $_SESSION['user_username'] = $f_data['user_username'];
            $_SESSION['user_email'] = $f_data['user_email'];
            $_SESSION['user_photo'] = $f_data['user_photo'];
            header("location:index.php");
        }else{
            $valid =  "<p class='invailed-msg'>Wrong Password<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";
        }

    }else{
        $valid =  "<p class='invailed-msg'>wrong username<button style='color:red;' class='close' data-dissmiss='alert'>&times;</button></p>";
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
    <link rel="stylesheet" href="assets/css/log-in.css">
</head>
<body>


    <div class="container">
        <div class="card w-25 shadow mx-auto">
            <div class="card-body">
                <div class="card-title mx-auto">
                    <h3>Login</h3>
                </div>
                <form action="<?php $_SERVER['PHP_SELF']?>" method = "POST">
                    <div class="form-group">
                        <input class="form-control username" type="text" placeholder="Username" name="username">
                        <small class="text-danger"><?php 

                            if (isset($username_valid)) {
                                echo $username_valid;
                                }

                            ?></small>
                    </div>
                    <div class="form-group">
                        <input class="form-control password" type="password" placeholder="Password" name="user_password">
                        <small class="text-danger"><?php 

                            if (isset($pass_valid)) {
                                echo $pass_valid;
                            }

                            ?></small>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-info btn-block button"  type="submit" value="Log in" name="log_in">
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