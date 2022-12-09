<?php
// require './panier/connexion.php';
// require_once './panier/classpanier.php';

// $panier = new panier ($DB);
?>

<div class="list-group list-group-flush my-3">
                <a href="http://localhost/PANIER1/index.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                 class="fab fa-shopify"></i> Produits</a>
                <a href="http://localhost/PANIER1/Produits/categorie.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                 class="fas fa-box"></i> Categories</a>
                <!-- <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                 class="fas fa-heart"></i> Wishlist</a> -->
               
                            <a href="http://localhost/PANIER1/panier/panier.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-shopping-cart me-2"></i><span id="cart-count" class="text-warning bg-light"><?php if(isset($_SESSION['Client'])) echo $panier->count(); ?></span> Panier</a>
                
                         <?php
                            if(!isset($_SESSION['Client']))
                            { 
                                     if(isset($_SESSION['admine'])){ ?>
                                    
                
                        
               
                         <a href="http://localhost/PANIER1/Clients/compte.php?idclient=<?=$_SESSION['admine']['id']; ?>" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                         class="fas fa-marker">Compte</i> </a>
                                    <a href="http://localhost/PANIER1/Clients/afficher.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" >
                                    <i class="fas fa-id-card-alt"> Client</i></a>
                                    <a href="http://localhost/PANIER1/Produits/CRUDcategorie.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" >
                                    <i class="fas fa-toolbox"> Categorie admine</i></a>
                                     <a href="http://localhost/PANIER1/Produits/CRUDproduits.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                      class="fas fa-shopping-bag"> Produit admin</i> </a>

                                    <a href="http://localhost/PANIER1/Clients/logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                            class="fas fa-sign-in-alt"> Logout</i> </a>

                                    <?php }else{?>
                                    <a href="http://localhost/PANIER1/Clients/login.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" >
                                    <i class="fas fa-angle-double-right"> Login</i></a>
                                    <a href="http://localhost/PANIER1/Clients/inscription.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                    class="fas fa-sign-in-alt"> Sign In</i> </a>
                                
                                <?php } }else{
                                    ?>

                                    <a href="http://localhost/PANIER1/Clients/logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" ><i
                                        class="fas fa-power-off me-2" >Logout</i></a>
                                        <a href="http://localhost/PANIER1/Clients/compte.php?idclient=<?=$_SESSION['Client']['id'];?>" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                         class="fas fa-users">Mon compte</i> </a>
                                          <a href="http://localhost/PANIER1/panier/ord_his.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                           class="fas fa-shopping-bag"> Mes commandes</i> </a>
                              <?php  }
                                
                         ?>
            </div>