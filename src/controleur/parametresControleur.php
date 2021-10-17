<?php
function parametresControleur($twig,$db){
    $form = array();
    $compte = new Compte($db);
    if(isset($_POST['changes'])){
        if(isset($_POST['a2fCheckBox'])){
            $a2f = $_POST['a2fCheckBox'];
            $a2f = intval($a2f);
        }else{
            $a2f = 0; 
        }
        $compte->updateA2F($a2f,$_SESSION['login']);
    } 
    $actuelCompte = $compte->getAnAccount($_SESSION['login']);

    echo $twig->render('parametres.html.twig', array("actuelCompte"=>$actuelCompte));
}
?>