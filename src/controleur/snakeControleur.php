<?php
function snakeControleur($twig,$db){
    $leaderboard = new Leaderboard($db);
    $listWinners = $leaderboard->selectTops();
    if(isset($_POST['save'])){
        $inputNom = $_POST['nomJoueur'];
        if($inputNom == ""){
            $inputNom = "anonymous";
        }
        $score = $_POST['score'];
        if($score > 99 || $score < 0){
            $score = 0;
        }
        $leaderboard = new Leaderboard($db);
        $leaderboard->insert($inputNom,$score);
        header('Location:?page=snake'); 
    }
    echo $twig->render('snake.html.twig', array('listWinners'=>$listWinners));
}
?>