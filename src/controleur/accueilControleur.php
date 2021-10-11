<?php
function accueilControleur($twig,$db){
    $form = array();
    if(isset($_GET['item'])){
        $form['item'] = $_GET['item'];
    }
    echo $twig->render('accueil.html.twig', array('form' => $form));
}
?>