<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="white">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title>POI Detail</title>

    <link rel="apple-touch-icon" href="images/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/icons/icon-152x152.png">
   <link rel="apple-touch-icon" sizes="144x144" href="images/icons/icon-144x144.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/icon-180x180.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel='stylesheet' href='https://lib.baomitu.com/font-awesome/5.8.0/css/all.min.css'>
    <link rel="manifest" href="manifest.json">
        <style>
            table{margin:auto;}    
            tr {
                display: table;
                width: 100%;
                table-layout: fixed;
             }
            td{
                text-align:left;
                width: 450px;
                color: white; 
                }
             
    </style>
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
            <h1 class="text-center" >POI Detail                   <a href="tripRecommend.php"><i class="fas fa-sign-out-alt"></i></a></h1><br/><br/><br/>
                <div class="register-form mt-5 px-4">
                 <?php
                    $json_str = file_get_contents('trip_response.json'); 
                    $data = json_decode($json_str, true); 
                    $tab=array();
                    for($j=0;$j<count($data["paris"])-1;$j++){
                        if($data["paris"][$j]["photo_references"]!=null){
                            array_push($tab,$data["paris"][$j]);
                        }                   
                    } 
                    $i = (int)$_GET['i']; 
                    echo "<table width='900px'>"; 
                    $photo=$tab[$i]["photo_references"][0];
                    echo "<tr>";
                    echo "<td><img src='$photo' width=auto height=auto></td>";  
                    echo "<td>";
                    echo "</br></br></br>";
                    echo $tab[$i]["name"];
                    echo "</br></br></br>";
                    echo "Location : ";
                    echo $tab[$i]["location"];
                    echo "</br></br></br>";
                    if($tab[$i]["rating"]!=null){
                        echo "Rating : ";
                        echo $tab[$i]["rating"];
                        echo "</br></br></br>";
                    }
                    if($tab[$i]["phone"]!=null){
                        echo "Phone : ";
                        echo $tab[$i]["phone"];
                    }
                                   
                    echo "</br></br></br></br></br>";
                    $url=$tab[$i]["url"];
                    echo "<a href='$url' class='btn btn-success btn-lg w-100'>View more</a>";
                    echo "</td>"; 
                    echo "</tr>";
                    
                    echo "</table>";
                ?>
                 </div>   
            </div>
        </div>
        </div>
    </div>
    <script src="js/main.js"></script>
    </div>
</body>
</html>