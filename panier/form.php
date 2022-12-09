<?php
session_start();
$idp=$_GET['idp'];
$meth=$_GET['m'];
echo $idp .$meth ;
if($meth== 'm'){
    $_SESSION['panier']["$idp"]--;
    if($_SESSION['panier']["$idp"]== '0')
    {
        header("Location:./panier.php?del=$idp");
        exit;
    }
        
}elseif($meth == 'p'){
    $_SESSION['panier']["$idp"]++;
}
header("Location:./panier.php");