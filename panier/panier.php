<?php

//require 'ajouterbase.php';
require './connexion.php';
require 'classpanier.php';
session_start();

$panier = new panier ($DB);
?>
<?php 
if (!isset($_SESSION['Client']))
{ 
  header("location:../Clients/login.php");
}else
{

$client=$_SESSION['Client']['id'];

$ids = array_keys($_SESSION['panier']);
if(empty($ids)){
    $products = array();
}else{
    $req = $DB->query('SELECT * FROM produit WHERE id_produit IN ('.implode(',',$ids).')');
    $products=$req->fetchAll(PDO::FETCH_OBJ);
}
 

}
?>
<?php 
if(isset($_GET['del'])){
    $panier->del($_GET['del']);
    header("location:panier.php");
}

?>

<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Font Awesome -->
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
    />
<!-- Google Fonts -->
    <link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
    />
<!-- MDB -->
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
    />

</head>
<body>
<?php require_once "../navbar.php";?>
<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>SHopping</div>
                    <?php include "../sidebar.php"; ?>
        </div>

<div>
<form action="panier.php" method="post">
<section class="h-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">cart-<span><?php echo $panier->count(); ?></span> items </h5>  
          </div>
          <div class="card-body">
                    <?php
                         foreach($products as $product):
                           // var_dump("$product");
                    ?>
                
            <!-- Single item -->
            <div class="row">
              <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                  <?php 
                    $pic=$DB->query("SELECT * FROM photo WHERE id_produit = '$product->id_produit'" );
                    $idp=$product->id_produit;
                    //echo $idp;
                    $images=$pic->FetchAll(PDO::FETCH_OBJ);
                    //var_dump($images);
                    
                    
                
                    foreach($images as $img)
                    
                  ?>
                  <img class="img-fluid w-100" src=".<?=$img->photo; ?>"
                    alt="Sample">
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                  </a>
                </div>
              </div>
                
                <!-- Data -->
              
                 <div class="col-md-7 col-lg-9 col-xl-9">
                   <div>
                        <div class="d-flex justify-content-between">
                           <div>
                            <h5><?php echo $product->designationP; ?></h5>
                            <?php
                              $sql="SELECT * FROM categorie where id_cat=$product->id_categorie";
                              $res=mysqli_query($dbcon,$sql);
                              
                              $rwcat=$res->fetch_assoc();
                            ?>
                            <p class="mb-3 text-muted text-uppercase small"><?=$rwcat['designationC']; ?></p>
                           </div>
                           <div>
                              <div class="form-outline">
                               <span class="quantity">Quantity: <?= $_SESSION['panier'][$product->id_produit]; ?></span>
                              </div>
                           </div>
                        </div>

                        
                        <div class="d-flex flex-row">
                          <?php if( isset($_SESSION['panier'][$product->id_produit])){ ?>
                          <a href="form.php?idp=<?=$idp;?>&m=m"> <button class="btn btn-link px-2" name="moins" type="button"
                              >
                              <i class="fas fa-minus"></i>
                            </button></a>

                            <input id="form1-<?=$idp?>" min="0" name="quantity" value="<?= $_SESSION['panier'][$product->id_produit]; ?>" type="number"
                              class="form-control form-control-sm" style="width: 50px;" >

                            <a href="form.php?idp=<?=$idp;?>&m=p"><button class="btn btn-link px-2" name="plus" type="button">
                              <i class="fas fa-plus"></i>
                            </button></a>
                          <?php }?>
                        </div>
                       

                      <?php
                        
                      ?>
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                         <a href="panier.php?del=<?= $product->id_produit; ?>" type="button" class="card-link-secondary small text-uppercase mr-3"><i
                         class="fas fa-trash-alt mr-1"></i> Remove item </a>
                        </div>
                        <p class="mb-0"><span><strong>Price: <?php echo number_format($product->Prix,2,',',''); ?> </strong></span></p>
                        <p class="mb-0"><span><strong>With reduction: <?php echo number_format($product->Prix-$product->Prix*$product->reduction/100 ,2,',',''); ?> </strong></span></p>
                    </div>
                    
                
                  </div>
                  
                 </div>
                 <hr class="mb-4">
                <?php endforeach  ?>
              </div>
              
            </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body">
            <p><strong>We accept</strong></p>
            <img class="me-2" width="45px"
              src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
              alt="Visa" />
            <img class="me-2" width="45px"
              src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
              alt="American Express" />
            <img class="me-2" width="45px"
              src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
              alt="Mastercard" />
            <img class="me-2" width="45px"
              src="https://mdbootstrap.com/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png"
              alt="PayPal acceptance mark" />
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Summary</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                TOTAL 
                <span> <?= number_format($panier->total(),2,',',''); ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <span>Gratis</span>
              </li>
            </ul>
            <a href="ajouterbase.php">
            <button type="button" class="btn btn-primary btn-lg btn-block">
              Go to checkout
            </button>
            </a>
          </div> 
        </div> 
      </div>
    </div>
</section>
</form>
</div>
</div>
<?php require_once "../Footer.php";?>