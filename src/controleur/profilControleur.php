<?php
function profilControleur($twig,$db){
    $form = array();
    if($_SESSION['login'] != null){
        $employe = new Employe($db);
        $employeActuel = $employe->selectByAccount($_SESSION['login']);
    }
    echo $twig->render('profil.html.twig', array('employe' => $employeActuel));
}
?>