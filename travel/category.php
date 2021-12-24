<?php
    session_start();  
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

    <title>Category</title>

    <link rel="apple-touch-icon" href="images/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/icons/icon-152x152.png">
   <link rel="apple-touch-icon" sizes="144x144" href="images/icons/icon-144x144.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/icon-180x180.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel='stylesheet' href='https://lib.baomitu.com/font-awesome/5.8.0/css/all.min.css'>
    <link rel="manifest" href="manifest.json">
    <style>
             table tbody {
                 display: block;
                 height:360px;
                 overflow-y: scroll;
             }
             
            tr {
                border:1 solid #ffffff;
                display: table;
                width: 100%;
                 table-layout: fixed;
             }
                td{
                    border:0px; 
                    text-align:left;
                    }
             
    </style>
    
    
    <script language=javascript>
           function ShowMenu(MenuID)
            {
                if(MenuID.style.display=="none")
                {
                    MenuID.style.display="";
                }
                else
                {
                    MenuID.style.display="none";
                }
            }
              function ShowAct(ActID)
            {
                if(ActID.style.display=="none")
                {
                    ActID.style.display="";
                }
                else
                {
                    ActID.style.display="none";
                }
            }
     </script>
    
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
            <h1 class="text-center" >Category</h1>
                <h2>Location : <span id="last_name"></span></h2><br/>
                <div class="register-form mt-5 px-4">
            <?php
	            require("connect.php"); 
                    
                $GLOBALS["ID"] = 1;
                $GLOBALS["A"] = 1;
                $sql="select * from category"; 
                $result = $link->query($sql);

                if( $result->num_rows >0 ) 
                {
                    ShowTreeMenu($link,$result);

                }
                else
                {
                    echo "Vide Category";
                }
                

            function ShowTreeMenu($link,$result) 
            { 
                $numrows= $result->num_rows; 
                echo "<table border=1 solid #ffffff>"; 

                for( $rows = 0; $rows < $numrows ; $rows++) 
                { 
                    $menu = $result->fetch_assoc(); 

                    $idCAT=$menu['idCAT'];
                    $sql="select * from souscategory where idCAT ='$idCAT'"; 
                    $result_sub=$link->query($sql); 

                    echo "<tr>"; 

                    if ($result_sub->num_rows>0) 
                    { 
                        echo "<td width='10%'></td>"; 
                        echo "<td class='Menu'>"; 
                        echo "<a href='#' onClick='javascript:ShowMenu(Menu".$GLOBALS["ID"].")'>" .$menu['nameCAT']. "</a>"; 
                        echo " </td> </tr> "; 
                        

                         echo "<tr id=Menu".$GLOBALS["ID"]. " style=\"display:none\">"; 
                         echo "<td width='20%'></td>"; 
                         echo "<td text-align=\"left\">";
                        
                         while($subM=$result_sub->fetch_assoc()){
                             $idSCAT=$subM['idSCAT'];
                              $sqlA="select * from activity where idSCAT ='$idSCAT'";                           
                             $a=$link->query($sqlA);
                             
                             if($a->num_rows>0) {
                                echo "<a href='#' onClick='javascript:ShowAct(Act".$GLOBALS["A"].")'>".$subM["nameSCAT"]. "</a>";
                                echo "</br>";
                                 echo "<div id=Act".$GLOBALS["A"]. " style=\"display:none\">";
                                 while($act=$a->fetch_assoc()){ 
                                     echo "<span id=A".$act['idA'].">";
                                     echo "<a href='activity.php?idA=".$act['idA']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--->".$act["nameA"]."</a>";
                                     echo "</span>";
                                 }
                                 echo "</div>";
                                 $GLOBALS["A"]++;
                             }else{
                                echo "<a href='#'>".$subM["nameSCAT"]."</a>";
                                echo "</br>";
                             }
                          } 
                         echo "</td>";
                         echo "</tr>";
                    } 
                    else 
                    { 
                        echo " <td width = '10%' ></td> "; 
                        echo " <td class = 'Menu'> "; 
                        echo "<a href='#' >" .$menu['nameCAT']."</a>"; 
                        echo " </td> </tr> "; 
                    }
//                    echo " <tr><td width='10%'>";
//                    echo "-";
//                    echo "</td> </tr> ";
                    $GLOBALS["ID"]++;

            }    
                echo "</table>"; 
           } 
        ?>
                 </div>   
            </div>
        </div>
        </div>
    </div>
    <script src="js/main.js"></script>
    <script language=javascript>
        const Http = new XMLHttpRequest();
        function getLocation() {
            var bdcApi = "https://nominatim.openstreetmap.org/reverse"

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    bdcApi = bdcApi
                        + "?format=json&"
                        + "lat=" + position.coords.latitude
                        + "&lon=" + position.coords.longitude;
                        
                getApi(bdcApi);

                },
                (err) => { getApi(bdcApi); },
                {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                });
        }
        function getApi(bdcApi) {
            Http.open("GET", bdcApi);
            Http.send();
            Http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var tab = JSON.parse(this.responseText);
                    //console.log(tab);
                    var city=tab.address.city;
                    //console.log(city);
                    var result=document.getElementById("last_name");  
                    result.innerHTML = city;
                    var i=1;
                    while (document.getElementById("A"+i)){
                        var t=document.getElementById("A"+i);
                        var v=t.innerHTML;
                        var text1=v.substring(0,22);
                        var text2=v.substring(22);
                        text1=text1+"city="+city+"&";
                        t.innerHTML=text1+text2;
                        console.log(t);
                        i++;
                   }
                }
            };
        }
    </script>
    <script>
        window.onload = function () {
            getLocation();
        }       
     </script> 
     </div>
</body>
</html>