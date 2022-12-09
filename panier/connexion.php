<?php
$dbcon=mysqli_connect("localhost","root","","gestionproduits");
if(!$dbcon)
{
    die("error of connexion!");
}


try {
    $DB=new pdo("mysql:host=localhost;dbname=gestionproduits;charset=utf8", "root", "");
    
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

} catch (Exception $e) 
{
   $e->getMessage();
}

?>