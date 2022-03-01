<?php
function attribuerProjetControleur($twig,$db){
    $groupeChosen = array();
    $projet = new Projet($db);
    $projetActuel = array();
    $equipe = new Equipe($db);
    $listeEquipe = $equipe->getAllEquipes();
    $listeDevFromGroup = array();
    $projetActuel = $projet->getProjetByID($_GET['id']);
    if(isset($_GET['id'])){
        
    }
    if(isset($_GET['groupe'])){
        $groupeChosen['valide'] = true;
        $groupeChosen['id'] = $_GET['groupe'];
        $dev = new Dev($db);
        $listeDevFromGroup = $dev->getAllDevsFromAGroup($groupeChosen['id']);
        $id=$_GET['id'];
    }

    if(isset($_POST['attribuer'])){
        $selectGroupe = $_POST['groupeChosen'];
        $id = $_POST['idProjet'];
        $projet->update($id,$selectGroupe);
    }
   
    echo $twig->render('attribuerProjet.html.twig',array('projetActuel'=>$projetActuel,'listeEquipe'=>$listeEquipe,'groupeChosen'=>$groupeChosen,'listDev'=>$listeDevFromGroup));
}
?>