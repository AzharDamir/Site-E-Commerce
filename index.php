<?php
session_start();
$_SESSION['place']=1;
// require_once "./connexion.php" ;
require_once "./panier/connexion.php";
require_once './panier/classpanier.php';

$panier = new panier ($dbcon);
$query_cat="SELECT * FROM categorie ";
$resu_cat=mysqli_query($dbcon,$query_cat);
$rows=mysqli_query($dbcon,"SELECT * from produit where id_produit=9")->fetch_assoc();
//trying to show all the product in my database
$qry="SELECT * FROM produit";
$res=mysqli_query($dbcon,$qry);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style1.css">
    <link rel="stylesheet" href="./css/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  
    <!-- <link rel="stylesheet" href="styles.css" /> -->
    <title>Home Page</title>
    <style>
        #logout{
            color: white;
            cursor:none;
        }
        #photo{
            height: 350px;
            width: 250px;
        }
        #divph{
            min-height: 300px;
            width: 350px;
        }
        @media screen and (max-width: 800px){
            #photo{
            height: 200px;
            width: 180px;
        }
        #divph{
            height: 380px;
            width: 180px;
        }
        body{
            margin-left:15px;
            
        }

        }
    </style>
</head>
<body>
<nav>
<?php require_once "./navbar.php";?>
</nav>
<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>SHopping</div>
            <?php include "./sidebar.php";?>
        </div>

<section class="md:h-full flex items-center text-gray-700" style="margin-left: 17px;">
        <div class="container px-3 py-1 mx-auto">
            <div class="text-center mb-10">
                <!-- <h5 class="text-base md:text-lg text-indigo-700 mb-1">See Our Recent News</h5> -->
                <h3 class="text-2xl md:text-4xl text-gray-700 font-semibold">Welecom To The Ilisi Shop <?php if(isset($_SESSION['Client'])){
                    echo "<u>".$_SESSION['Client']['nom']."</u>";
                }elseif(isset($_GET['Iclient'])){
                    echo "<u>".$_GET['Iclient']."</u>";
                } ?></h3>
            </div>
            <div class="flex flex-wrap -m-2">
                <?php
                
                while($row=$res->fetch_assoc()){
                    $idp=$row['id_produit'];
                    $qry_photo="SELECT * FROM photo where id_produit='$idp'";
                    $rsu_photo=mysqli_query($dbcon,$qry_photo);
                    $rw_ph=$rsu_photo->fetch_assoc();
                    if($rw_ph)
                     $path=$rw_ph['photo'];
                    $reduc=$row['reduction'];
                ?>
                <div class="p-4 sm:w-1/3 lg:w-1/4">
                    <div class="h-full border-2 border-gray-400 border-opacity-60 rounded-lg overflow-hidden" >
                        <?php if($reduc > 0 )
                                {?>
                        <span style="height:22px;width=50px;background-color:khaki;color:black; display:block">Sold :<?=$row['reduction'];?>% </span>
                        <?php }
                        if($rw_ph){?>

                       <a href="./Produits/photos.php?idpp=<?=$idp;?>&ind=<?=$idp;?>"> <img class="img-fluid w-100"
                            src="<?=$path;?>" alt="<?=$path;?>" id="photo" style="cursor:pointer;" ></a> <?php } ?>
                        <div class="p-6 hover:bg-indigo-600 hover:text-white transition duration-300 ease-in"id="divph" >
                            <h2 class="text-base font-medium text-indigo-300 mb-1"><?=$row['designationP'];?></h2>
                            <?php $prix=$row['Prix'];
                                
                                if($reduc > 0 )
                                {
                                    $prix=$prix*(1-($reduc/100));
                                    ?>
                                     <h1 class="text-2xl font-semibold mb-3" style="color:red;"><strike><?=$row['Prix'];?></strike>DH</h1>
                                <?php
                                }
                            ?>
                             <h1 class="text-2xl font-semibold mb-3"><?=$prix;?>DH</h1>
                            <p style="max-width: 150px;" class="leading-relaxed mb-2"><?=$row['descriptionP'] ;?></p>
                            <div class="flex items-center flex-wrap " >
                                <a href="./panier/addpanier.php?id=<?=$idp;?>" class="text-indigo-300 inline-flex items-center md:mb-2 lg:mb-0" style="text-decoration: none; color:burlywood ;margin-right:9px; height:fit-content"><button class="btn btn-warning">buy</button> </a>
                                <!-- <a class="text-indigo-300 inline-flex items-center md:mb-2 lg:mb-0" style="text-decoration: none; color:burlywood"><button class="btn btn-info">favorite</button> </a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
</section>
</div>
<!-- end of main page -->
<footer>
<?php require_once "./Footer.php";?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>
</html>