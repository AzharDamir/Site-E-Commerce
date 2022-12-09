<?php

require './connexion.php';
require_once 'classpanier.php';

$panier = new panier ($DB);
if(!isset($_SESSION['Client']))
{
   header("location:http://localhost/PANIER1/Clients/login.php");
}else{
   $prod_id = $_GET['id'];
if(isset($_GET['id']))
{
   /*
    $select="SELECT id_produit FROM produits WHERE id_produit=:id";
    $res= $DB->prepare($select);
    $res->execute();
    $product = $res->fetchAll(PDO::FETCH_OBJ);*/

    
    $req = $DB->query("SELECT id_produit FROM produit WHERE id_produit='$prod_id'");
    $product=$req->fetchAll(PDO::FETCH_OBJ);

   if(empty($product))
   {
    echo "<script> alert('Product doesn't exist') </script>";
       echo "<script> window.location ='../index.php' </script>";
   } 
   $panier->add($product[0]->id_produit);
   //die('Le produit a bien ete ajouté <a href="javascript:history.back()">Retourner </a>');
   echo "<script> alert('Product is added in the cart') </script>";
   echo "<script> window.location ='../index.php' </script>";
}else {
   // die("vous n'avez pas selectioner de produit");
    echo "<script> alert('you didnt select any product')</script>";
    echo "<script> window.location ='../index.php' </script>";
}
}
?>