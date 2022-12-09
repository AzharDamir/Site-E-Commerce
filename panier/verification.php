<?php 
  session_start();
    require("./connexion.php");
    
    
    $email = $_POST['email'];
    $mdp = $_POST['pass'];


  /*  query($sql, $data = array()){
        $req =$this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);*/

   // $compte = $DB->query("SELECT * from client where email = '$email' && password = '$mdp' ");
 
    $select = "SELECT * from client where email = '$email' && password = '$mdp' ";
    $res = $DB->prepare($select);
    $res->execute();
    $compte=$res->fetchAll(PDO::FETCH_OBJ);
 
    //var_dump($compte);
   
    if(!empty($compte))
    {
        $_SESSION['Id_client'] = $compte[0]->email;
        header('location:index.php');
        //echo $_SESSION['id_client'];
       // header('location:AffichageProdPrinc.php');
    }else{
        echo 'no accesse';
        //header('location:Auth.php');
    
    }


   /* if(empty($compte)){ header();}
    else 
        if($mdp!= $compte->mdp)
        {
            echo 'mot de passe faux ';
        }
        else 
        {
            session_start();
        }
        header("AffichageProdPrinc.php");
        header('location:login.php');*/
?>