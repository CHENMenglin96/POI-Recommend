<?php

    header("Content-type:text/html;charset=utf8");
    require("connect.php"); 
    session_start();


    class Category 
    {
        public $idCAT;
        public $nameCAT;
        public $sousCategory;
    }
    class SousCategory{
        public $idSCAT;
        public $nameSCAT;
        public $activity;
    }
   class Activity{
        public $idA;
        public $nameA;
   }
  class Transportation{
      public $idT;
      public $mode;
  }

class Prefer{
    public $categories;
    public $transportation;
}

class Trip{
    public $idTrip;
    public $type;
    public $city;
    public $dateStart;
    public $duration;
    public $budget;
}

  class Person{
      public $idP;
      public $email;
      public $password;
      public $username;
      public $age;
      public $sex;
      public $profession;
      public $prefer;
      public $trip;
  }

    $p = new Person();
    $email=$_SESSION['email'];
    $sqlP="select * from person where email='$email'";
    $resP = $link->query($sqlP);
    $idT = (int)$_GET['idT']; 
    $date= date($_GET['depart']);

    while ($rowP=$resP->fetch_assoc()){
        $p->idP = $rowP["idP"];
        $p->email = $rowP["email"];
        $p->password = $rowP["password"];
        $p->username = $rowP["username"];
        $p->age = $rowP["age"];
        $p->sex = $rowP["sex"];
        $p->profession = $rowP["profession"];
        
        $prefer= new Prefer();
        
       	$idP=$rowP["idP"];
        $sqlC="select * from interestedin,category where interestedin.idCAT=category.idCAT and idP='$idP'";
        $resC = $link->query($sqlC);
        if ($resC->num_rows>0) {
            $pc=array();
            while($rpc=$resC->fetch_assoc()){
//                $ca=new Category();
//                $ca->idCAT = $rpc["idCAT"];
//                $ca->nameCAT = $rpc["nameCAT"]; 
                array_push($pc,$rpc["nameCAT"]);
            }
            $prefer->categories =$pc;
        }
        
        $sqlT="select * from prefer,transportation where prefer.idT=transportation.idT and idP='$idP'";
        $resT = $link->query($sqlT);
        if ($resT->num_rows>0) {
            $pt=array();
            while($rpt=$resT->fetch_assoc()){
                $t=new Transportation();
                $t->idT = $rpt["idT"];
                $t->mode = $rpt["mode"]; 
                array_push($pt,$t);
            }
            $prefer->transportation =$pt;
        }
  
        $p->prefer=$prefer;
        
        $sqlTP="SELECT * FROM travel,trip,typeTrip WHERE idP = '$idP' and travel.idTrip = '$idT' and dateStart='$date' and travel.idTrip=trip.idTrip and trip.idType=typeTrip.idType";
        $resTP = $link->query($sqlTP);
        if ($resTP->num_rows>0) {
            $tr=array();
            while($rtp=$resTP->fetch_assoc()){
                $trip=new Trip();
                $trip->idTrip = $rtp["idTrip"];
                $trip->type = $rtp["type"];
                $trip->city = $rtp["city"]; 
                $trip->dateStart = $rtp["dateStart"]; 
                $trip->duration = $rtp["duration"]; 
                $trip->budget = $rtp["budget"];                      
                array_push($tr,$trip);
            }
             $p->trip=$tr;
        }
    }

    $str=json_encode($p);
    print_r($str);  
    $bytes = file_put_contents("usertrip.json", $str);

    $link->close();
?>
