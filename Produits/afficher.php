<?php
//connexion a la base de donnees
require_once "../connexion.php";
$query="SELECT * from produit";
$result=mysqli_query($dbcon,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap-5.0.2-dist/css/bootstrap.css">
    <!-- <style>
    .listerPr{
    margin: 100px;
}
table ,tr,td{
    border-collapse: collapse; 
    border: 1px solid black;
    min-width: 100px;
}
#trcat{
    background-color: teal;
}
td a{
    text-decoration: none;
    color: chocolate;
}
.pro table tr:nth-child(even){
	background-color:#fefefe98;
}</style> -->
    <title>Document</title>
</head>
<body>

    <nav >
          <?php require_once "../navbar.php" ?> 
    </nav>
    <div class="listerPr">
    
        <div class="table-responsive">
            <table class="table align-middle">
                <tr style="background-color: teal;" >
                    <td>Référence</td>
                    <td>Designation</td>
                    <td>Description</td>
                    <td>Prix Unitaire(DH)</td>
                    <td>Reduction(%)</td>
                    <td>Categorie</td>
                    <td>Supprimer</td>
                    <td>Modifier</td>
                    <td>photos</td>
                </tr>
                <?php while($rows=$result->fetch_assoc()){
                    ?>
                        <tr>
                        <td><?=$rows['id_produit'];?></td>
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
                        <td><button class="btn btn-primary">Supprimer</button></td>
                        <td><button class="btn btn-success">Modifier</button></td>
                        <?php

                        ?>
                        <td><button class="btn btn-warning">Photos</button></td>
                        </tr>
                    <?php
                }
               ?>
            </table>

        </div>
    </div>
</body>
</html>