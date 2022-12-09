<?php 
session_start();
require("./connexion.php");
require 'classpanier.php';
$panier = new panier($DB);

?>


<?php
if (!isset($_SESSION['Client'])) 
{
    // var_dump($_SESSION['Id_client']);
   header("location:../Clients/login.php");
//    var_dump($_SESSION['Id_client']);
}
else{ 
    $ids = array_keys($_SESSION['panier']); 
    if(empty($ids)){
        echo'panier vide';
        header("location:./panier.php");
        exit;
    }
   $client=$_SESSION['Client'];
   var_dump($_SESSION['Client']);

//    $a=$DB->query("SELECT id_client FROM client WHERE email='$client'");
//    $b = $a->fetch();
   $id_client=$_SESSION['Client']['id'];
   echo "$id_client";
//Pour inserer l'etat de la commande 
$sql =$DB->prepare( "INSERT INTO etat_com (e_com) VALUES ( 0)");
$sql->execute();

//Pour chercher l'id du compte
$c=$DB->query("SELECT max(id_etat_com) from etat_com");
$d=$c->fetch();
$id_cmpt=$d['max(id_etat_com)'];
////var_dump($id_cmpt);
//$_SESSION['Id_client'] = 24;


//Insertion commande 
$req=$DB->prepare( "INSERT INTO commande (dateC,id_client,id_etat_com) VALUES (NOW(),'$id_client','$id_cmpt')");
$req->execute();

//Pour chercher l'id de la commande 
$z=$DB->query("SELECT max(id_commande) from commande");
$m=$z->fetch();
$id_comf=$m['max(id_commande)'];
//echo 'id de la commande';
//var_dump($id_comf);

//insertion de la ligne de commande 
 
$ids = array_keys($_SESSION['panier']); 
//echo 'recuperation de la session';
//var_dump($ids); 
if(empty($ids)){
    echo'panier vide';
    header("location:./panier.php");
}else{

$req=$DB->query('SELECT * FROM  produit as p WHERE  p.id_produit IN ('.implode(',',$ids).')');
$table=$req->fetchAll(PDO::FETCH_OBJ);
//echo'selection de la base de donnée';
//var_dump($table);

foreach($table as $product):
    $quantite = $_SESSION['panier'][$product->id_produit];
    $req=$DB->prepare( "INSERT INTO lignecomm (id_commande,id_produit,quantite,reductionligne) VALUES ('$id_comf',' $product->id_produit','$quantite','$product->reduction')");
    $req->execute();
endforeach;
echo 'produit bien ajouté a la base';
unset($_SESSION['panier']);
echo'<a href="javascript:history.back()">Retourner </a>';
header("location:./panier.php");
}
}


// header("Location:./ord_his.php");





?>



