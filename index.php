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
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
          </div>
          <span class="side-menu" style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fas fa-bars"></i></span>
          <div class="right-side">
              <div class="profile">
                  <img src="assets/img/user_img/untitled-1.jpg" alt="">
                  <a class="dropdown" href=""><i class="fas fa-chevron-down"></i></a>
              </div>

          </div>

    <hr>
          
        <div class="row">
            <div class="col-md-4"> 
                <div class="card">
                    <div class="card-body">
                        <div class="main-text">
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel impedit, asperiores quos similique suscipit sed esse recusandae eius reiciendis eligendi ipsa fugiat dignissimos tenetur nobis non! Culpa, pariatur error accusantium recusandae quos unde. Impedit maxime, beatae delectus aliquid facere neque rerum animi quia pariatur quam nisi quae ratione amet deserunt.
                            </p>
                            <a class="btn btn-outline-info" onclick="toggle()" href="#">view</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="popup" id="popup">
            <h2>Lorem Ipsum</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui maiores nulla unde facilis a fuga eveniet corrupti nostrum quas totam doloribus voluptatibus minus reprehenderit similique ex labore aperiam cum soluta accusamus, dolores dignissimos itaque obcaecati quos rerum? Qui excepturi veniam sint ipsam aliquam perspiciatis odio harum facere praesentium. Totam, officiis?
            </p>
            <a class="btn btn-dark" href="#" onclick="toggle()">Close</a>
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