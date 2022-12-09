<?php
session_start();
$_SESSION['place']=$_SERVER['REQUEST_URI'];

$_SESSION['photo']=$_SERVER['REQUEST_URI'];
if(! isset($_SESSION['admine']))
{
  header("location:http://localhost/PANIER1/Clients/login.php");
}
//connexion a la base de donnees
require_once "../connexion.php";
// Les requete necessaire pour l'ajout
$qury1="SELECT * FROM categorie";
$resu1=mysqli_query($dbcon,$qury1);
//ajout d'un produit
if(isset($_POST['ajouter'])){
  $ref= $_POST["ref"];
  $desi= $_POST["Desi"];
  $desc=  $_POST["Descri"] ;
  $prix=$_POST["prix"] ;
  $cat =$_POST["categorie"];
  $redu= $_POST["redu"] ;
  //query1 trouver l'id du categorie
  $query1="SELECT * FROM categorie WHERE `designationC`='$cat'";
  //execution de la requte
  $result1=mysqli_query($dbcon,$query1);
  $row1=$resu1->fetch_assoc();
  $idcat=$row1['id_cat'];
  //insertion des informations dans la base de donnees
  $query2="INSERT INTO `produit`
  ( `Referrence`, `designationP`, `descriptionP`, `Prix`, `reduction`,`id_categorie`) 
  VALUES
   ('$ref','$desi','$desc','$prix','$redu','$idcat')";
  $result2=mysqli_query($dbcon,$query2);
  if(!$result2)
    die("no way");
  /////////////////////////////////
  if(!$_FILES['file']){
    //die("prb in images");
   var_dump($_POST['file']);
  }
  else
    echo 'good';
  $idd=mysqli_query($dbcon,"SELECT * FROM produit where  Referrence='$ref'");
 $idp=$idd->fetch_assoc();
 $pro=$idp['id_produit'];
  $file=$_FILES['file'];
  for($i=0 ; $i < count($file['name']) ; $i++ )
  {
  $filename=$_FILES['file']['name'][$i];
  $filetmp=$_FILES['file']['tmp_name'][$i];
  $filesize=$_FILES['file']['size'][$i];
  $fileError=$_FILES['file']['error'][$i];
  $fileType=$_FILES['file']['type'][$i];
 
  //extention
  $fileExt=explode('.', $filename);
  $fileActualExt= strtolower(end($fileExt));
 
  $allow =array('jpg','jpeg','png','jfif');
 
  if(in_array($fileActualExt,$allow)){
 
      if($fileError === 0){
 
          if($filesize < 1000000 ){
              $filenewname=uniqid('', true).".".$fileActualExt;
              $filedestination='../images/'.$filenewname;
              $pat='./images/'.$filenewname;
              move_uploaded_file($filetmp, $filedestination);
              //uploading the image to the local server
              $query="INSERT INTO `photo` (`photo`,`id_produit`) VALUES ('$pat','$pro')";
              $resulut=mysqli_query($dbcon,$query);  
              // end of uploading
          }
          else{
              echo "your file is too big";
          }
 
      }else
      {
          echo "There is an error uploading your file";
      }
 
  }
  else{
      echo "You can't upload files of this type";
  }

}

/////////////////////////

  //header('Location:http://localhost/PANIER1/Produits/CRUDproduits.php');

}
    $quer="SELECT * from produit";
    $resul=mysqli_query($dbcon,$quer);

if(isset($_POST['search']))
{
    
    $select=$_POST['filte'];
    
               
    if($select == "all" ){
        $quer="SELECT * from produit";
    }
    else
    {
      $cher="SELECT *from categorie where designationC='$select'";
      $recherch=mysqli_query($dbcon,$cher);
      $rw15=$recherch->fetch_assoc();
      $idcategorie=$rw15['id_cat'];
      $quer="SELECT * from produit where id_categorie=$idcategorie";
    }
    
    $resul=mysqli_query($dbcon,$quer);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="./css/style1.css">
    <link rel="stylesheet" href="./css/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    
  
    <!-- <link rel="stylesheet" href="styles.css" /> -->
    <title>Produits admin</title>
    <style>
      
        #logout{
            color: white;
            cursor:none;
        }
        #photo{
            height: 450px;
            width: 350px;
        }
        #divph{
            height: 450px;
            width: 350px;
        }
        @media screen and (max-width: 800px){
         
        body{
            margin-left:15px;
        }
        }
    </style>
    
