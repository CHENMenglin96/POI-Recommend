<?php
session_start();
require("connect.php");
$idP=$_SESSION['idP'];
$idT = (int)$_GET['idT']; 
$date= date($_GET['depart']); 

$sql="SELECT * FROM travel,trip,typeTrip WHERE idP = '$idP' and travel.idTrip = '$idT' and dateStart='$date' and travel.idTrip=trip.idTrip and trip.idType=typeTrip.idType";

$res = $link->query($sql);
while($row = $res->fetch_assoc())
 {
    $_SESSION['idT']=$idT;
    $_SESSION['date']=$date;
    $_SESSION['city']=$row['city'];
    $_SESSION['type']=$row['type'];
    $_SESSION['duration']=$row['duration'];
    $_SESSION['budget']=$row['budget'];
 }
 $link->close();
header("location:modifierTrip.php");
?>