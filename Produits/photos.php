<?php
session_start();
require_once "../connexion.php";
$id=$_GET['idpp'];
$query="SELECT * FROM photo where id_produit=$id";
$resultat=mysqli_query($dbcon,$query);
if(!$resultat)
    echo "smt";
    $query11="SELECT * FROM produit where id_produit=$id";
    $resultat11=mysqli_query($dbcon,$query11);
    $row=$resultat11->fetch_assoc()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/bootstrap-5.0.2-dist/css/bootstrap.css">
    <title>Document</title>
    <style>
        .mySlides {display:none;
width: 300px;
}


.w3-content {
    max-width: 301px;
}
#dash{
  visibility: hidden;
}

    </style>
    
    <link rel="stylesheet" href="./css/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <?php require_once "../navbar.php"; 
    if(isset($_SESSION['photo']))
        $url=$_SESSION['photo'];
    else
    $url="../index.php";
    ?>
<div style="display: flex; max-width:fit-content;margin-left:15%;">

    <div class="w3-content w3-display-container">
        <?php while($rows=$resultat->fetch_assoc()){?>
              <div class="mySlides">
                  <img src=".<?=$rows['photo'];?>" alt="prb" style="width: 300px; height=300px;">
              </div>  

        <?php
        }?>
        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
    </div>
    <a href="<?=$url;?>" id="small"><button class="btn btn-info">retour</button></a>
    <?php
    if(isset($_GET['ind'])){?>
    <div class="infopro">
    <div class="p-6 hover:bg-indigo-700 hover:text-white transition duration-300 ease-in"id="divph" >
                            <h2 class="text-base font-medium text-indigo-300 mb-1"><?=$row['designationP'];?></h2>
                            <?php $prix=$row['Prix'];
                            $reduc=$row['reduction'];
                                
                                if($reduc > 0 )
                                {
                                    $prix=$prix*(1-($reduc/100));
                                    ?>
                                     <h1 class="text-2xl font-semibold mb-3" style="color:red;"><strike><?=$row['Prix'];?></strike>DH</h1>
                                <?php
                                }
                            ?>
                             <h1 class="text-2xl font-semibold mb-3"><?=$prix;?>DH</h1>
                            <p class="leading-relaxed mb-3"><?=$row['descriptionP'] ;?></p>
                            <div class="flex items-center flex-wrap " >
                                <a href="http://localhost/PANIER1/panier/addpanier.php?id=<?=$row['id_produit'];?>" class="text-indigo-300 inline-flex items-center md:mb-2 lg:mb-0" style="text-decoration: none; color:burlywood ;margin-right:9px;"><button class="btn btn-warning">buy</button> </a>
                             </div>
                        </div>
                        
    </div>
    <!-- <a href=""><button class="btn btn-info">retour</button></a> -->

<style>
.infopro{
  justify-content: center;
  align-content: center;
  padding: 15px;
  /* margin-left: 25%;
  margin-right: 25%; */
}
#small{
  visibility: hidden;
}
</style>



    <?php }
    ?>
    </div>
    <?php require_once "../Footer.php"; ?>
    <script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>
<style>
  #menu-toggle{
  color: white;
  cursor:none;
}
i label #dashbord{
  color: #fff;
  cursor:none;
}
</style>
</body>
</html>
