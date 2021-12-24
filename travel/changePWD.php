<?php
    session_start();

 if(isset($_POST['pass'])&&isset($_POST['rpass'])){
    //variables for input data
    $email=$_SESSION['email'];
    $pass = $_POST['pass'];
    $rpass = $_POST['rpass'];

   if ($pass==$rpass){
    require("connect.php");    
     
   $sql= "UPDATE person Set password='$pass' WHERE email='$email'";

    if ($link->query($sql) === TRUE) {
    echo "<script>alert('User\'s password has been updated');parent.location.href='changePWD.php';</script>"; 
    } else {
    echo "Error updating record: " . $link->error;
    }
  $link->close(); 
   }else{
    echo "<script>alert('Please confirm the password');parent.location.href='changePWD.php';</script>";  
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

    <title>Profile</title>

    <link rel="apple-touch-icon" href="images/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/icons/icon-152x152.png">
   <link rel="apple-touch-icon" sizes="144x144" href="images/icons/icon-144x144.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/icon-180x180.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel='stylesheet' href='https://lib.baomitu.com/font-awesome/5.8.0/css/all.min.css'>
    <link rel="manifest" href="manifest.json">
</head>
<body>
    <div class="page">
    <div class="navbar">
		<div class="user">

			<div class="Uemail"><?php
                    echo $_SESSION['email']; ?></div>
		</div>
		<div class="bar">
			<div class="options">
            <ul>
                <li><a href="changeProf.php"><i class="lni lni-user"></i>My Profile</a></li>
                <li><a href="changePWD.php"><i class="lni lni-alarm lni-tada-effect"></i>Password</a></li>
                <li><a href="prefer.php"><i class="lni lni-empty-file"></i>Preference</a></li>
                <li><a href="trip.php"><i class="lni lni-empty-file"></i>New Trip</a></li>
                <li><a href="mytrips.php"><i class="lni lni-empty-file"></i>My Trips</a></li>
                <li><a href="category.php"><i class="lni lni-heart"></i>Category</a></li>
            </ul>
			</div>
			<div class="settings">
				<ul>
					<li><a href="index.html"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
    
    <div class="content">
    <div class="profile-wrapper d-flex align-items-center justify-content-center text-center">
      <div class="background-shape"></div>
        <div class="container">
            <div class="row justify-content-center">
            <h1 class="text-center" >Password</h1><br/><br/><br/>
                <div class="register-form mt-5 px-4">
                    <form action="#" method="POST">
                    <div class="form-group text-left mb-4"><span>New Password*</span>
                      <input class="form-control" id="password" name="pass" type="password" placeholder="********************" required>
                    </div>
                    <div class="form-group text-left mb-4"><span>Repeat Password*</span>
                      <input class="form-control" id="rpassword" name="rpass" type="password" placeholder="********************" required>
                    </div><br/><br/>
                    <button class="btn btn-success btn-lg w-100" type="submit">Confirm</button>
                  </form>
                 </div>   
            </div>
        </div>
        </div>
    </div>
    <script src="js/main.js"></script>
    </div>
</body>
</html>