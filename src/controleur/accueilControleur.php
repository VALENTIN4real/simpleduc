<?php
function accueilControleur($twig,$db){
    $form = array();
    if($_SESSION['login'] == null){
        header("Location:?page=connexion");     
    }
    if(isset($_GET['item'])){
        $form['item'] = $_GET['item'];
    }
    $role = new Role($db);
    $employe = new Employe($db);
    $listeEmploye = $employe->mkUserList();
    $listeRole = $role->select();
    if (isset($_POST['inscription'])){
        $form['valide'] = true; 
        $employe = new Employe($db);
        $compte = new Compte($db);
        $inputNom = $_POST['inputNom'];
        $inputPrenom = $_POST['inputPrenom'];
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $inputConfPassword = $_POST['inputConfPassword'];
        $inputTel = $_POST['inputTel'];
        $selectRole = $_POST['selectRole'];
        $inputAdresse = $_POST['inputAdresse'];
        $inputAdresseBis = $_POST['inputAdresseBis'];
        $inputRegion = $_POST['inputRegion'];
        $inputCP = $_POST['inputCP'];
        if($inputPassword == $inputConfPassword){
            $execCompte = $compte->insert($inputEmail,password_hash($inputPassword, PASSWORD_DEFAULT));
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
        }else {
            $form['valide'] = false;            
            $form['message'] = 'Les mots de passes ne concordent pas';
            header('Location:index.php?page=accueil&item=pageMetier');
            
        }
    }

  
    
    echo $twig->render('accueil.html.twig', array('form' => $form, 'listeEmploye' => $listeEmploye, 'listeRole' => $listeRole));
}
?>