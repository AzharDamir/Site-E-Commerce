
<?php
//session_start();
?>
<style>
 .topnav {
  overflow: hidden;
  background-color: #333;
  transition: 0.8s;
  justify-content: space-between;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}


.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color:#e0ac1c;/*cicicicic*/
  color: white;
  font: normal 36px 'Cookie', cursive;
}
.topnav a.active:hover {
  background-color:#ffba00;
}
.topnav .icon {
  display: none;
}
/* .produit{margin-left: 450px;} */
#dashbord{
    color: #e0ac1c;
    cursor: pointer;
}
#dashbord:hover{
    color: #ffba00;
}
#search{
    outline: none;
    border: 0;
    border-radius: 32px;
    margin-top: 15px;
    margin-left: 25px;
    height: 37px;
}
@media screen and (max-width: 800px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 800px) {
  .topnav.responsive {position: relative;
                      transition: 0.5s;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
@media screen and (max-width: 800px){
  table{

    position: relative;
    float: right;
  }
  table tr{
    max-width:fit-content;
  }
  
}

</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
  rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<nav >
    <div class="topnav" id="myTopnav">
         <a class="active" href="http://localhost/PANIER1/index.php">ILISIGestion</a>
       <div class="produit">
  
        <a href="#" hidden></a>
        <a href="http://localhost/PANIER1/index.php" id="produit" >Produit</a>
        <?php if(isset($_SESSION['Client'])){?>
        <a href="http://localhost/PANIER1/panier/panier.php">Panier</a>
        <?php }?>
        <a href="http://localhost/PANIER1/Produits/categorie.php">Categories</a>
        <a href="#">About</a>
        <a style="cursor:pointer;" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        </a>
       <!-- <input type="text" placeholder="search..." id="search"> -->
       </div> 
     </div>
     <div id="dash">
      <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"> <label id="dashbord">DashBord</label></i>
                      
    </div>        
</nav>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
