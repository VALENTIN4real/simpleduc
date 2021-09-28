<?php
function getPage(){
    $lesPages['accueil'] = "accueilControleur";
    $lesPages['connexion'] = "connexionControleur";
    
    $contenu = $lesPages['accueil'];
    return $contenu;
}
?>