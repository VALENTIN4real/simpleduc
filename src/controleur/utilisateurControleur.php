<?php
    function ajoutUtilisateurControleur($twig,$db){
        
        echo $twig->render('ajout-utilisateur.html.twig');
    }

    function listeUtilisateurControleur($twig, $db){
        $form = array();
        $employe = new Employe($db);
    
        $listeEmploye = $employe->mkUserList();
        echo $twig->render('liste-utilisateur.html.twig', array('form'=>$form, 'listeEmploye'=>$listeEmploye));
    }

    function listeUtilisateurControleurIna($twig, $db){
        $form = array();
        $employe = new Employe($db);
    
        $listeEmployeIna = $employe->mkUserListIna();
        echo $twig->render('liste-utilisateur.html.twig', array('form'=>$form, 'listeEmployeIna'=>$listeEmployeIna));
    }

    function modifUtilisateurControleur($twig, $db){
        $form = array();
        $role = new Role($db);
        $listeRole = $role->select();
        $employe = new Employe($db);
        if(isset($_GET['id'])){
            $unEmploye = $employe->selectByID($_GET['id']);
            
        }

        if(isset($_POST['modification'])){
            $inputNom = $_POST['inputNom'];
            $inputPrenom = $_POST['inputPrenom'];
            $inputEmail = $_POST['inputEmail'];
            $inputAdresse = $_POST['inputAdresse'];
            $inputAdresseBis = $_POST['inputAdresseBis'];
            $selectRole = $_POST['selectRole'];
            $inputCP = $_POST['inputCP'];
            $inputTel = $_POST['inputTel'];
            $inputRegion = $_POST['inputRegion'];
            $id = $_POST['id'];
            

            $exec = $employe->update($selectRole,$inputNom,$inputPrenom,$inputAdresse,$inputAdresseBis,$inputRegion,$inputTel,$inputCP,$inputEmail,$id);
                
            if (!$exec){          
                    $form['valide'] = false;            
                    $form['message'] = 'Erreur de modif';
                    exit;        
                }else{
                    header('Location:index.php?page=accueil&item=pageMetier');
                }
        }
        echo $twig->render('modif-utilisateur.html.twig', array('employe'=>$unEmploye,'listeRole'=>$listeRole));
    }
?>