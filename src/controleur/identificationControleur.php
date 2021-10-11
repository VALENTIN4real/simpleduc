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
                if($inputPassword != $unEmploye['mdp']){
                    $form['valide'] = false;              
                    $form['message'] = 'Login ou mot de passe incorrect';          
                }else{
                    $_SESSION['login'] = $inputEmail;                 
                    $_SESSION['role'] = $unEmploye['idRole'];
                    header("Location:index.php");     
                }         
            }        
            else{     
                $form['valide'] = false;           
                $form['message'] = 'Login ou mot de passe incorrect';         
            }
    }
    echo $twig->render('connexion.html.twig', array('form'=>$form));
}

function ajoutUtilisateurControleur($twig){
    echo $twig->render('ajout-utilisateur.html.twig', array());
}

function listeUtilisateurControleur($twig){
    echo $twig->render('liste-utilisateur.html.twig', array());
}
?>