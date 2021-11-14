<?php
function accueilControleur($twig,$db){
    $form = array();
    $liste = array();
    $listeEmploye = array();
    $listeRole = array();
    $listeEmployeArchives = array();
    $listeEquipe = array();
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

    if(isset($_GET['activate'])){
        $id = $_GET['activate'];
        $employe = new Employe($db);
        $actuelEmploye = $employe->selectByID($id);
        if($actuelEmploye['estInactif'] == 0){
            $employe->updateEstInactif(1,$id);
        }else{
            $employe->updateEstInactif(0,$id);
        } 
        header("Location:?page=accueil&item=1");         
    }
    
    if (isset($_POST['inscription'])){
        $form['valide'] = true; 
        $employe = new Employe($db);
        $compte = new Compte($db);
        $inputNom = $_POST['inputNom'];
        $inputPrenom = $_POST['inputPrenom'];
        $inputEmail = $_POST['inputEmail'];
        $inputTel = $_POST['inputTel'];
        $selectRole = $_POST['selectRole'];
        $inputAdresse = $_POST['inputAdresse'];
        $inputAdresseBis = $_POST['inputAdresseBis'];
        $inputVille = $_POST['inputVille'];
        $inputCP = $_POST['inputCP'];
        $dateInscription = date('Y-m-d');
        $passwordGenerated = "123";
        $execCompte = $compte->insert($inputEmail,password_hash($passwordGenerated, PASSWORD_DEFAULT));
        if (!$execCompte){      
            $form['valide'] = false;            
            $form['message'] = 'Problème d\'insertion dans la table';
            exit;
        }else{
            $unCompte = $compte->getID($inputEmail);
            $execEmploye = $employe->insert($selectRole,$unCompte['id'],$inputNom,$inputPrenom,$inputAdresse,$inputAdresseBis,$inputVille,$inputTel,$inputCP,$dateInscription);
            if (!$execEmploye){          
                $form['valide'] = false;            
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
                exit;
            }
            var_dump($selectRole);
            if($selectRole == 1){
                $employeCree = $employe->selectByAccount($inputEmail);
                $dev = new Dev($db);
                $dev->insert($employeCree['id']);
            }
            $message = "
                    <html>
                    <head>
                    </head>
                    <body>
                    Création de votre compte du service Simpléduc effectuée.\n
                    Voici vos identifiants de connexion:\n
                    Adresse mail : ".$inputEmail."\n
                    Mot de passe : ".$passwordGenerated."
                    </body>
                    </html>";
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=utf-8';
            mail($inputEmail, 'Connexion à Simpleduc', $message, implode("\n", $headers));
            header("Location:index.php?page=accueil&item=1"); 
        }     
    }
    
    if($_SESSION['role'] == "Ressources Humaines"){
        $role = new Role($db);
        $employe = new Employe($db);
        $archive = new Archivage($db);
        $listeEmploye = $employe->mkUserList();
        $listeRole = $role->select();
        $listeEmployeArchives = $archive->selectEmploye();

        $limite=5;
        if(!isset($_GET['nopage'])){
            $inf=0;
            $nopage=0;
        }
        else{
            $nopage=$_GET['nopage'];
            $inf = $nopage * $limite;
        }

        $r = $archive->selectCount();
        $nb = $r['nb']; 
        $liste = $archive->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;


    }else if($_SESSION['role'] == "Chef de projet"){
        $equipe = new Equipe($db);
        $limite=5;
        if(!isset($_GET['nopage'])){
            $inf=0;
            $nopage=0;
        }
        else{
            $nopage=$_GET['nopage'];
            $inf = $nopage * $limite;
        }

        $r = $equipe->selectCount();
        $nb = $r['nb']; ;
        $liste = $equipe->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;
    }
    echo $twig->render('accueil.html.twig', array('form' => $form,'liste'=>$liste, 'listeEmploye' => $listeEmploye, 'listeRole' => $listeRole,'listeEmployeArchives'=>$listeEmployeArchives,'listeEquipe'=>$listeEquipe));
}
?>