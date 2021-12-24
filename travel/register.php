<?php
    session_start();

 if(isset($_POST['btnC'])){
    //variables for input data
    $email=$_POST['email'];
    $pass = $_POST['pass'];
    $rpass = $_POST['rpass'];

  if ($pass==$rpass){
    require("connect.php");    
 
    $sql="select * from person where email='$email'";
    $res = $link->query($sql);
      
   $sqlD= "insert into person (email,password) values('$email','$pass')";
    if($res->num_rows!=0){
        echo "<script>alert('This email address has registered');parent.location.href='register.php';</script>";     
        exit;
    }elseif($link->query($sqlD) === TRUE) {
        $_SESSION['email']=$email;
        header("location: changeProf.php");
    } 
      $link->close(); 
   }else{
    echo "<script>alert('Please confirm the password');parent.location.href='register.php';</script>";  
   }
 }        
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="white">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    
    <title>Register</title>
    <!-- Apple Touch Icon-->
    <link rel="apple-touch-icon" href="images/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/icons/icon-144x144.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/icon-180x180.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="manifest" href="manifest.json">
</head>
<body>
    <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
      <div class="background-shape"></div>
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="text-center" >Register</h1><br/>
                <div class="register-form mt-5 px-4">
                    <form action="#" method="post">
                    <div class="form-group text-left mb-4"><span>Email</span>
                      <input class="form-control" id="email" name="email" type="text" placeholder="info@example.com" required>
                    </div>
                    <div class="form-group text-left mb-4"><span>Password</span>
                      <input class="form-control" id="password" name="pass" type="password" placeholder="********************" required>
                    </div>
                    <div class="form-group text-left mb-4"><span>Repeat Password</span>
                      <input class="form-control" id="rpassword" name="rpass" type="password" placeholder="********************" required>
                    </div><br/>
                    <input class="btn btn-success btn-lg w-100" type="submit" name="btnC" value="Register">
                  </form>
                 </div><br/>   
                <div class="login-meta-data">
                    <p class="mb-0">Already have an account?<a class="ml-1" href="index.html">Log in Now</a></p>
                </div>
            </div>
        </div>
        </div>
    <script src="js/main.js"></script>
</body>
</html>