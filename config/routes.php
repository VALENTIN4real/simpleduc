<?php
function getPage($db){

    $lesPages['accueil'] = "accueilControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['maintenance'] = "maintenanceControleur";
    $lesPages['ajout-utilisateur'] = "ajoutUtilisateurControleur";
    $lesPages['profil'] = "profilControleur";
    $lesPages['liste-utilisateurs'] = "listeUtilisateurControleur";
    $lesPages['deconnexion'] = "deconnexionControleur";
    $lesPages['modif-utilisateur'] = "modifUtilisateurControleur";
    $lesPages['firstConnexion'] = "firstConnexionControleur";
    $lesPages['parametres'] = "parametresControleur";
    $lesPages['a2f'] = "a2fControleur";
    $lesPages['messagerie'] = "messagerieControleur";
    $lesPages['ajout-equipe'] = "ajouterEquipeControleur";
    $lesPages['fiche-de-paie'] = "ficheControleur";
    $lesPages['snake'] = "snakeControleur";
    $lesPages['attribuerProjet'] = "attribuerProjetControleur";

    if($db!=null){
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 'accueil';
        }
        if (isset($lesPages[$page])){
            $contenu = $lesPages[$page];
        }
        else{
            $contenu = $lesPages['accueil'];
        }

    }else{
       $contenu = $lesPages['maintenance'];
    } 

    return $contenu;
}
?>