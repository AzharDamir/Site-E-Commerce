<?php
session_start();
$_SESSION['place']=$_SERVER['REQUEST_URI'];
if(!isset($_SESSION['admine'])){
    header("location:login.php");
}
require_once "../connexion.php";

$qrt="SELECT * from client ";
$result=mysqli_query($dbcon,$qrt); 

if(isset($_POST['search']))
{
    
    $select=$_POST['filte'];
    $select1=$_POST['valid'];
    if($select == "all" && $select1!="all"){
        $qur="SELECT * from client where etat='$select1'";
    }
    else
    {
        if($select !="all" && $select1 != "all")
          $qur="SELECT * from client where type='$select' AND etat='$select1' ";
        else{
            if($select1 == "all" && $select!="all")
                 $qur="SELECT * from client where type='$select' ";
            else
                 $qur="SELECT * from client ";
        }
    }
    
    $result=mysqli_query($dbcon,$qur);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Afficher</title>
    
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">
    <link rel="stylesheet" href="./css/style1.css">
    <link rel="stylesheet" href="./css/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  
    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
  
    <nav >
    <?php require_once "../navbar.php"; ?>
    </nav>
<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>SHopping</div>
                    <?php include "../sidebar.php"; ?>
        </div>

    <div class="clients" style="margin-left: 95px;">
        <div class="filter" style="padding: 20px;">
            <form action="#" method="POST">
            <label for="filte">Type : </label>
                <select name="filte" id="filt">
                    <option value="all">ALL</option>
                    <option value="A">Administrarteur</option>
                    <option value="C">Client</option>
                </select>
                <label for="valid">Etat : </label>
                <select name="valid" id="filt">
                    <option value="all">ALL</option>
                    <option value="I">Invalid</option>
                    <option value="V">Valide</option>
                </select>
                <input type="submit" name="search" value="search" class="btn btn-info">
            </form>
            <br>
            
        </div>
        <div  id="afficher" style="margin-left: 1
        0px;margin-right: 50px;">
         <table >
             <thead>
            <tr style="background-color: khaki; ">
                <td>Nom</td>
                <td>E mail</td>
                <td>Telephone</td>
                <td>Etat</td>
                <td>Type</td>
                <td>Password</td>
                <td>Adresse</td>
                <td>Date d'inscription</td>
                <td>Supprimer</td>
                <td>Modifier</td>
            </tr>
            </thead>
            <?php
            while($row=$result->fetch_assoc())
            {$hash = password_hash($row['password'], PASSWORD_DEFAULT);
                ?>
                <tbody>
                <tr>
                <td><?=$row['nomclient'];?></td>
                <td><?=$row['email'];?></td>
                <td><?=$row['tele']?></td>
                <td><?=$row['etat'];?></td>
                <td><?=$row['type'];?></td>
                <td ><p style="font-size: 10px;"><?=$hash?></p></td>
                <td><?=$row['adresse'];?></td>
                <td><?=$row['dateinscription'];?></td> 
                <td><a href="../Produits/action.php?idcl=<?=$row['id_client'];?>"><button type="button"  class="btn btn-danger" data-bs-dismiss="modal">DELETE</button></a></td>
                <!-- <td><a href="./updateA.php?idf="><button type="submit" name="modifier" class="btn btn-warning">Update</button></a></td> -->
                <td>
                    <form action="update.php?idp=<?=$row['id_client'];?>" method="post">
                    <?php $id1=$row['id_client'];
                    //  $query1="SELECT * FROM client where id_client=$id1";
                    //         $result1=mysqli_query($dbcon,$query1);
                    //         if($result1)
                    //         $row1=$result1->fetch_assoc();?>
                            <select name="et" id="">

                        <?php if($row['etat']=='I')
                        {?>
                            <option value="I">Invalid</option>
                            <option value="V">Valide</option>
                        <?php
                        } else
                        {?>
                            <option value="V">Valid</option>
                             <option value="I">InValide</option>

                            <?php
                             
                        } 
                        
                        
                        
                        ?>
                            
                        </select>
                         <button name="su" class="btn btn-warning">v</button>   
                      </form>  
                      <?php
                     
                      
                      ?>
                </td>
            </tr></tbody>
                <?php
               
            }
            ?>
          </table>
        </div>
        <br><br>
        <!-- <button class="btn btn-primary" value="botton"><a style="text-decoration:none ; color:#fff;" href="./logout.php">Logout</a></button> -->
    </div>
</div>
    <?php mysqli_close($dbcon);?>
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
  
  /* max-width: 350px; */
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
		padding-left: 40%; 
    width: 50vh;
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
	td:nth-of-type(1):before { content: "Nom"; }
	td:nth-of-type(2):before { content: "E mail"; }
	td:nth-of-type(3):before { content: "Telephone"; }
	td:nth-of-type(4):before { content: "Etat"; }
	td:nth-of-type(5):before { content: "Type"; }
	td:nth-of-type(6):before { content: "Password"; }
    td:nth-of-type(7):before { content: "Adresse"; }
	td:nth-of-type(8):before { content: "Date d'inscription"; }
	td:nth-of-type(9):before { content: "Supprimer"; }
	td:nth-of-type(10):before { content: "Modifier"; }
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