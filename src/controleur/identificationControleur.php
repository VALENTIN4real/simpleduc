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

function ajoutUtilisateurControleur($twig,$db){
    $role = new Role($db);
    $listeRole = $role->select();
    $form = array();
    if (isset($_POST['inscription'])){
        $employe = new Employe($db);
        $compte = new Compte($db);
        $inputNom = $_POST['inputNom'];
        $inputPrenom = $_POST['inputPrenom'];
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $inputTel = $_POST['inputTel'];
        $selectRole = $_POST['selectRole'];
        $inputAdresse = $_POST['inputAdresse'];
        $inputAdresseBis = $_POST['inputAdresseBis'];
        $inputRegion = $_POST['inputRegion'];
        $inputCP = $_POST['inputCP'];
        $execCompte = $compte->insert($inputEmail,$inputPassword);
        if($execCompte){
            $unCompte = $compte->getbyID($inputEmail);
            $execEmploye = $employe->insert($selectRole,$unCompte['id'],$inputNom,$inputPrenom,$inputAdresse,$inputAdresseBis,$inputRegion,$inputTel,$inputCP);
            if (!$execEmploye){          
                $form['valide'] = false;            
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
                exit;        
            }else{
                header('Location:index.php?page=accueil');
            }
        }
        
    }
    echo $twig->render('ajout-utilisateur.html.twig', array('listeRole' => $listeRole, 'form'=>$form));
}

function listeUtilisateurControleur($twig, $db){
    $form = array();
    $employe = new Employe($db);

    $listeEmploye = $employe->mkUserList();
    echo $twig->render('liste-utilisateur.html.twig', array('form'=>$form, 'listeEmploye'=>$listeEmploye));
}
?>