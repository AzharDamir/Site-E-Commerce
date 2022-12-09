<?php
 require_once "../connexion.php";

 if(isset($_GET['idpd'])){
    $id=$_GET['idpd'];
    $qqh="DELETE FROM `photo` WHERE id_produit=$id";
    $qqqr=mysqli_query($dbcon,$qqh);
   $query="DELETE FROM `produit` WHERE id_produit=$id";
   $result=mysqli_query($dbcon,$query);
   if(!$result){
    header("Location:http://localhost/PANIER1/Produits/CRUDproduits.php?err=le produit fait partie d'une ou plusieurs commande");
   }else
    header("Location:http://localhost/PANIER1/Produits/CRUDproduits.php?i=$id");
 }
 if(isset($_GET['idcat'])){
  $id=$_GET['idcat'];
  $qqh="DELETE FROM `categorie` WHERE id_cat=$id";
  $qqqr=mysqli_query($dbcon,$qqh);
 if(!$qqqr)
      header("Location:http://localhost/PANIER1/Produits/CRUDcategorie.php?err=cette categorie corresponde à un ou plusieurs produits il faut les supprimer avant");
  else
      header("Location:http://localhost/PANIER1/Produits/CRUDcategorie.php?");
}
 if(isset($_GET['idcl'])){
  $id=$_GET['idcl'];
  $comsql="SELECT * from commande where id_client=$id";
  $reqcom=mysqli_query($dbcon,$comsql);
  while($rwcom=$reqcom->fetch_assoc()){
  
  $idcommande=$rwcom['id_commande'];

  $lgcomsql="DELETE FROM lignecomm where id_commande=$idcommande";
  $reqlgc=mysqli_query($dbcon,$lgcomsql);
}
  $lgcomsql="DELETE FROM commande where id_client=$id";
  $reqlgc=mysqli_query($dbcon,$lgcomsql);

 $query="DELETE FROM `client` WHERE id_client=$id";
 $result=mysqli_query($dbcon,$query);
 header("Location:http://localhost/PANIER1/Clients/afficher.php");
}

//  if(isset($_POST['modify'])){

    if(isset($_GET['idpu'])){
      $idpu=$_GET['idpu'];
      echo $idpu;
    //anciennes valeur;
    $que="SELECT * FROM produit where id_produit='$idpu'";
    $sqlrsl=mysqli_query($dbcon,$que);
    $ligne=$sqlrsl->fetch_assoc();
    //traitement
    if(isset($_POST['modifieru'])){
      $ref= $_POST["refu"];
      $desi= $_POST["desiu"];
      $desc=  $_POST["descu"] ;
      $prix=$_POST["prixu"] ;
      $cat =$_POST["catu"];
      $redu= $_POST["reductionu"] ;
      //echo "$ref $desi $desc $prix $cat $redu 55";
      //query1 trouver l'id du categorie
      
      //insertion des informations dans la base de donnees
      if($cat != ""){
          echo "cat";
          //recherche de la categorie 
          $query1="SELECT * FROM categorie WHERE `designationC`='$cat'";
          //execution de la requete
          $result1=mysqli_query($dbcon,$query1);
          $row1=$result1->fetch_assoc();
          $idcat=$row1['id_cat'];
          if($redu == ""){
              echo " no redu";
            $sql="UPDATE `produit` SET `Referrence`='$ref',`designationP`='$desi',
          `descriptionP`='$desc',`Prix`='$prix',
          `id_categorie`='$idcat' WHERE id_produit=$idpu";
          }else
              $sql="UPDATE `produit` SET `Referrence`='$ref',`designationP`='$desi',
              `descriptionP`='$desc',`Prix`='$prix',
              `reduction`='$redu',`id_categorie`='$idcat' WHERE id_produit=$idpu";
    }else
    {
        echo "no cat ";
      //execution de la modification sans faire entrainer la categorie
            if($redu!= ""){
                  $sql="UPDATE `produit` SET `Referrence`='$ref',`designationP`='$desi',
                `descriptionP`='$desc',`Prix`='$prix',
                `reduction`='$redu' WHERE id_produit=$idpu";
            }
            else
                {
                    echo "no redu ";
                    $sql="UPDATE `produit` SET `Referrence`='$ref',`designationP`='$desi',
                `descriptionP`='$desc',`Prix`='$prix'
                 WHERE id_produit=$idpu";
                }
               
        
    }
    //echo $sql;
    $resultat12=mysqli_query($dbcon,$sql);
    if(!$resultat12)
        echo "choha";
    header("Location:http://localhost/PANIER1/Produits/CRUDproduits.php");
    }
    }else
        die("prrb primary key");
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="./css/style1.css">
    <link rel="stylesheet" href="./css/bootstrap-5.0.2-dist/css/bootstrap.css">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
           @import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
            @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,500&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            background-color: khaki;
            background-image: linear-gradient(rgba(0,0,0,0.15),rgba(0,0,0,0.25))
            url("../images/salon.jpg");
            font-family: 'Open Sans', sans-serif;
             /* align-items: center; */
            /* justify-content: center;  */
            min-height: 100vh; 
            margin-top: 0;
            margin-left: 0;
            display:table;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 400px;
            max-width: 100%;
            margin-left: 25%;
            margin-bottom: 0;
        }
        .form {
	     padding: 30px 40px;	
        }

        .form-control {
            margin-bottom: 10px;
            padding-bottom: 20px;
            position: relative;
        }
        .form-control label {
            display: inline-block;
            margin-bottom: 5px;

        }
        .form-control label:hover{
            color: rgb(159, 161, 23);
        }
        .form-control input,textarea {
            border: 2px solid khaki;
            border-radius: 16px;
            display: block;
            font-family: sans-serif;
            font-size: 14px;
            padding: 10px;
            width: 100%;
        }
        .form button {
            background-color:  rgb(212, 195, 35);
            border: 2px solid khaki;
            border-radius: 4px;
            color: #fff;
            /* //display: block; */
            font-family: inherit;
            font-size: 16px;
            padding: 10px;
            margin-top: 20px;
            width: 100%;
            
        }
        #description{
            height: 35px;

        }
    </style>
