<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="footer, address, phone, icons" />

	<title>Responsive Footer</title>

	<link rel="stylesheet" href="style.css">
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

	<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <style>
        @import url('http://fonts.googleapis.com/css?family=Open+Sans:400,700');

*{
	padding:0;
	margin:0;
}

html{
	background-color: #eaf0f2;
}

body{
	font:16px/1.6 Arial,  sans-serif;
}

header{
	text-align: center;
	padding-top: 100px;
	margin-bottom:190px;
}

header h1{
	font: normal 32px/1.5 'Open Sans', sans-serif;
	color: #3F71AE;
	padding-bottom: 16px;
}

header h2{
	color: #F05283;
}

header span{
	color: #3F71EA;
}


/* The footer is fixed to the bottom of the page */

footer{
	position: fixed;
	bottom: 0;
}

@media (max-height:800px){
	footer { position: static; }
	header { padding-top:30px; }
}


.footer-distributed{
	background-color: #2c292f;
	box-sizing: border-box;
	width: 100%;
	text-align: left;
	font: bold 16px sans-serif;
	padding: 40px 40px 50px 40px;
	margin-top: 90px;
	margin-bottom: 0;
	height: 30%px;
}

.footer-distributed .footer-left,
.footer-distributed .footer-center,
.footer-distributed .footer-right{
	display: inline-block;
	vertical-align: top;
}

/* Footer left */

.footer-distributed .footer-left{
	width: 30%;
}

.footer-distributed h3{
	color:  #ffffff;
	font: normal 36px 'Cookie', cursive;
	margin: 0;
}

/* The company logo */

.footer-distributed .footer-left img{
	width: 30%;
}

.footer-distributed h3 span{
	color:  #e0ac1c;
}

/* Footer links */

.footer-distributed .footer-links{
	color:  #ffffff;
	margin: 20px 0 12px;
}

.footer-distributed .footer-links a{
	display:inline-block;
	line-height: 1.8;
	text-decoration: none;
	color:  inherit;
}

.footer-distributed .footer-company-name{
	color:  #8f9296;
	font-size: 14px;
	font-weight: normal;
	margin: 0;
}

/* Footer Center */

.footer-distributed .footer-center{
	width: 35%;
}


.footer-distributed .footer-center i{
	background-color:  #33383b;
	color: #ffffff;
	font-size: 25px;
	width: 38px;
	height: 38px;
	border-radius: 50%;
	text-align: center;
	line-height: 42px;
	margin: 10px 15px;
	vertical-align: middle;
}

.footer-distributed .footer-center i.fa-envelope{
	font-size: 17px;
	line-height: 38px;
}

.footer-distributed .footer-center p{
	display: inline-block;
	color: #ffffff;
	vertical-align: middle;
	margin:0;
}

.footer-distributed .footer-center p span{
	display:block;
	font-weight: normal;
	font-size:14px;
	line-height:2;
}

.footer-distributed .footer-center p a{
	color:  #e0ac1c;
	text-decoration: none;;
}


/* Footer Right */

.footer-distributed .footer-right{
	width: 30%;
}

.footer-distributed .footer-company-about{
	line-height: 20px;
	color:  #92999f;
	font-size: 13px;
	font-weight: normal;
	margin: 0;
}

.footer-distributed .footer-company-about span{
	display: block;
	color:  #ffffff;
	font-size: 18px;
	font-weight: bold;
	margin-bottom: 20px;
}

.footer-distributed .footer-icons{
	margin-top: 25px;
}

.footer-distributed .footer-icons a{
	display: inline-block;
	width: 35px;
	height: 35px;
	cursor: pointer;
	background-color:  #33383b;
	border-radius: 2px;

	font-size: 20px;
	color: #ffffff;
	text-align: center;
	line-height: 35px;

	margin-right: 3px;
	margin-bottom: 5px;
}

/* Here is the code for Responsive Footer */
/* You can remove below code if you don't want Footer to be responsive */


@media (max-width: 800px) {

	.footer-distributed .footer-left,
	.footer-distributed .footer-right{
		display: block;
		width: 100%;
		margin-bottom: 40px;
		text-align: center;
        max-height: 30%;
	}
	.footer-distributed .footer-center{
		display: block;
		width: 100%;
		margin-bottom: 70px;
		text-align: center;
        max-height: 30%;
	}

	.footer-distributed .footer-center i{
		margin-left: 0;
	}
	.footer-distributed{
		height: 51%;
	}

}
    </style>
</head>
	<body>

		<!-- The content of your page would go here. -->

		<footer class="footer-distributed">

			<div class="footer-left">
          <!-- <img src=""> -->
				<h3>ILISI<span>Gestion</span></h3>

				<p class="footer-links">
					<a href="http://localhost/PANIER1/index.php">Home</a>
					|
					<a href="http://localhost/PANIER1/Produits/categorie.php">Catégories</a>
					|
					<a href="#">About</a>
					|
					<a href="#">Contact</a>
				</p>

				<p class="footer-company-name">© ilisi.1 promo 2020/2023</p>
			</div>

			<div class="footer-center">
				<div>
					<i class="fa fa-map-marker"></i>
					  <p><span>Faculté des Sciences 
                          et Techniques de Mohammedia BP 146 Mohammedia 
                          28806 Maroc . </span>
						Departement Informatique FI:ILISI</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>+212595366362</p>
				</div>
				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="mailto:support@eduonix.com">ilisi.1DM@ilisi.com</a></p>
				</div>
			</div>
			<div class="footer-right">
				<p class="footer-company-about">
					<span>About the application</span>
					Our application offers the managment of rare products and the commands as well as the management of the payment .</p>
				<div class="footer-icons">
					<a href="http://www.facebook.com"><i class="fa fa-facebook"></i></a>
					<a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>
					<a href="http://www.instagram.com"><i class="fa fa-instagram"></i></a>
					<a href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a>
					<a href="http://www.youtube.com"><i class="fa fa-youtube"></i></a>
				</div>
			</div>
		</footer>

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