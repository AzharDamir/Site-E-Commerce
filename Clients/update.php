<?php
require_once "../connexion.php";
$id1=$_GET['idp'];
 if(isset($_POST['su'])){
    $etat=$_POST['et'];
    //echo "   $id1   ";
        $sql="UPDATE `client` SET `etat` ='$etat' WHERE `client`.`id_client` =$id1";
    
    $result1=mysqli_query($dbcon,$sql);
    if($result1)
    header("Location:afficher.php?V");
    else
    header("Location:afficher.php?F");

}