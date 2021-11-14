<?php
function ajouterEquipeControleur($twig,$db){
    $adev = new Dev($db);
    $form = array();
    $listeDev = $adev->getAllDevs();
    if(isset($_POST['createGroupe'])){
        $inputNomEquipe = $_POST['inputNom'];

        $x = 2;
        if(isset($_POST['selectors'])){
            $devAffectes = $_POST['selectors'];
        }
        
        $equipe = new Equipe($db);
        $equipe->insert($inputNomEquipe);
        $equipeCreee = $equipe->getByNom($inputNomEquipe);
        if(isset($devAffectes)){
            $associer = new AssocierEquipe($db);
            foreach($devAffectes as &$dev){
               $associer->insert($dev,$equipeCreee['id']);
            }
        }
        header('Location: ?page=accueil&item=2');    
    }
   
    echo $twig->render('ajouterEquipe.html.twig',array('form'=>$form,'listeDev'=>$listeDev));
}
?>