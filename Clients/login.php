<?php
session_start();
require_once "../connexion.php";
if(isset($_POST['sub']))
{
    $log=$_POST['login'];
    $pass=$_POST['password'];
    if(!empty($log) && !empty($pass))
    {
        $query=("SELECT * FROM `client` WHERE `email` = '$log' AND `password` = '$pass' AND `type`='A' AND `etat`='V'Limit 1");
        $resultat=mysqli_query($dbcon,$query);
        $re=$resultat->fetch_assoc();
        if($re)
             $ida=$re['id_client'];
        if(mysqli_num_rows($resultat)==1)
        {
            if($_SESSION['place'])
            $_SESSION['place']="PANIER1/Produits/CRUDproduits.php";
            $_SESSION['admine']=array("login"=> $log ,"id"=> $ida);
                 header("Location:http://localhost/".$_SESSION['place']);
            
        }
        else
        {
            $query=("SELECT * FROM `client` WHERE `email` = '$log' AND `password` = '$pass' AND `type`='C' Limit 1");
            $resultat=mysqli_query($dbcon,$query);
             $rows1=$resultat->fetch_assoc();
            $resu=mysqli_query($dbcon,"SELECT * FROM `client` WHERE `email` = '$log' AND `password` = '$pass' AND `type`='A' LIMIT 1");
            $rows=$resu->fetch_assoc();
            //var_dump($rows);
            if($rows1){
                
                $idc=$rows1['id_client'];
                $nom=$rows1['nomclient'];
            }
            if(mysqli_num_rows($resultat)==1)
            {
               
                if( $rows1['etat']=='V'){
                     $_SESSION['Client']=array("login"=> $log ,"id"=> $idc,"nom"=>$nom);
                     header("Location:../index.php?client=".$nom);
                }else{
                    header("Location:./login.php?err=Invalid account");
                }
               
            }
            else
            {
                if($rows){
                    echo 'hello';
                    if($rows['etat']=='I')
                          header("Location:./login.php?err=Votre compte est invalid");
                }else
                echo "out";
                     header("Location:./login.php?err=votre mot de passe ou login est incorrect");
            }
             
        }
            
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="../css/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
     rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <title>Login</title>
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
            #photo{
            height: 200px;
            width: 180px;
        }
        #divph{
            height: 380px;
            width: 180px;
        }
        
        }
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
            display: flex;
           /* // align-items: center;
            justify-content: center; */
            min-height: 100vh;
            margin-top: 0;
            margin-left: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 400px;
            max-width: 100%;
        }

        .header {
            border-bottom: 1px solid #f0f0f0;
            background-color: #f7f7f7;
            padding: 20px 40px;
        }

        .header h2 {
            margin: 0;
        }
        .header h2:hover{
            color: rgb(159, 161, 23);
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
        .form-control input {
            border: 2px solid khaki;
            border-radius: 16px;
            display: block;
            font-family: sans-serif;
            font-size: 14px;
            padding: 10px;
            width: 100%;
        }

        .form-control input:focus {
            outline: 0;
            border-color: #777;
        }

        .form-control.success input {
            border-color: #2ecc71;
        }

        .form-control.error input {
            border-color: #e74c3c;
        }



        .form-control.error i.fa-exclamation-circle {
            color: #e74c3c;
            visibility: visible;
        }

        .form-control small {
            color: #e74c3c;
            position: absolute;
            bottom: 0;
            left: 0;
            visibility: hidden;
        }

        .form-control.error small {
            visibility: visible;
        }

        .form button {
            background-color:  rgb(212, 195, 35);
        ;
            border: 2px solid khaki;
            border-radius: 4px;
            color: #fff;
            display: block;
            font-family: inherit;
            font-size: 16px;
            padding: 10px;
            margin-top: 20px;
            width: 100%;
        }
        .click{
            position:fixed;
            top: 0;
            left: 0;
            z-index: 13;
            background-color: transparent;
        }
        #close{
            background-color: grey;
        }
        .error{
            color:#e74c3c;
            align-content: center;
            justify-content: center;
            background-color:gainsboro;
        }
        
    </style>
</head>
<body>
<div class="claa1">
    
    <div class="d-flex" id="wrapper">
    <div class="click">
      <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"> <label id="dashbord" ></label></i>                     
    </div>  
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper" style="z-index: 7;">
        <?php include "../sidebar.php"; ?>
        </div>
 
     <div class="container">
        <div class="header">
            <h2>Authentification</h2>
        </div>
        <div class="error">
        <?php 
            if(isset($_GET['err'])){?>
                <small><label style="color: gainsboro;">00000000</label><?=$_GET['err'];?></small>
            <?php }
        ?>
        </div>
        <!-- le formulaire -->
        <form id="form" class="form" method="POST">
            <div class="form-control">
                <label for="username">Login</label>
                <input type="text" name="login" placeholder="your name..." id="username" />
                
                
            </div>
            
            <div class="form-control">
                <label for="username">Password </label>
                <input type="password" name="password" placeholder="Password ..." id="password2"/>
                
                <small>Error message</small>
            </div>
            <button name="sub" class="but" >Login</button>
           <a href="http://localhost/GestionProduits/index.php"> <button type="button" id="close">Close</button></a>
        </form>
        
     </div>
     
    </div> 
    <?php 
    
    require_once "../Footer.php";
    ?>
    </div>
    <style>
        .footer-distributed{
            margin-top: 0;
        }
       
    </style>
    
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