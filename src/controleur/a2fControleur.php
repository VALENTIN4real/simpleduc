<?php
function a2fControleur($twig,$db){
    $form = array();
    $form['id'] = $_GET['id'];

    if(isset($_POST['inputA2F'])){
        $inputA2F = $_POST['inputA2F'];
        $compte = new Compte($db);
        $actuelCompte = $compte->getAnAccountByID($form['id']);
        if(password_verify($inputA2F,$actuelCompte['codeA2F'])){
            $employe = new Employe($db);
            $employeActuel = $employe->selectByAccount($actuelCompte['email']);
            $_SESSION['login'] = $actuelCompte['email'];                 
            $_SESSION['role'] = $employeActuel['libelle'];
            header("Location:index.php?page=accueil&item=pageMetier");
        }else {
            $form['valide'] = false;              
            $form['message'] = 'Code erroné, réessayer';          
        }
    }

    echo $twig->render('a2f.html.twig', array('form'=>$form));
}
?>