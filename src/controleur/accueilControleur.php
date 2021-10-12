<?php
function accueilControleur($twig,$db){
    $form = array();
    if($_SESSION['login'] == null){
        header("Location:?page=connexion");     
    }
    if(isset($_GET['item'])){
        $form['item'] = $_GET['item'];
    }
<<<<<<< HEAD
    echo $twig->render('accueil.html.twig', array('form' => $form));
=======
    $employe = new Employe($db);
    $listeEmploye = $employe->mkUserList();

    $role = new Role($db);
    $listeRole = $role->select();
    echo $twig->render('accueil.html.twig', array('form' => $form, 'listeEmploye' => $listeEmploye, 'listeRole' => $listeRole));
>>>>>>> bccdb4303cafad453508b6628e3ff4b1d0ac0096
}
?>