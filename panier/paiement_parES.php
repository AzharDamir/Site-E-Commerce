<?php
session_start();
require './connexion.php';
require 'classpanier.php';
$panier=new panier($DB);
/*
if (!isset($_SESSION['Id_client']))
{ 
  header("location:Auth.php");
}else
{
 
    
    $client=$_SESSION['Id_client'];
    //var_dump($_SESSION['Id_client']);
    $a=$DB->query("SELECT id_client FROM client WHERE email='$client'");
    $b = $a->fetch();
    $id_client=$b['id_client'];
    //echo "$id_client";
}*/

$id_commande = $_GET['idc'];
 //echo $id_commande;
 if(isset($_POST['pay']))
 {
          
         //echo "$carte";
         $test1=$DB->query("SELECT * FROM paiement_carte WHERE id_commande= '$id_commande'");
         $test2=$DB->query("SELECT * FROM paiement_cheque WHERE id_commande= '$id_commande'");
         $test3=$DB->query("SELECT * FROM paiement_espece WHERE id_commande= '$id_commande'");
         if($test1->fetch() || $test2->fetch() || $test3->fetch()){
             header("location:http://localhost/PANIER1/panier/ord_his.php?mes=deja payé");
             exit;
         }
         $req1=$DB->query("SELECT * FROM paiement_espece WHERE id_commande= '$id_commande'");
         $sele=$req1->fetch();
         
         if(!$sele){
         
         //
         // var_dump($a); 
         //     if($a)
         //          { 
                      $req=$DB->prepare( "INSERT INTO paiement_espece (id_commande) VALUES ('$id_commande')");
                      $req->execute();

                      $req=$DB->query("SELECT id_paiementEs FROM paiement_espece  WHERE id_commande = '$id_commande'");
                      $paiement=$req->fetch();
                      $a=$paiement['id_paiementEs'];
                      
                      $re=$DB->prepare( "UPDATE commande SET id_paiementEs = '$a' where id_commande= '$id_commande'");
                      $re->execute();
                      
                     
                 // }
         
         }
         // else
         //     header("location:http://localhost:8080/panier/paiement_parCarte.php?idc=$id_commande");
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<?php require_once "../navbar.php";?>
<div class="d-flex" id="wrapper">
    <!-- <div class="click">
      <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"> <label id="dashbord" ></label></i>                     
    </div>   -->
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper" style="z-index: 7;">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>SHopping</div>
            <?php include "../sidebar.php" ?>
        </div>
        <div class="total">
            <label for="to">Total</label>
            <p><?=$_GET['tot'];?></p>
        </div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Payment Especes
                    </h3>
                    
                </div>
                <div class="panel-body">
                    <form role="form" action="#" method="POST">
                    <div class="form-group">
                        <label for="cardNumber">
                           Etes-vous sur de payer un montant de <?php
                            $total=0;
                           $pro =$DB->query("SELECT P.Prix, L.reductionligne, L.quantite FROM  commande as C, produit as P, lignecomm as L  WHERE C.id_commande= L.id_commande AND P.id_produit=L.id_produit  AND  C.id_commande = $id_commande");
                           $products = $pro->fetchAll(PDO::FETCH_OBJ);
                            foreach ($products as $product )
                            {
                            $total += $product->quantite*( $product->Prix-($product->Prix * $product->reductionligne/100));    
                            }
                            echo number_format($total,2,',',''); ?> DH  a la livraison </label>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-lg btn-block" name="pay"> Oui </button>
            <button type="annuler" class="btn btn-success btn-lg btn-block" ><a href="ord_his.php"> Non</a> </button>
            <!-- <a href="#" class="btn btn-success btn-lg btn-block" role="button">Pay</a> -->
            </form>
    </div>
    </div>
</div>
</div>
</div>
<?php require_once "../Footer.php"; ?>
</body>
</html>
<?php 
 

 /*$montont=$_POST['montant'];
 $reste = $total-$montont;  
if($reste!='O'){

    echo "<script> window.location ='./paiement_parC.php' </script>";
  }else{
  echo "process bien effectue";
  } */

  
            //echo "$carte";
                
            
            // $req=$DB->query("SELECT id_paiementEs FROM paiement_espece WHERE  id_commande = '$id_commande'");
            // $paiement=$req->fetch();
            // $a=$paiement['id_paiementEs'];
            // //var_dump($paiement); 
            //     if(empty($paiement))
            //          {
            //              $re=$DB->prepare( "UPDATE commande SET id_paiementES = '$a' where id_commande like '$id_commande'");
            //              $re->execute();
                         
            //              $req=$DB->prepare( "INSERT INTO paiement_espece (id_commande) VALUES ('$id_commande')");
            //              $req->execute();
                         
            //         }

                  
    
//var_dump($ids); 

?>