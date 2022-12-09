<?php
    require_once "../connexion.php";

    $sql="SELECT * from ville";
    $resul=mysqli_query($dbcon,$sql);

    if(isset($_POST['sub']))
    {
        $ville=$_POST['ville'];
        $qur="SELECT * FROM ville where nomVille='$ville'";
        $rsr=mysqli_query($dbcon,$qur);
        $row14=$rsr->fetch_assoc();
        $nom=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password1'];
        $type='C';//$_POST['type'];
        $idville=$row14['id_ville'];
        $tel=$_POST['phone'];
        $adresse=$_POST['adresse'];
        //echo "$ville $email $nom $password $type $tel";
        $reqete="INSERT into client (`nomclient`, `email`, `password`, 
       `etat`, `type`,`id_ville` ,`adresse`,`tele`) VALUES 
       ('$nom','$email','$password','I','$type','$idville','$adresse','$tel')";
       $SQL=mysqli_query($dbcon,$reqete);
       header("location:login.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>SHopping</div>
            <?php include "../sidebar.php";?>
        </div>
 
     <div class="container">
        <div class="header">
            <h2>Inscription ILISI</h2>
        </div>
        <!-- le formulaire -->
        <form id="form" class="form" method="POST">
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" name="name" placeholder="your name..." id="username" />
                
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="username">Email</label>
                <input type="email" name="email" placeholder="..@yahoo.fr" id="email" />
                
                <small>Error message</small>
            </div>
			<div class="form-control">
                <label for="username">Adresse</label>
                <input type="text" name="adresse" placeholder="adresse..." id="adresse" />
                
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="ville">Ville</label>
                <select name="ville"class="form-select">
                    <?php while($row=$resul->fetch_assoc()){?>
                        <option value="<?=$row['nomVille'];?>"><?=$row['nomVille'];?></option>
                    <?php }?>
                </select>
                <small>Error message</small>
            </div>
            <!-- <div class="form-control">
                <label for="tye">Ville</label>
                <select name="type"class="form-select" >
                   <option value="A">Administrateur</option>
                   <option value="C">Client</option>
                </select>
                <small>Error message</small>
            </div> -->
            <div class="form-control">
                <label for="username">Telephone</label>
                <input type="text" name="phone" placeholder="your phone..." id="phone" />
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="username">Password</label>
                <input type="password" name="password1" placeholder="Password..." id="password"/>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="username">Password check</label>
                <input type="password" name="password2" placeholder="Password confirm..." id="password2"/>
                
                <small>Error message</small>
            </div>
            <button name="sub" class="but" >Submit</button>
           <a href="http://localhost/PANIER1/index.php"> <button type="button" id="close">Close</button></a>
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
    <script>
		
        var $i=true;
        const form = document.getElementById('form');
		const username = document.getElementById('username');
		const email = document.getElementById('email');
		const password = document.getElementById('password');
		const password2 = document.getElementById('password2');
		const phone= document.getElementById('phone');
		const add=document.getElementById('adresse');
		form.addEventListener('submit', e => {
			/*The preventDefault() method cancels the event if it is "cancelable",
			meaning that the default action that belongs to the event will not occur.
			For example, this can be useful when: Clicking on a "Submit" button, prevent
			it from submitting a form. Clicking on a link, prevent the link from following 
			the URL.*/
			
			
			checkInputs();
            if(! $i)
                e.preventDefault();
            checkInputs();
            return true;

		});

        function checkInputs() {
            // trim to remove the whitespaces
            const usernameValue = username.value.trim();
            const emailValue = email.value.trim();
            const passwordValue = password.value.trim();
            const password2Value = password2.value.trim();
            const phoneValue= phone.value.trim();
            const adresseValue = add.value.trim();
            //patt aide a varifier qu'une chaine de caractere contient des chiffres
            var patt=/\d/;
            var num= "06";
            var yahoo="@yahoo.fr"
            var ll=phoneValue;
            /*.slice prend une partie du string afin de la tester
            et 9 est du a la longueur du chaine "yahoo.fr" et le moin
            correspond a la fin du chaine entrer c a d le teste va 
            etre appliquer sur les 9 dernier caractere*/
            
            if(usernameValue === '') {
                setErrorFor(username, 'le nom ne peut pas etre vide');
                $i=false;
            } else {
                if(patt.test(usernameValue)){
                    setErrorFor(username , 'le nom ne peut pas contenir des chiffres');
                    $i=false;
                }
                else
                    setSuccessFor(username);
            }

            if(adresseValue === ''){
                setErrorFor(add, 'le nom ne peut pas etre vide');
                $i=false;
            } else{
                setSuccessFor(add);
            }

            if(phoneValue === ''){
                setErrorFor(phone,'entrer votre num de telephone');
            } else {
                if( isNaN(phoneValue) || ll.length!=10)
                {
                setErrorFor(phone,'Invalide numero ');
                $i=false;
                }
                else{
                        setSuccessFor(phone);

                }
            }
            
            if(emailValue === '') {
                setErrorFor(email, 'Email ne peut pas etre vide');
                $i=false;
            } else if (!isEmail(emailValue)){// || emailValue.slice(-9)!=yahoo) {
                $i=false;
                setErrorFor(email, 'Email est invalid');
            } else {
                setSuccessFor(email);
            }
            
            if(passwordValue === '') {
                setErrorFor(password, 'Password ne peut pas etre vide');
                $i=false;
            } else {
                setSuccessFor(password);
            }
            
            if(password2Value === '') {
                setErrorFor(password2, 'Password de confirmation est vide');
                $i=false;
            } else if(passwordValue !== password2Value) {
                setErrorFor(password2, 'Passwords ne sont pas les même');
                $i=false;
            } else{
                setSuccessFor(password2);
            }
            if($i){
                alert('valid');
                onsubmit;
            }
                
        }

        function setErrorFor(input, message) {
            const formControl = input.parentElement;
            const small = formControl.querySelector('small');
            formControl.className = 'form-control error';
            small.innerText = message;
        }

        function setSuccessFor(input) {
            const formControl = input.parentElement;
            formControl.className = 'form-control success';
        }
            //le pattern du x 
        function isEmail(email) {
            return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
        }



        var el = document.getElementById("wrapper");
                var toggleButton = document.getElementById("menu-toggle");

                toggleButton.onclick = function () {
                    el.classList.toggle("toggled");
                };



    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>