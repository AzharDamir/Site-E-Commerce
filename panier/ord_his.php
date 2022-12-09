<?php 
session_start();
require("./connexion.php");
require 'classpanier.php';
$panier = new panier($DB);


?>
<?php //var_dump($_SESSION); ?>
<?php 
if (!isset($_SESSION['Client'])) {
    header("location:../Client/login.php");
 }
 else
 { 
//$ids = array_keys($_SESSION['panier']); 
//var_dump($ids); 

  // $req=$DB->query('SELECT * FROM  produits as p WHERE p.id_produit IN ('.implode(',',$ids).')');

    $client=$_SESSION['Client']['id'];
   // var_dump($_SESSION['Id_client']);
    // $a=$DB->query("SELECT id_client FROM client WHERE email='$client'");
    // $b = $a->fetch();
    $id_client=$client;
  //  echo "$id_client";

    $req=$DB->query("SELECT id_commande FROM  commande WHERE id_client = '$id_client'");
    
    $commandes=$req->fetchAll(PDO::FETCH_OBJ);
  //  var_dump($commandes); 
 }
?>
<?php require_once "../navbar.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="orders_history.css">
    <title>Document</title>
</head>
<body>
    <style>
        .error{
            color:#e74c3c;
            align-content: center;
            justify-content: center;
            background-color:gainsboro;
        }
    </style>

<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>SHopping</div>
            <?php include "../sidebar.php"; ?>
        </div>
<div class="container bootdey">
    <div class="panel panel-default panel-order">
        <div class="panel-heading">
            
            <?php
              if(isset($_GET['mes'])){
                    $i=$_GET['mes'];
                    ?><div class="alert alert-warning"><?php
                    // echo "<script> alert($i) </script>".$i;
                    echo "<span style='color: salmon;'>".$i."</span>";   
             }?></div>
            <strong>Order history</strong>
            <div class="btn-group pull-right">
                <div class="btn-group">
                    <!-- <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">Filter history <i class="fa fa-filter"></i></button> -->
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#">Approved orders</a></li>
                        <li><a href="#">Pending orders</a></li>
                    </ul>
                </div>
            </div>
        </div>
                <?php foreach($commandes as $commande):

                        $id_commande=$commande->id_commande;
                        $req=$DB->query("SELECT * FROM  commande as C, lignecomm as L, produit as P  WHERE C.id_commande = L.id_commande AND P.id_produit = L.id_produit AND  C.id_commande = $id_commande");
    
                        $test=$req->fetch();
                        //var_dump($test); 
                     ?>
        <div class="panel-body">
            <div class="row">
                
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <div class="pull-right"><label class="label label-danger">rejected</label></div> -->
                            <!-- <span><strong>Order Id </strong></span> <span class="label label-info"><?php /*echo $id_commande;*/ ?></span><br /> -->
                            Quantity :  <?php  $req=$DB->query("SELECT SUM(quantite) as somme FROM  commande as C, produit as P, lignecomm as L  WHERE C.id_commande= L.id_commande AND P.id_produit=L.id_produit AND id_client = '$id_client'  AND  C.id_commande = $id_commande");
                                              $count=$req->fetch();
                                              $somme=$count['somme'];
                                              echo $somme;
                                              //var_dump($count); ?> , 
                            cost:       <?php $total=0;
                                               $pro =$DB->query("SELECT P.Prix, L.reductionligne, L.quantite FROM  commande as C, produit as P, lignecomm as L  WHERE C.id_commande= L.id_commande AND P.id_produit=L.id_produit AND id_client = '$id_client' AND  C.id_commande = $id_commande");
                                               $products = $pro->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($products as $product )
                                                {
                                                $total += $product->quantite*( $product->Prix-($product->Prix * $product->reductionligne/100));    
                                                }
                                                echo number_format($total,2,',',''); ?> DH <br /> 
                            <a  data-placement="top" href="my_orders.php?id=<?= $id_commande; ?>" type="button" class="btn btn-warning"><i
                         class="far fa-eye"></i></a>
                        </div>
                        <div class="col-md-12">order made on: <?php echo $test['dateC']; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
</body>
</html>
<?php require_once "../Footer.php";?>