<?php
function accueilControleur($twig,$db){
    $form = array();
    if($_SESSION['login'] == null){
        header("Location:?page=connexion");     
    }
    if(isset($_GET['item'])){
        $form['item'] = $_GET['item'];
    }
    var_dump($_SESSION['role']);
    echo $twig->render('accueil.html.twig', array('form' => $form));
}
?>