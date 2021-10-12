<?php
function accueilControleur($twig,$db){
    $form = array();
    if($_SESSION['login'] == null){
        header("Location:?page=connexion");     
    }
    if(isset($_GET['item'])){
        $form['item'] = $_GET['item'];
    }
    $employe = new Employe($db);
    $listeEmploye = $employe->mkUserList();

    $role = new Role($db);
    $listeRole = $role->select();
    echo $twig->render('accueil.html.twig', array('form' => $form, 'listeEmploye' => $listeEmploye, 'listeRole' => $listeRole));
}
?>