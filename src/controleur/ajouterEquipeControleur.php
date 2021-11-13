<?php
function ajouterEquipeControleur($twig,$db){
    $dev = new Dev($db);
    $listeDev = $dev->getAllDevs();
    if(isset($_POST['createGroupe'])){
        var_dump($_POST['selectors']);
    }
    echo $twig->render('ajouterEquipe.html.twig',array('listeDev'=>$listeDev));
}
?>