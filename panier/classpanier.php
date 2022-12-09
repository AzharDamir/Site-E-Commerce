<?php

class panier{
   private $DB;
   
 public function __construct($DB)
  {
      if(!isset($_SESSION)){
          session_start();
      } 
      if(!isset($_SESSION['panier'])){
          $_SESSION['panier'] = array();
      }
      $this->DB = $DB;
  }
public function count()
{
   return array_sum($_SESSION['panier']);
}

  public function recalc()
  {
      foreach($_SESSION['panier'] as $idp => $quantity){
         if (isset( $_POST['panier']['quantity'][$idp])) {
              $_SESSION['panier'][$idp] = $_POST['panier']['quantity'][$idp];
        //$_SESSION['panier'] = $_POST['panier']['quantity'];
         }
      }
  }

  public function total()
  {
     
     $total = 0;
     $ids = array_keys($_SESSION['panier']);
     if(empty($ids)){
    $products = array();
     }else{
    $req = $this->DB->query('SELECT id_produit, Prix, reduction FROM produit WHERE id_produit IN ('.implode(',',$ids).')');
    $products= $req->fetchAll(PDO::FETCH_OBJ);
     }
     foreach ($products as $product ) {
        $total += $_SESSION['panier'][$product->id_produit]*( $product->Prix-($product->Prix * $product->reduction/100));
     }
     return $total;
  }

  public function del($idp)
  {
      unset($_SESSION['panier'][$idp]);
  }

  public function add($idp)
  {
      if (isset($_SESSION['panier'][$idp])) {
        $_SESSION['panier'][$idp]++;
    }else {
        $_SESSION['panier'][$idp] = 1;
    }
  }
}