</head>
<body>
     <div class="container">
     <div class="header">
            <h2>Modifier produit</h2>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data" class="form"><br>
          <div class="form-control">
            <label for="refu" class="form-label">Referrence:</label>
            <input type="text" class="" name="refu" id="refu" value="<?=$ligne['Referrence'];?>">
          </div>
          <br>
          <div class="form-control">
            <label for="descu" class="form-label">Designation:</label>
            <input type="text" class="" id="desiu" name="desiu" value="<?=$ligne['designationP'];?>">
          </div><br>
          <div class="form-control">
            <label for="descu" class="form-label">Description:</label>
            <input class="description" id="descu" name="descu" value="<?=$ligne['descriptionP'];?>" >
          </div><br>
          <div class="form-control">
            <label for="prixu" class="form-label">Prix:</label>
            <input type="text" class="" id="prixu" name="prixu" value="<?=$ligne['Prix'];?>">
          </div><br>
          <div class="form-control">
            <label for="catu" class="form-label">Categorie:</label>
            <select name="catu" id="catu" name="catu">
              <option value="">make achoice</option>
                <?php
                $quryc="SELECT * FROM categorie";
                $resuc=mysqli_query($dbcon,$quryc);
                 while($rowc=$resuc->fetch_assoc()){?>
                        <option value="<?=$rowc['designationC'];?>"><?=$rowc['designationC'];?></option>
                <?php }?>
            </select>
          </div><br>
          <div class="form-control">
            <label for="reduction" class="form-label">Reduction:</label>
            <select name="reductionu" id="reduction">
              <option value="">make a choice</option>
                <option value="0">0%</option>
                <option value="5">5%</option>
                <option value="10">10%</option>
                <option value="15">15%</option>
                <option value="20">20%</option>
                <option value="25">25%</option>
                <option value="30">30%</option>
                <option value="35">35%</option>
                <option value="40">40%</option>
                <option value="45">45%</option>
                <option value="50">50%</option>
                <option value="55">55%</option>
                <option value="60">60%</option>
                <option value="65">65%</option>
                <option value="70">70%</option>
                <option value="75">75%</option>
                <option value="80">80%</option>
                <option value="85">85%</option>
                <option value="90">90%</option>
                <option value="95">95%</option>
                <option value="100">100%</option>
            </select>
          </div><br>
          <!-- <div class="form-control"> -->
          <a href="http://localhost/PANIER1/Produits/CRUDproduits.php"style="text-decoration:none; color:white;"> <button type="button" class="btn btn-secondary" >Close</button></a>
            <button type="submit" name="modifieru">Modifier</button>
         <!-- </div><br> -->
        </form>
       
        </div>
      <?php require_once "../Footer.php" ?> 
      <style>
          .footer-distributed{
              margin-top: 0;
          } 
      </style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>