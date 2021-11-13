<?php
function messagerieControleur($twig,$db){
    $form = array();
    if(isset($_POST['envoi'])){
        $inputDestinataire = $_POST['destinataireInput'];
        $inputObjet = $_POST['objetInput'];
        $inputContenu= $_POST['contenuInput'];
        $message = new Message($db);
        $employe = new Employe($db);
        $employeActuel = $employe->selectByAccount($_SESSION['login']);
        $exec = $message->send($employeActuel['nom'],$inputDestinataire,$inputObjet,$inputContenu);
        if(!$exec){
            $form['message'] = 'Uwu';
        }
    }
    $listeMessage = array();
    $employe = new Employe($db);
    $message = new Message($db);
    $employeActuel = $employe->selectByAccount($_SESSION['login']);
    $listeMessage = $message->getMessages($employeActuel['nom']);
    $listeDestinataire = $employe->selectDestinataire($employeActuel['nom']);
    echo $twig->render('messagerie.html.twig', array('listeMessage'=>$listeMessage,'listeDestinataire'=>$listeDestinataire));

}
?>