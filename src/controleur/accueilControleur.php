<?php
function accueilControleur($twig,$db){
    $form = array();

    if($_SESSION['login'] == null){
        header("Location:?page=connexion");     
    }
    if(isset($_GET['item'])){
        $form['item'] = $_GET['item'];
    }

    if(isset($_GET['idDel'])){
        $id = $_GET['idDel'];
        $employe = new Employe($db);
        $idCompte = $employe->getIDAccount($id);
        $idCompte = intval($idCompte[0],10);
        $employe->delete($id);
        $compte = new Compte($db);
        $compte->delete($idCompte);

        $form['valide'] = true;            
        $form['message'] = 'Employé supprimé';

        header("Location:?page=accueil&item=1");  
                    
    }
    
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
        $dateInscription = date('Y-m-d');
        if($inputPassword == $inputConfPassword){
            $execCompte = $compte->insert($inputEmail,password_hash($inputPassword, PASSWORD_DEFAULT));
            if (!$execCompte){      
                $form['valide'] = false;            
                $form['message'] = 'Problème d\'insertion dans la table';
                exit;
            }else{
                $unCompte = $compte->getID($inputEmail);
                $execEmploye = $employe->insert($selectRole,$unCompte['id'],$inputNom,$inputPrenom,$inputAdresse,$inputAdresseBis,$inputRegion,$inputTel,$inputCP,$dateInscription);
                if (!$execEmploye){          
                    $form['valide'] = false;            
                    $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
                    exit;
                }
                header("Location:index.php?page=accueil&item=1"); 
            }     
        }else {
            $form['valide'] = false;
            $form['message'] = 'UWU ';
            header("Location:index.php?page=accueil&item=1"); 
        }
    }
    $role = new Role($db);
    $employe = new Employe($db);
    $archive = new Archivage($db);
    $listeEmploye = $employe->mkUserList();
    $listeRole = $role->select();
    $listeEmployeArchives = $archive->selectEmploye();

    echo $twig->render('accueil.html.twig', array('form' => $form, 'listeEmploye' => $listeEmploye, 'listeRole' => $listeRole,'listeEmployeArchives'=>$listeEmployeArchives));
}
?>