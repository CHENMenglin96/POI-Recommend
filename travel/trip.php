<?php
    session_start();

 if(isset($_POST['saveT'])){
    //variables for input data
    $idP=$_SESSION['idP'];
    $city = strtolower($_POST['city']);
    $type = (int)$_POST['typeT'];
    $time = strtotime($_POST['time']);
    $date = date('Y-m-d',$time);
    $duration = (int)$_POST['duration'];
    $budget= (int)$_POST['budget'];

   require("connect.php"); 
   $sql="select * from trip where idType='$type' and LOWER(city)='$city' ";
   $res = $link->query($sql);
   $sqlIN= "Insert into trip (city,idType) values('$city','$type')";
   
    if($res->num_rows!=0){
        $row = $res->fetch_assoc();
         $idT=$row['idTrip'];
    }elseif($link->query($sqlIN) === TRUE) {
        $res2 = $link->query($sql);
        $row = $res2->fetch_assoc();
        $idT=$row['idTrip'];
    } 
     
    $sqlT= "Insert into travel (idP,idTrip,dateStart,duration,budget) values('$idP','$idT','$date','$duration','$budget')";
    if($link->query($sqlT) === TRUE) {
    echo "<script>alert('This new trip has been added to the user');parent.location.href='mytrips.php';</script>"; 
    } else {
    echo "Error updating record: " . $link->error;
    }
     $link->close(); 
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

    <title>New Trip</title>

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
    <div class="trip-wrapper d-flex align-items-center justify-content-center text-center">
      <div class="background-shape"></div>
        <div class="container">
            <div class="row justify-content-center">
            <h1 class="text-center" >New trip</h1><br/>
                <div class="register-form mt-5 px-4">
                    <form action="#" method="post">
                    <div class="form-group text-left mb-4"><span>City*</span>
                      <input class="form-control" id="city" name="city" type="text" required>
                    </div>
                     <div class="form-group text-left mb-4"><span>Type of Travel*</span>
                       <p>   
                        <select class="form-control" name="typeT" id="typeT">
                                  <?php
                                    require("connect.php"); 
                                   $sql="select * from typeTrip";
                                   $res = $link->query($sql);
                                   while($row = $res->fetch_assoc())
                                    {
                                       echo "<option class='s' value=". $row['idType'] .">" . $row['type'] . "</option>";
                                   }
                                  $link->close();
                                  ?>
                            </select>
                        </p>
                    </div>
                    <div class="form-group text-left mb-4"><span>Depart*</span>
                      <input class="form-control" id="time" name="time" type="date" min= <?php echo date('Y-m-d'); ?> value=<?php echo date('Y-m-d'); ?> >
                    </div>
                      <div class="form-group text-left mb-4"><span>Duration(d)</span>
                      <input class="form-control" id="duration" name="duration" type="number">
                    </div>
                    <div class="form-group text-left mb-4"><span>Budget(€)</span>
                      <input class="form-control" id="budget" name="budget" type="number">
                    </div><br/>
                    <input class="btn btn-success btn-lg w-100" type="submit" name="saveT" value="Save">
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