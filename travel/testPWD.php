<?php
    session_start();

 if(isset($_POST['uemail']) && isset($_POST['pwd'])){
     $email = $_POST['uemail'];
     $pwd = $_POST['pwd'];

    require("connect.php");
    $sql="select * from person where email='$email'";
    $res = $link->query($sql);
    if($res->num_rows==0){
        echo "<script>alert('This email address is not registered yet');parent.location.href='index';</script>";       
        exit;
    }
    else{
        $row = $res->fetch_assoc();
        if($pwd!=$row['password']){
        echo "<script>alert('The login password entered is incorrect');parent.location.href='index';</script>";
        exit;
        }
        else{
            $_SESSION['email']=$email;
           header("location: changeProf.php");
        }
    }
  $link->close(); 
 }
?>
