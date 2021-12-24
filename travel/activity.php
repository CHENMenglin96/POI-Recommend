<?php

    header("Content-type:text/html;charset=utf8");
    require("connect.php"); 
    session_start();

    class Tourist{
        public $person;
        public $category;
    }
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
      public $location;
  }

    $location=(string)$_GET['city']; 
    $tour=new Tourist();
    $email=$_SESSION['email'];
    $sqlP="select * from person where email='$email'";
    $resP = $link->query($sqlP);

    while ($rowP=$resP->fetch_assoc()){
        $p = new Person();
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
        
        $sqlTP="SELECT * FROM travel,trip,typeTrip WHERE idP = '$idP' and travel.idTrip=trip.idTrip and trip.idType=typeTrip.idType";
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
        $p->location=$location;
    }

    $idA = (int)$_GET['idA']; 
    $sql="select * from activity where idA='$idA'";
    $resA = $link->query($sql);
    while ($raa=$resA->fetch_assoc()){
        $a=new Activity();
        $a->idA = $raa["idA"];
        $a->nameA = $raa["nameA"];
        $idSCAT=$raa["idSCAT"];
        $sqlS="select * from souscategory where idSCAT='$idSCAT'";
        $resS = $link->query($sqlS);
        while($rss=$resS->fetch_assoc()){
            $scat=new SousCategory();
            $scat->idSCAT = $rss["idSCAT"];
            $scat->nameSCAT = $rss["nameSCAT"];
            $scat->activity =$a;
            $idCAT=$rss["idCAT"];
            $sqlC="select * from category where idCAT='$idCAT'";
            $resC = $link->query($sqlC);
            while ($rows=$resC->fetch_assoc()){
                $cat = new Category();
                $cat->idCAT = $rows["idCAT"];
                $cat->nameCAT = $rows["nameCAT"];
                $cat->sousCategory =$scat;
            }
        }
    }

    $tour->person =$p;
    $tour->category =$cat;
    
//   $stp=json_encode($arrP);
//   $stc=json_encode($arrC);
//   print_r($stp);
//   print_r('</br>');
//   print_r($stc);

    $str=json_encode($tour);
    print_r($str);  
    $bytes = file_put_contents("activity.json", $str);

    $link->close();
?>
