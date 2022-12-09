<?php
session_start();
$_SESSION['place']=$_SERVER['REQUEST_URI'];
//l'authentification da l'admine est necessaire
if(!isset($_SESSION['admine'])){
    header("Location:http://localhost/PANIER1/Clients/login.php");
    exit;
}//fin check
//Connexion a la base de données
require_once "../connexion.php";
require_once "../panier/connexion.php";
require_once "../panier/classpanier.php";
$panier=new panier($DB);
$query1="SELECT * FROM categorie";
$resu=mysqli_query($dbcon,$query1);
if(isset($_POST['ajouter'])){
    
    $desi= $_POST["Desi"];
    $desc=  $_POST["Descri"] ;
    //echo $desi." ".$desc;
    $query2="INSERT INTO `categorie`
    (`designationC`, `descriptionC`) 
    VALUES
     ('$desi','$desc')";
    //execution de la requte
    $result1=mysqli_query($dbcon,$query2);
    if(!$result1)
    die("no way");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Categorie</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="./css/style1.css">
    <link rel="stylesheet" href="./css/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
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
        

    <section>
        <form action="#" method="GET" enctype="multipart/form-data" style="float: right; margin:25px">
            <button type="button" name="majout" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Ajouter" >Ajouter</button>
        </form>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Catégories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Designation:</label>
                    <input type="text" name="Desi" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description:</label>
                    <textarea class="form-control" id="message-text" name="Descri"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="ajouter" class="btn btn-primary">Ajouter Categorie</button>
                </div>
            </div>
        </div>
    </div>
    
    </section>
    <div class="d-flex flex-column">
        <?php
            if(isset($_GET['err']))
                echo "<span class='alert alert-danger'>".$_GET['err']."</span><br>";
        ?>
    <table>
        <thead>
        <tr style="background-color: khaki;">
                            
                            <td>Designation</td>
                            <td>Description</td>
                            <td>Supprimer</td>
                            <td>Modifier</td>
                            
                        </tr></thead>
                        <?php
                        
                        while($rows=$resu->fetch_assoc()){
                            ?><tbody>
                                <tr>
                            
                                <td><?=$rows['designationC'];?></td>
                                <td><?=$rows['descriptionC'];?></td>
                                <td><a href="./action.php?idcat=<?=$rows['id_cat'];?>"><button type="button" name="delee" class="btn btn-danger">Delete</button></a></td>
                                <td><a href="./updatecat.php?idcat=<?=$rows['id_cat'];?>"><button type="button" name="modify" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModa2" data-bs-whatever="modifier">Modifier</button></a></td>
                                
                                </tr>
                                </tbody>
                            <?php
                                }
                            ?>
    </table>
    </div>
</div>
<?php require_once "../Footer.php";?>

<style>
      table { 
  width: 100%; 
  border-collapse: collapse; 
}
/* Zebra striping */
tr:nth-of-type(odd) { 
  background: #fff; 
}
th { 
  background: #333; 
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
    /* border: 1px solid #ccc; */
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { 
        border: 1px solid crimson;
       width: fit-content;

      }
	
	td { 
		/* Behave  like a "row" */
		border: 1px solid black;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 60%; 
        width:55vh;
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
	
	td:nth-of-type(1):before { content: "Désignation"; }
	td:nth-of-type(2):before { content: "Description"; }
	td:nth-of-type(3):before { content: "Supprimer"; }
	td:nth-of-type(4):before { content: "Modifier"; }
	
}
    </style>
    
</body>
</html>