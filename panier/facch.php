<?php
//la facture correspondante au paiement par cheque
//ouverture de la session
session_start();
//ajout de la page de connexion
require_once "../panier/connexion.php";
//requete
if(isset($_GET['idc'])){
    $id=$_GET['idc'];
    //requete de recuperation des infos sur le paiement
    $sql="SELECT * FROM paiement_cheque where id_commande=$id";
    $req=mysqli_query($dbcon,$sql);
    if(!mysqli_num_rows($req)){//la ommande entree n'est pas payee en cheque
        header("location:http://localhost/PANIER1/panier/ord_his.php");
        exit;
    }
}
$total=$_GET['tot'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap-5.0.2-dist/css/bootstrap.css">
    <title>Document</title>
</head>
<body>
    <?php require_once "../navbar.php"; ?>
    <div class="container">
        <label for="">Total</label>
                <input type="text" name="" id="" value="<?=$total;?>" disabled> <br>
                <div>
                <table class="table">
                    <tr>
                        <td>Cheque number</td>
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
    <?php require_once "../Footer.php"; ?>
</body>
</html>