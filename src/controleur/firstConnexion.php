<?php
function firstConnexionControleur($twig,$db){
    $form = array();
    $form['id'] = $_GET['id'];
    if($_SESSION != null){
        header("Location:index.php?page=accueil&item=1");
    }

    if(isset($_POST['modifier'])){
        $inputPassword = $_POST['inputPassword'];
        $inputConfPassword = $_POST['inputConfPassword'];;
        if($inputPassword == $inputConfPassword){
            $compte = new Compte($db);
            $exec = $compte->modifPassword(password_hash($inputPassword,PASSWORD_DEFAULT),$form['id']);
            $compte->updateConnexion($form['id']);
            header("Location:index.php?page=connexion");
        }else {
            $form['valide'] = false;
            $form['message'] = "Erreur dans les mots de passe";     
        }
    }
    
    echo $twig->render('firstConnexion.html.twig', array('form'=>$form));
}
?>