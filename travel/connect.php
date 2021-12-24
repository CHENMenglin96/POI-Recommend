<?php

$DB_SERVER='localhost';
$DB_USER='root';
$DB_PASS='380681';
$BD_MYSQL= 'voyage';

//print "Tentative de connexion sur sitebd<br>";

   $link=mysqli_connect($DB_SERVER,$DB_USER,$DB_PASS,$BD_MYSQL) or die(  "Impossible de se connecter à la base de données"); 

?>