<?php
    function connexionControleur($twig,$db){
        $form = array();
        if (isset($_POST['connexion'])){    
            $form['valide'] = true;   
            $inputEmail = $_POST['inputEmail'];      
            $inputPassword = $_POST['inputPassword']; 
            $employe = new Employe($db);        
            $unEmploye = $employe->connect($inputEmail);
            if ($unEmploye!=null){ 
                if(!password_verify($inputPassword,$unEmploye['mdp'])){
                    $form['valide'] = false;              
                    $form['message'] = 'Login ou mot de passe incorrect';          
                }else{
                    $compte = new Compte($db);
                    $firstConnexion = $compte->getFirstConnexion($inputEmail);
                    $firstConnexion = $firstConnexion[0];
                    $firstConnexion = intval($firstConnexion);
                    $idCompte = $compte->getID($inputEmail);
                    if($firstConnexion == 1){
                        header("Location:index.php?page=firstConnexion&id=".$idCompte['id']);
                    }else {
                        $_SESSION['login'] = $inputEmail;                 
                        $_SESSION['role'] = $unEmploye['libelle'];
                        header("Location:index.php?page=accueil&item=pageMetier");
                    }      
                }         
            }        
            else{     
                $form['valide'] = false;           
                $form['message'] = 'Login ou mot de passe incorrect';         
            }
    }
    echo $twig->render('connexion.html.twig', array('form'=>$form));
}



function deconnexionControleur($twig, $db){
    session_unset();   
    session_destroy();    
    header("Location:index.php");
}

?>