</head>
<body>
  <?php require_once "../navbar.php" ?>
 
  <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>SHopping</div>
                    <?php include "../sidebar.php"; ?>
            </div>
        <!-- </div> -->
       
        <div class="filter" style="padding: 20px;">
            <form action="#" method="POST">
            <label for="filte">Categorie : </label>
                <select name="filte" id="filt">
                  <option value="all">All</option>
                    <?php
                      $categ="SELECT * FROM categorie";
                      $recat=mysqli_query($dbcon,$categ);
                      while($row14=$recat->fetch_assoc()){?>

                        <option value="<?=$row14['designationC'];?>"><?=$row14['designationC'];?></option>
                        <?php
                      }
                    
                    ?>
                </select>
                
                <input type="submit" name="search" value="search" class="btn btn-info">
            </form>
            <br>
            
        </div>
        

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Produits</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-ref" class="col-form-label">Refference:</label>
            <input type="text" name="ref" class="form-control" id="recipient-ref">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Designation:</label>
            <input type="text" name="Desi" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" id="message-text" name="Descri"></textarea>
          </div>
          <div class="mb-3">
            <label for="message-prix" class="col-form-label">Prix:</label>
            <input type="number" name="prix" class="form-control" id="message-prix" ></textarea>
          </div>
          <div class="mb-3">
            <label for="message-categorie" class="col-form-label">Categorie:</label>
            <select name="categorie" id="message-categorie">
                <?php while($row1=$resu1->fetch_assoc()){?>
                        <option value="<?=$row1['designationC'];?>"><?=$row1['designationC'];?></option>
                <?php }?>
            </select>
          </div>
          <div class="mb-3">
            <label for="message-reduction" class="col-form-label">Reduction:</label>
            <select name="redu" id="message-reduction">
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
          </div>
          <div class="mb-3">
          <label for="formFileMultiple" class="form-label">Photos</label>
          <input  type="file" name="file[]" multiple="multiple" >
          </div>
          <div class="modal-footer">
            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="ajouter" class="btn btn-primary">Ajouter Produit</button>
         </div>
        </form>
      </div>
      
    </div>
  </div>

</div>

<!-- <div > -->
<table>
  <thead>
<tr style="background-color: khaki;">
                    <td>Référence</td>
                    <td>Designation</td>
                    <td>Description</td>
                    <td>Prix Unitaire(DH)</td>
                    <td>Reduction(%)</td>
                    <td>Categorie</td>
                    <td>Supprimer</td>
                    <td>Modifier</td>
                    <td>photos</td>
                </tr></thead>
                <?php
                
                 while($rows=$resul->fetch_assoc()){
                    ?><tbody>
                        <tr>
                        <td><?=$rows['Referrence'];?></td>
                        <td><?=$rows['designationP'];?></td>
                        <td><?=$rows['descriptionP'];?></td>
                        <td><?=$rows['Prix'];?></td>
                        <td><?=$rows['reduction'];?></td>
                        <?php
                            $idc=$rows['id_categorie'];
                            $sql="SELECT * FROM categorie where id_cat=$idc ";
                            $rst=mysqli_query($dbcon,$sql);
                            $cat=$rst->fetch_assoc();
                         ?>
                      
                        <td><?=$cat['designationC'];?></td>
                      <form action="#" method="Post">
                        <td><a href="./action.php?idpd=<?=$rows['id_produit'];?>"><button type="button" name="delee" class="btn btn-danger">Delete</button></a></td>
                        <td><a href="./action.php?idpu=<?=$rows['id_produit'];?>"><button type="button" name="modify" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModa2" data-bs-whatever="modifier">Modifier</button></a></td>
                        <?php

                        ?>
                        <td><a class="btn btn-success" href="./photos.php?idpp=<?=$rows['id_produit'];?>">Photos </a></td>
                        </tr>
                        </tbody>
                      </form>
                    <?php
                }
               ?>
</table>
        <?php
            if(isset($_GET['err']))
                echo "<span class='alert alert-danger'>".$_GET['err']."</span><br>";
        ?>
<!-- </div> -->
<div style="display: flex; justify-content:right">
          <form action="#" method="GET" enctype="multipart/form-data" style="float: right; margin:25px">
            <button type="button" name="majout" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Ajouter" >Ajouter</button>
          </form>
        </div>
</div>
<?php require_once "../Footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
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
    <style>
      table { 
  width: 100%; 
  border-collapse: collapse; 
}


/* tr:nth-child(odd) { 
  background:grey; 
} */
tr:nth-child(even) { 
  background:white; 
}

th { 
  background-color: aliceblue; 
  color: white; 
  font-weight: bold; 
}
td, th { 
  padding: 6px; 
  border: 1px solid #ccc; 
  text-align: left; 
}
@media screen and (max-width: 800px) {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
    border: 1px solid #ccc;
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid crimson;
       width: 100%;

      }
	
	td { 
		/* Behave  like a "row" */
		border: 1px solid black;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 60%; 
    width: 100%;
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 100%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
	*/
	td:nth-of-type(1):before { content: "Référence"; }
	td:nth-of-type(2):before { content: "Désignation"; }
	td:nth-of-type(3):before { content: "Description"; }
	td:nth-of-type(4):before { content: "Prix Unitaire"; }
	td:nth-of-type(5):before { content: "reduction %"; }
	td:nth-of-type(6):before { content: "Categorie"; }
	td:nth-of-type(7):before { content: "Supprimer"; }
	td:nth-of-type(8):before { content: "Modifier"; }
	td:nth-of-type(9):before { content: "Phots"; }
}
    </style>
</body>
</html>
