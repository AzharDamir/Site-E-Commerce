<?php
require './connexion.php';
require 'classpanier.php';
session_start();
$panier=new panier($DB);
if (!isset($_SESSION['Client']))
{ 
  header("location:http://localhost/PANIER1/Clients/login.php");
  exit;
}else
{
 
    
    // $client=;
    // //var_dump($_SESSION['Id_client']);
    // $a=$DB->query("SELECT id_client FROM client WHERE email='$client'");
    // $b = $a->fetch();
    $id_client=$_SESSION['Client']['id'];
    //echo "$id_client";
}
$id_commande = $_GET['idc'];
    
//echo $id_commande;



    if(isset($_POST['pay']))
    {
             $carte = $_POST['card'];
            //echo "$carte";
            $test1=$DB->query("SELECT * FROM paiement_espece WHERE id_commande= '$id_commande'");
            $test2=$DB->query("SELECT * FROM paiement_cheque WHERE id_commande= '$id_commande'");
            $test3=$DB->query("SELECT * FROM paiement_carte WHERE id_commande= '$id_commande'");
            if($test1->fetch() || $test2->fetch() || $test3->fetch()){
                header("location:http://localhost/PANIER1/panier/ord_his.php?mes=deja payé");
                exit;
            }
                
            $req1=$DB->query("SELECT * FROM paiement_carte WHERE id_commande= '$id_commande'");
            $sele=$req1->fetch();
            
            if(!$sele){
            
            //
            // var_dump($a); 
            //     if($a)
            //          { 
                         $req=$DB->prepare( "INSERT INTO paiement_carte (id_commande, type_carte) VALUES ('$id_commande','$carte')");
                         $req->execute();

                         $req=$DB->query("SELECT id_paiementCarte FROM paiement_carte  WHERE id_commande = '$id_commande'");
                         $paiement=$req->fetch();
                         $a=$paiement['id_paiementCarte'];
                         
                         $re=$DB->prepare( "UPDATE commande SET id_paiementCarte = '$a' where id_commande= '$id_commande'");
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
<style>
 body { margin-top:20px; }
.panel-title {display: inline;font-weight: bold;}
.checkbox.pull-right { margin: 0; }
.pl-ziro { padding-left: 0px; }
</style>
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
                        Payment Details
                    </h3>
                    
                </div>
                <div class="panel-body">
                    <form role="form" action="#" method="POST">
                    <div class="form-group">
                        <label for="cardNumber">
                            CARD NUMBER</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number"
                                required autofocus />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group">
                                <label for="expityMonth">
                                    EXPIRY DATE</label>
                                <div class="col-xs-8 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityMonth" placeholder="MM" required />
                                </div>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityYear" placeholder="YY" required /></div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-md-5 pull-right">
                            <div class="form-group">
                                <label for="cvCode">
                                    CV CODE</label>
                                <input type="password" class="form-control" id="cvCode" placeholder="CV" required />
                            </div>
                        </div>
                        
                          <label for="cardNumber">
                            CARD TYPE </label>
                         <div class="input-group">
                         <select class="form-control"  name="card" required autofocus>
                             <option value="Visa">Visa</option>
                             <option value="MasterCard "> MasterCard </option>
                             <option value="Gold MasterCard">Gold MasterCard</option>
                             <option value="Visa premier">Visa premier</option>
                        </select> 

                            <!-- <input type="hidden" name="pass" value="<?php // echo "$id_commande"; ?>"> -->
                            
                    </div>
                    
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-lg btn-block" name="pay">Pay</button>
            <!-- <a href="#" class="btn btn-success btn-lg btn-block" role="button">Pay</a> -->
        </form>
    </div>
    </div>
</div>
</div></div>
<?php require_once "../Footer.php";?>
</body>
</html>
<?php

 /*
if (!isset($_SESSION['Id_client']))
 {
    header("location:Auth.php");
 } else
 { 
    $client=$_SESSION['Id_client'];
    //var_dump($_SESSION['Id_client']);
    $a=$DB->query("SELECT id_client FROM client WHERE email='$client'");
    $b = $a->fetch();
    $id_client=$b['id_client'];
    echo "$id_client";
 
 
$id_commande = $_GET['idc'];
echo $id_commande;

if(isset($_POST['pay']))
{
    $carte = $_POST['card'];
    //echo "$carte";
    
    //var_dump($typecard);
   $req=$DB->query("SELECT id_paiementCarte FROM paiement_carte   WHERE id_commande = '$id_commande'  AND id_client = '$id_client'");
   $paiement=$req->fetchAll(PDO::FETCH_OBJ);
   var_dump($paiement); 
    //  $req =$DB->query("SELECT type_carte FROM paiement_carte   WHERE id_commande = '$id_commande' AND id_paiementCarte = '$paiement'");
    // $exec=$req->fetch();
     //$typecard=$paiement->type_carte;
    // echo "$typecard";
   
   if(empty($paiement))
   {
   
    $re=$DB->prepare( "UPDATE commande set id_paiementCarte ='$paiement'");
    $re->execute();
  
    var_dump($re);
    $req=$DB->prepare( "INSERT INTO paiement_carte (id_commande, type_carte) VALUES ('$id_commande','$carte')");
    $req->execute();
   }
}


 
 }

*/
?>


<?php 
 



    


//var_dump($ids); 

?>