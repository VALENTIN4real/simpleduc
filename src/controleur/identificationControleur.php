<?php

function connexionControleur($twig){
    echo $twig->render('connexion.html.twig', array());
}

function ajoutUtilisateurControleur($twig){
    echo $twig->render('ajout-utilisateur.html.twig', array());
}
?>