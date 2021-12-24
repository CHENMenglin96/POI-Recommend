<?php
    session_start();    

 if(isset($_POST['save'])){
    //variables for input data
    $idP=$_SESSION['idP'];
    $cat1=$_POST['CAT1'];
    $cat2 = $_POST['CAT2'];
    $cat3 = $_POST['CAT3'];
    $mode1 = $_POST['Mode1'];
    $mode2 = $_POST['Mode2'];
    $mode3 = $_POST['Mode3'];
     
    require("connect.php"); 
     
     $sqlD="Delete from interestedin where idP='$idP' ";   
     
 if ($link->query($sqlD) === TRUE) {
   if($cat1!="") {
        $sqlI="Insert into interestedin (idP,idCAT) values('$idP','$cat1')";
        $link->query($sqlI);
    } 
     if($cat2!="" && $cat2!=$cat1){
        $sqlI="Insert into interestedin (idP,idCAT) values('$idP','$cat2')";
        $link->query($sqlI);
    }
     if($cat3!="" && $cat3!=$cat1 && $cat3!=$cat2){
        $sqlI="Insert into interestedin (idP,idCAT) values('$idP','$cat3')";
        $link->query($sqlI);
    }
 }else {
    echo "Error deleting record: " . $link->error;
}
   
     $sqlD="Delete from prefer where idP='$idP' ";   
     
 if ($link->query($sqlD) === TRUE) {
   if($mode1!="") {
        $sqlI="Insert into prefer (idP,idT) values('$idP','$mode1')";
        $link->query($sqlI);
    } 
     if($mode2!="" && $mode2!=$mode1){
        $sqlI="Insert into prefer (idP,idT) values('$idP','$mode2')";
        $link->query($sqlI);
    }
     if($mode3!="" && $mode3!=$mode1 && $mode3!=$mode2){
        $sqlI="Insert into prefer (idP,idT) values('$idP','$mode3')";
        $link->query($sqlI);
    }
 }else {
    echo "Error deleting record: " . $link->error;
}   
     
echo "<script>alert('Your preferences have been saved');parent.location.href='prefer.php';</script>";
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

    <title>Preference</title>

    <link rel="apple-touch-icon" href="images/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/icons/icon-152x152.png">
   <link rel="apple-touch-icon" sizes="144x144" 
         href="images/icons/icon-144x144.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/icon-180x180.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel='stylesheet' href='https://lib.baomitu.com/font-awesome/5.8.0/css/all.min.css'>
    <link rel="manifest" href="manifest.json">
    
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
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
            <h1 class="text-center" >Preference</h1><br/>
                <div class="register-form mt-5 px-4">
                    <form action="#" method="post">
                    <div class="form-group text-left mb-4"><span>POI categories :</span>
                      <p>category 1 :
                          <select name="CAT1" id="CAT1">
                              <option value=""></option>
                              <?php
                                require("connect.php"); 
                               $sql="select * from category";
                                $res = $link->query($sql);
                               while($row = $res->fetch_assoc())
                                {
                                   echo "<option value=". $row['idCAT'] .">" . $row['nameCAT'] . "</option>";
                               }
                              $link->close();
                              ?>
                        </select>
                    </p>
                    <p>category 2 :
                          <select name="CAT2" id="CAT2">
                              <option value=""></option>
                              <?php
                                require("connect.php"); 
                               $sql="select * from category";
                                $res = $link->query($sql);
                               while($row = $res->fetch_assoc())
                                {
                                   echo "<option value=". $row['idCAT'] .">" . $row['nameCAT'] . "</option>";
                               }
                              $link->close();
                              ?>
                        </select>
                    </p>
                     <p>category 3 :
                          <select name="CAT3" id="CAT3">
                              <option value=""></option>
                              <?php
                                require("connect.php"); 
                               $sql="select * from category";
                                $res = $link->query($sql);
                               while($row = $res->fetch_assoc())
                                {
                                   echo "<option value=". $row['idCAT'] .">" . $row['nameCAT'] . "</option>";
                               }
                              $link->close();
                              ?>
                        </select>
                    </p>                    
                 </div><br/>
                    <div class="form-group text-left mb-4"><span>Transportation :</span>
                      <p>mode 1 :
                          <select name="Mode1" id="Mode1">
                              <option value=""></option>
                              <?php
                                require("connect.php"); 
                               $sql="select * from transportation";
                                $res = $link->query($sql);
                               while($row = $res->fetch_assoc())
                                {
                                   echo "<option value=". $row['idT'] .">" . $row['mode'] . "</option>";
                               }
                              $link->close();
                              ?>
                        </select>
                    </p>
                     <p>mode 2 :
                          <select name="Mode2" id="Mode2">
                              <option value=""></option>
                              <?php
                                require("connect.php"); 
                               $sql="select * from transportation";
                                $res = $link->query($sql);
                               while($row = $res->fetch_assoc())
                                {
                                   echo "<option value=". $row['idT'] .">" . $row['mode'] . "</option>";
                               }
                              $link->close();
                              ?>
                        </select>
                    </p>
                    <p>mode 3 :
                          <select name="Mode3" id="Mode3">
                              <option value=""></option>
                              <?php
                                require("connect.php"); 
                               $sql="select * from transportation";
                                $res = $link->query($sql);
                               while($row = $res->fetch_assoc())
                                {
                                   echo "<option value=". $row['idT'] .">" . $row['mode'] . "</option>";
                               }
                              $link->close();
                              ?>
                        </select>
                    </p>
                    </div> <br/> 
                    <input class="btn btn-success btn-lg w-100" type="submit" name="save" value="Save">
                   </form>
                 </div>   
            </div>
        </div>
        </div>
    </div>
    </div>
    <script src="js/main.js"></script>
    <?php
     require("connect.php");
        $idP=$_SESSION['idP'];
        $sql="select * from interestedin where idP='$idP'";
        $res = $link->query($sql);
         if($res->num_rows==1){
             $row = $res->fetch_assoc();
             $cat=$row['idCAT'];
             $t="<script>var obj=document.getElementById(\"CAT1\");
                for (var i=0;i<obj.length;i++){if(obj.options[i].value==='".$cat."'){obj.selectedIndex=i;}}</script>"; 
             echo $t;            
         }elseif($res->num_rows==2){
             $arr = array();
             while($row = $res->fetch_assoc()){
                 array_push($arr,$row['idCAT']);
             }
             $c1=$arr[0];
             $c2=$arr[1];
             echo "<script>
             var obj=document.getElementById(\"CAT1\");
                for (var i=0;i<obj.length;i++){if(obj.options[i].value==='".$c1."'){obj.selectedIndex=i;}}
             var obj2=document.getElementById(\"CAT2\");
                for (var j=0;j<obj2.length;j++){if(obj2.options[j].value==='".$c2."'){obj2.selectedIndex=j;}}             
                </script>";           
         }
          elseif($res->num_rows==3){
             $arr = array();
             while($row = $res->fetch_assoc()){
                 array_push($arr,$row['idCAT']);
             }
             $c1=$arr[0];
             $c2=$arr[1];
             $c3=$arr[2];
             echo "<script>
             var obj=document.getElementById(\"CAT1\");
                for (var i=0;i<obj.length;i++){if(obj.options[i].value==='".$c1."'){obj.selectedIndex=i;}}
             var obj2=document.getElementById(\"CAT2\");
                for (var j=0;j<obj2.length;j++){if(obj2.options[j].value==='".$c2."'){obj2.selectedIndex=j;}}  
              var obj3=document.getElementById(\"CAT3\");
                for (var k=0;k<obj3.length;k++){if(obj3.options[k].value==='".$c3."'){obj3.selectedIndex=k;}} 
                </script>";            
         }
    
        $sql2="select * from prefer where idP='$idP'";
        $res2 = $link->query($sql2);
         if($res2->num_rows==1){
             $row = $res2->fetch_assoc();
             $mode=$row['idT'];
             echo "<script>var obj=document.getElementById(\"Mode1\");
                for (var i=0;i<obj.length;i++){if(obj.options[i].value==='".$mode."'){obj.selectedIndex=i;}}</script>";            
         }elseif($res2->num_rows==2){
             $arr = array();
             while($row = $res2->fetch_assoc()){
                 array_push($arr,$row['idT']);
             }
             $c1=$arr[0];
             $c2=$arr[1];
             echo "<script>
             var obj=document.getElementById(\"Mode1\");
                for (var i=0;i<obj.length;i++){if(obj.options[i].value==='".$c1."'){obj.selectedIndex=i;}}
             var obj2=document.getElementById(\"Mode2\");
                for (var j=0;j<obj2.length;j++){if(obj2.options[j].value==='".$c2."'){obj2.selectedIndex=j;}}             
                </script>";           
         }
          elseif($res2->num_rows==3){
             $arr = array();
             while($row = $res2->fetch_assoc()){
                 array_push($arr,$row['idT']);
             }
             $c1=$arr[0];
             $c2=$arr[1];
             $c3=$arr[2];
             echo "<script>
             var obj=document.getElementById(\"Mode1\");
                for (var i=0;i<obj.length;i++){if(obj.options[i].value==='".$c1."'){obj.selectedIndex=i;}}
             var obj2=document.getElementById(\"Mode2\");
                for (var j=0;j<obj2.length;j++){if(obj2.options[j].value==='".$c2."'){obj2.selectedIndex=j;}}  
              var obj3=document.getElementById(\"Mode3\");
                for (var k=0;k<obj3.length;k++){if(obj3.options[k].value==='".$c3."'){obj3.selectedIndex=k;}} 
                </script>";            
         }
    $link->close();
    ?>
</body>
</html>

