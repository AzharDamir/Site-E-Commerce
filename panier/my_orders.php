
<?php 

session_start();
require("./connexion.php");
require 'classpanier.php';
$panier = new panier($DB);
if (!isset($_SESSION['Client'])) {
    header("location:http://localhost/PANIER1/Client/login.php");
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
    //echo "$id_client";


	$id_commande = $_GET['id'];
	if(isset($_GET['id']))
	{
    	/*$req=$DB->query("SELECT id_commande FROM  commande WHERE id_client = '$id_client' AND id_commande = $id_commande ");
        $commandes=$req->fetchAll(PDO::FETCH_OBJ);*/
	     //  $id_commande=$commandes->id_commande;
        // var_dump($commandes); 
        // $req=$DB->query("SELECT * FROM  commande as C, produits as P, lignecomm as L  WHERE C.id_commande= L.id_commande AND P.id_produit=L.id_produit AND C.id_commande = $id_commande AND id_client = '$id_client'");
   
   $req=$DB->query("SELECT * FROM  commande as C, produit as P, lignecomm as L  WHERE C.id_commande= L.id_commande AND P.id_produit=L.id_produit AND id_client = '$id_client'  AND C.id_commande = '$id_commande'");
   $products=$req->fetchAll(PDO::FETCH_OBJ);
   //var_dump($products); 

   $a=$DB->query("SELECT dateC FROM commande WHERE id_commande = '$id_commande'");
   $b = $a->fetch();
    $dateco=$b['dateC'];
	//echo"$dateco";

   $req=$DB->query("SELECT * FROM  client  WHERE  id_client = '$id_client'");
   $cl=$req->fetch();
   //var_dump($cl);
 //var_dump($table); 
	}
}
//teste de paiement

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="my_orders.css">
    <title>Document</title>
</head>

<body>
<?php require_once("../navbar.php"); ?>

<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>SHopping</div>
            <?php include "../sidebar.php";?>
        </div>
