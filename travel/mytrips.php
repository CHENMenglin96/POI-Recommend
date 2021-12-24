<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="white">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title>My Trips</title>
    <style>
        table{margin:auto;}
    </style>

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

			<div class="Uemail"><?php session_start();
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
    <div class="Mytrips-wrapper d-flex align-items-center justify-content-center text-center">
      <div class="background-shape"></div>
        <div class="container">
            <div class="row justify-content-center">
            <h1 class="text-center" >My trips</h1><br/>
                <div class="register-form mt-5 px-4">
                <strong><span style="font-size:18px;padding-left :1rem;">
                <?php
                    require("connect.php"); 
                    $idP=$_SESSION['idP'];       
                    
                    $sql="select * from travel, trip,typeTrip where travel.idTrip=trip.idTrip and trip.idType=typeTrip.idType and travel.idP='$idP'";
                    $res = $link->query($sql);
                    
                    echo "<table border='1' width='700px'>
                    <tr>
                    <th>City</th>
                    <th>Type</th>
                    <th>Depart</th>
                    <th>Duration(d)</th>
                    <th>Budget(€)</th>
                    <th>-</th>
                    <th>-</th>
                    </tr>";                   
                    
                    while($row = $res->fetch_assoc())
                     {
                        echo "<tr>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";
                        echo "<td>" . $row['dateStart'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['budget'] . "</td>";
                        echo "<td><a href='detailTrip.php?idT=".$row['idTrip']." && depart=".$row['dateStart']. "'>Modify</a></td>";
                        echo "<td><a href='usertrip.php?idT=".$row['idTrip']." && depart=".$row['dateStart']. "'>Recommend</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    $link->close();
                ?></span></strong>
                 </div>   
            </div>
        </div>
        </div>
    </div>
    <script src="js/main.js"></script>
    </div>
</body>
</html>