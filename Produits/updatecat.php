<?php

session_start();
//Connexion a la base de données
require_once "../connexion.php";
require_once "../panier/connexion.php";

if(!isset($_SESSION['admine'])){
    header("Location:http://localhost/PANIER1/Clients/login.php");
    exit;
}
$idpu=$_GET['idcat'];
$que="SELECT * FROM categorie where id_cat='$idpu'";
    $sqlrsl=mysqli_query($dbcon,$que);
    $ligne=$sqlrsl->fetch_assoc();



    if(isset($_POST['modifieru'])){
        $desi= $_POST["desiu"];
        $desc=  $_POST["descu"] ;
        
        
        //insertion des informations dans la base de donnees
        
         $sql="UPDATE `categorie` SET `designationC`='$desi',
                  `descriptionC`='$desc' WHERE id_cat=$idpu";
      $resultat12=mysqli_query($dbcon,$sql);
      header("location:./updatecat.php?idcat=$idpu");
    }

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
            <h2>Modifier Catégorie</h2>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data" class="form"><br>
          <div class="form-control">
            <label for="descu" class="form-label">Designation:</label>
            <input type="text" class="" id="desiu" name="desiu" value="<?=$ligne['designationC'];?>">
          </div><br>
          <div class="form-control">
            <label for="descu" class="form-label">Description:</label>
            <input class="description" id="descu" name="descu" value="<?=$ligne['descriptionC'];?>" >
          </div><br>
          <!-- <div class="form-control"> -->
          <a href="http://localhost/PANIER1/Produits/CRUDcategorie.php"style="text-decoration:none; color:white;"> <button type="button" class="btn btn-secondary" >Close</button></a>
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