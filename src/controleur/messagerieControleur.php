<?php
function messagerieControleur($twig,$db){
    $listeMessage = array();
    $employe = new Employe($db);
    $message = new Message($db);
    $employeActuel = $employe->selectByAccount($_SESSION['login']);
    $listeMessage = $message->getMessages($employeActuel['nom']);
   
    echo $twig->render('messagerie.html.twig', array('listeMessage'=>$listeMessage));
}
?>