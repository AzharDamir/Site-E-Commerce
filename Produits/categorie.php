    <?php
session_start();
require_once "../panier/connexion.php";
require_once '../panier/classpanier.php';

$panier = new panier ($dbcon);
require_once "../connexion.php";
//traitement des categorie e les produits de chaque categorie
$query1="SELECT * FROM categorie";
$resu1=mysqli_query($dbcon,$query1);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="../css/bootstrap-5.0.2-dist/css/bootstrap.css">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <title>Categorie</title>
   <style>
    .photo{
        margin: 25px; 
        display:inline; 
        flex-wrap:wrap;
    }
    .photo img{
        width: 300px; height:300px;
    }
    @media screen and (max-width: 800px) {
        .photo img{
            width: 450;
            height: 250;
        }
    }
</style>
</head>
<body>
    <?php require_once "../navbar.php" ?>
    </nav>
<div class="d-flex" id="wrapper">
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>SHopping</div>
            <?php include "../sidebar.php"; ?>
        </div>
<!-- main main -->
<section class="md:h-full flex items-center text-gray-600">
        <div class="container px-5 py-24 mx-auto">
            <div class="text-center mb-12">
                <!-- <h5 class="text-base md:text-lg text-indigo-700 mb-1">See Our Recent News</h5> -->
                <h1 class="text-4xl md:text-6xl text-gray-700 font-semibold" style="margin: 15%;max-width:max-content"><strong>Categories</strong> </h1>
            </div>
            <?php
            
            while($row1=$resu1->fetch_assoc())
            {   $i=0;
                
                $idc=$row1['id_cat'];
                $query2="SELECT * FROM produit where id_categorie='$idc'";
                $resu2=mysqli_query($dbcon,$query2);?>
               <marquee ><div style="display: inline-flex;">
                
                <?php
                 
                while($row2=$resu2->fetch_assoc())
                {
                    $i++;
                    $idp=$row2['id_produit'];
                    $query3="SELECT * FROM photo where id_produit='$idp'";
                    $resu3=mysqli_query($dbcon,$query3);?>
                <marquee ><div class="photo"  >
                    <?php while($row3=$resu3->fetch_assoc()){
                        $path=$row3['photo'];
                    ?>
                    
                        <img src=".<?=$path;?>" alt="" style="">
                     <?php
                    }?>
                </div></marquee>

                     <p><strong><?=$row2['designationP'];?></strong> </p> <br><br>
                <?php
                }
               ?>
               
                
                <?php
                echo "</div> </marquee> ";
                if($i > 0)
                  echo "<p style='color:red; border:2px solid black; display:block;'>" .'categories  :  '. $row1['designationC']."</p>";
                
            }
            ?>
        </div>
</section>
<!-- end of main main -->

</div>

<footer>
<?php require_once "../Footer.php";?>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
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
</body>
</html>