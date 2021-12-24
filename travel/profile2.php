<?php
session_start();
require("connect.php");
//$_SESSION['email']="menglinchen@gmail.com";
$email=$_SESSION['email'];
$sql="SELECT * FROM person WHERE email = '$email'";
$res = $link->query($sql);
while($row = $res->fetch_assoc())
 {
    $_SESSION['idP']=$row['idP'];
    $_SESSION['username']=$row['username'];
    $_SESSION['sex']=$row['sex'];
    $_SESSION['age']=$row['age'];
    $_SESSION['profession']=$row['profession'];
 }
 $link->close();
?>
