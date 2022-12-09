<?php
require './connexion.php';
require 'classpanier.php';
session_start();
$panier=new panier($DB);
if (!isset($_SESSION['Client']))
{ 
  header("location:http://localhost/PANIER1/Clients/login.php");
}else
{
 
    
    // $client=$_SESSION['Id_client'];
    // //var_dump($_SESSION['Id_client']);
    // $a=$DB->query("SELECT id_client FROM client WHERE email='$client'");
    // $b = $a->fetch();
    $id_client=$_SESSION['Client']['id'];
    //echo "$id_client";

}

$id_commande = $_GET['idc'];
 //echo $id_commande;
    
        $total=0;
         $pro =$DB->query("SELECT P.Prix, L.reductionligne, L.quantite FROM  commande as C, produit as P, lignecomm as L  WHERE C.id_commande= L.id_commande AND P.id_produit=L.id_produit  AND  C.id_commande = '$id_commande' AND C.id_client=$id_client ");
          $products = $pro->fetchAll(PDO::FETCH_OBJ);
          foreach ($products as $product )
           {
            $total += $product->quantite*( $product->Prix-($product->Prix * $product->reductionligne/100));    
           }
          // echo number_format($total,2,',','');
           

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
    <div class="container" style="margin:25px;width:100%">
            <div class="row">
                <div class="col-xs-20 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Payment Details
                            </h3>
                            <!-- <div class="checkbox pull-right">
                                <label>
                                    <input type="checkbox" />
                                    Remember
                                </label>
                            </div> -->
                        </div>
                        <div class="panel-body">
                            <form role="form" action="#" method="POST">
                            <div class="form-group">
                        </div>
                            <div class="row">
                                <div class="col-xs-7 col-md-7">
                                    <div class="form-group">
                                        <label  for="expityMonth">
                                            MONTANT </label>
                                        <input type="text" name="montant" class="form-control" id="expityMonth" placeholder="Montant" required />
                                    
                                    </div>
                                        
                                </div>
                                
                                <label for="cardNumber">
                                    type de cheque </label>
                                <div class="input-group" style="size: 32px;">
                                <select class="form-control"  name="card" required autofocus>
                                    <option value="Le chèque barré " ><p></p> Le chèque barré </option>
                                    <option value="Le chèque non-barré">Le chèque non-barré</option>
                                    <option value="Le Chèque de Banque">Le Chèque de Banque</option>
                                </select> 
                                <input type="hidden" name="pass" value="<?php  echo "$id_commande"; ?>"> 
                                    
                            </div>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="pay">Terminer</button>
                    <!-- <a href="#" class="btn btn-success btn-lg btn-block" role="button">Pay</a> -->
                    </form>
              </div>
        </div>
    </div>
</div>
</div>

<?php require_once "../Footer.php";?>
</body>
</html>

<?php 
 
 
    
if(isset($_POST['pay']))
{
        $test=$DB->query("SELECT * from commande where id_commande='$id_commande'");
        $testre=$test->fetch();
        $car=$testre['id_paiementCarte'];
        $esp=$testre['id_paiementES'];
        echo 'ddd';
         if($car!=0 || $esp !=0){
              echo 'ho';
        //     header("location:http://localhost/PANIER1/panier/ord_his.php?mes=deja payé");
        //     exit;
        die("ho");
        }
            $montont=$_POST['montant'];
             $carte = $_POST['card'];
            //echo "$carte"; 
            $req1=$DB->query("SELECT * FROM paiement_cheque WHERE id_commande= '$id_commande'");
            //  $sele=
            
            
            //
                $mnt=0;
                    while( $kha=$req1->fetch())
                    {
                        $idch=$kha['id_paiementCH'];
                        // $del=$DB->query("SELECT montant from paiement_cheque where id_paiementCH='$idch'");
                        // $mm1=$del->fetch();
                        $mnt=$mnt+$kha['montant'];
                        echo "  $idch ";
                    }
                    $reste = $total-$mnt;//le reste qu'il nous faut
                    $impr=$mnt+$montont;//le monteau deja effectue + du neauvau cheque
                    $r1=$total-$impr;//le nouveau reste
                     echo $mnt."< -mnt we have and $montont we put /et imprtt:àà ".$impr ."  r1: $r1  et le reste : ".$reste ."<br>";

            //
            //if($mnt == 0){
                if($impr <= $total && $montont >0 ){
                        $req=$DB->prepare( "INSERT INTO paiement_cheque (id_commande,type_cheque, montant, etat_de_cheque) VALUES ('$id_commande','$carte','$montont','non effectué')");
                        $req->execute();
                         
                }else{
                    echo "<script> alert('votre montant a dépassé le montant de la commande ,il ne vous faut que $reste ') </script>";
                }
                  
            //}
            // else{

                
            //         if($reste == $r1 ){
            //             //insertion commande complete
            //                     $req=$DB->prepare( "INSERT INTO paiement_cheque (id_commande, type_cheque, montant, etat_de_cheque) VALUES ('$id_commande','$carte','$montont','non effectué')");
            //                     $req->execute();
            //                     echo "<script> alert('votre montant est complet ') </script>";
            //                     header("location:http://localhost:8080/panier/ord_his.php");
            //         }else{
            //             if($reste > $r1){
            //                 //cas d'ajout mais sans complet du paiement
            //                     $req=$DB->prepare( "INSERT INTO paiement_cheque (id_commande, type_cheque, montant, etat_de_cheque) VALUES ('$id_commande','$carte','$montont','non effectué')");
            //                     $req->execute();
            //                     // header("location:http://localhost:8080/panier/ord_his");
            //             }else{//cas d'erreur comme le montant entre depasse le reste qu'il nous faut
            //                         echo "<script> alert('votre montant a dépassé le montant de la commande ,il ne vous faut que $reste') </script>";
            //             }                   
            //     }
                
            // }
           //   header("location:http://localhost:8080/panier/paiement_parCarte.php?idc=$id_commande");
}


//var_dump($ids); 

?>