<div class="container">
<div class="row">
    				<!-- BEGIN INVOICE -->
					<div class="col-xs-12">
						<div class="grid invoice">
							<div class="grid-body">
								<div class="invoice-title">
								
									<br>
									<div class="row">
										<div class="col-xs-12">
											<h2>invoice<br>
											<span class="small"></span></h2>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-xs-6">
										<address>
											<strong>Billed To:</strong><br>
											<?php echo  $cl['nomclient']; ?><br>
											<?php echo  $cl['adresse']; ?><br>
											<abbr title="Phone">P: </abbr> <?php echo  $cl['tele']; ?>
										</address>
									</div>
									
								</div>
								<div class="row">
									<!-- <div class="col-xs-6">
										<address>
											<strong>Payment Method:</strong><br>
											<br>
											<?php //echo  $cl['email']; ?>
										</address>
									</div> -->
									<div class="col-xs-6 text-right">
										<address>
											<strong>Order Date:</strong><br>
                                            <?php echo "$dateco"; ?>
										</address>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<h3>ORDER SUMMARY</h3>
										<table class="table table-striped">
											<thead>
												<tr class="line">
													<!-- //<td><strong>#</strong></td> -->
													<td class="text-center"><strong>PRODUIT</strong></td>
                                                    <td class="text-center"><strong>Quantite</strong></td>
													<td class="text-center"><strong>REDUCTION</strong></td>
													<td class="text-right"><strong>PRIX UNITAIRE</strong></td>
													<td class="text-right"><strong>SUBTOTAL</strong></td>
												</tr>
											</thead>
											<tbody>
                                               <?php foreach($products as $product):  ?>
												<tr>
													<!-- <td>1</td> -->
													<td><strong><?php echo $product->designationP; ?></strong><br><?php echo $product->descriptionP; ?></td>
                                                    <td class="text-center"><?php echo $product->quantite; ?></td>
													<td class="text-center"><?php echo $product->reductionligne; ?>%</td>
													<td class="text-center"><?php echo number_format($product->Prix,2,',',''); ?>DH</td>
													<td class="text-right"><?php echo number_format($product->Prix-$product->Prix*$product->reductionligne/100 ,2,',',''); ?></td>
												</tr>
												<?php endforeach; ?>
												
												<tr>
													<td colspan="3">
													</td><td class="text-right"><strong>Total</strong></td>
													<td class="text-right"><strong><?php
                                                                                   $total=0;
                                                                                   $pro =$DB->query("SELECT P.Prix, L.reductionligne, L.quantite FROM  commande as C, produit as P, lignecomm as L  WHERE C.id_commande= L.id_commande AND P.id_produit=L.id_produit AND id_client = '$id_client' AND C.id_commande = '$id_commande' ");
                                                                                   $products = $pro->fetchAll(PDO::FETCH_OBJ);
                                                                                   foreach ($products as $product ){
                                                                                   $total += $product->quantite*( $product->Prix-($product->Prix * $product->reductionligne/100)); }
                                                                                     echo number_format($total,2,',',''); ?>DH </strong></td>
												</tr>
											</tbody>
										</table>
									</div>									
								</div>
								
									
								<div class="row">
								<form action="#" method="post"></form>
									<?php 
										//teste de paiement
										$paye=false;
										$sql1="SELECT * FROM paiement_carte WHERE id_commande=$id_commande";
										$sql2="SELECT * FROM paiement_cheque  WHERE id_commande=$id_commande";
										$sql3="SELECT * FROM paiement_espece  WHERE id_commande=$id_commande";
										$resu1=mysqli_query($dbcon,$sql1);
										$resu2=mysqli_query($dbcon,$sql2);
										$resu3=mysqli_query($dbcon,$sql3);
										if(mysqli_num_rows($resu1) || mysqli_num_rows($resu2) || mysqli_num_rows($resu3) ){
											$paye=true;
											
										}else{
													$paye=false;
										}
										if($paye== true){ ?>
											<div class="alert alert-warning">
												<span style="color: salmon;">cette commande est payee</span>
											</div>
										<?php 
										}
										else{
									?>	
									<p ><strong> Paiement par : </strong></p>
									<ul class="list-group list-group-flush" id="pay" style="list-style: none;">
										<li class="list-group-item d-flex justify-content-between align-items-center px-2">
										<a href="paiement_parCarte.php?idc=<?php echo $id_commande;	?>&tot=<?=$total;?>" class="btn btn-info"> Paiement par carte </a></li>
										<li  class="list-group-item d-flex justify-content-between align-items-center px-2">
										<a href="paiement_parC.php?idc=<?php echo $id_commande; ?>&tot=<?=$total;?>" class="btn btn-success"> Paiement par chèque </a></li>
										<li class="list-group-item d-flex justify-content-between align-items-center px-2">
										<a class="btn btn-warning" href="paiement_parES.php?idc=<?php echo $id_commande; ?>&tot=<?=$total;?>"> Paiement par espece </a></li><li>
										</li>
									</ul>
									<?php } ?>
									</form>
									<div class="col-md-12 text-right identity">
										<p><strong>ILISI SHOP</strong></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END INVOICE -->
				</div><?php 
						$sql="SELECT * FROM paiement_cheque where id_commande=$id_commande";
						$req=mysqli_query($dbcon,$sql);
						if(mysqli_num_rows($req)){//la ommande entree est pas payee par cheque?>
							<div class="container">
								<label for="">Paiement tranches</label><br><br>
								<label for="">Total</label>
										<input type="text" name="" id="" value="<?=$total;?>" disabled> <br>
										<div>
										<table class="table">
											<tr>
												<td>Numero de cheque</td>
												<td>Montant</td>
											</tr>
											<?php while($row=$req->fetch_assoc()){
										?>
											<tr>
												<td><?=$row['id_paiementCH'];?></td>
												<td><?=$row['montant'];?></td>
											</tr> 
											<?php  } ?>
										</table>
										</div>
							</div>
						<?php }
						else{
								$sql="SELECT * FROM paiement_carte where id_commande=$id_commande";
								$req=mysqli_query($dbcon,$sql);
								
								if(mysqli_num_rows($req)){ 
									$row=$req->fetch_assoc()?>
									<label for="">Total</label>
								<input type="text" name="" id="" value="<?=$total;?>" disabled> <br>
								<div>
										<table class="table">
											<tr>
												<td>Numero de carte</td>
												<td>Montant</td>
												<td>type carte</td>
											</tr>
											<tr>
												<td><?=$row['id_paiementCarte'];?></td>
												<td><?=$total;?></td>
												<td><?=$row['type_carte'];?></td>
											</tr> 
											
										</table>
										</div>
								</div>
								<?php }
								else{
									$sql="SELECT * FROM paiement_espece where id_commande=$id_commande";
									$req=mysqli_query($dbcon,$sql);
									if(mysqli_num_rows($req)){ 
										$row=$req->fetch_assoc()?>
										<label for="">Total</label>
								<input type="text" name="" id="" value="<?=$total;?>" disabled> <br>
								<div>
										<table class="table">
											<tr>
												<td>Paiement</td>
												<td>Montant</td>
												
											</tr>
											<tr>
												<td>Espece</td>
												<td><?=$total;?></td>
												
											</tr> 
											
										</table>
										</div>
								</div>
								<?php }}
								
						}
						?>
				<div class="d"></div>
</div>
</div>
<style>
	#pay li a{
		text-decoration: none;
	}
</style>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
</script>
</body>
</html>
<?php require_once "../Footer.php";?>

