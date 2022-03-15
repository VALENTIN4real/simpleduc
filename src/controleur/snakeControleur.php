<?php
function snakeControleur($twig,$db){
    $leaderboard = new Leaderboard($db);
    $listFacile = $leaderboard->selectFacileTops();
    $listMoyen = $leaderboard->selectMoyenTops();
    $listDifficile = $leaderboard->selectDifficileTops();
    if(isset($_POST['save'])){
        $inputNom = $_POST['nomJoueur'];
        if($inputNom == ""){
            $inputNom = "anonymous";
        }
        $difficulty = $_POST['difficulty'];
        $score = $_POST['score'];
        if($score > 99 || $score < 0){
            $score = 0;
        }
        $leaderboard = new Leaderboard($db);
        $leaderboard->insert($inputNom,$score,$difficulty);
        header('Location:?page=snake'); 
    }
    echo $twig->render('snake.html.twig', array('listFacile'=>$listFacile,'listMoyen'=>$listMoyen,'listDifficile'=>$listDifficile));
}
?>