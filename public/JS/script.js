var play = document.getElementById("play");
var scoreText = document.getElementById("scoreText");
var difficulty = document.getElementById("difficulty");
scoreText.setAttribute("hidden",true);
var plateau = null;
var interval;
var timeOnPressed = null;
var timeStamp = Date.now();

play.addEventListener("click", function() {
    plateau = new Plateau(400, 400);
    scoreText.removeAttribute("hidden");
    nomJoueur.setAttribute("hidden",true);
    difficulty.setAttribute("hidden",true);
    play.setAttribute("hidden",true);
    window.addEventListener('keydown', onKeyPressed);
    play.setAttribute('disabled','disabled;')
    start(plateau);

});

function onKeyPressed(e) {
    timeOnPressed = Date.now();
    if (timeOnPressed - timeStamp > 100) {
        plateau.updatePos(e.keyCode);
        timeStamp = Date.now();
    }
}

function start(plateau){
    console.log(plateau.getDifficulty());
    if(plateau.getDifficulty() == 1){
        interval = setInterval(test,300);
    }else if(plateau.getDifficulty() == 2){
        interval = setInterval(test,200);
    }else {
        interval = setInterval(test,150);
    }
}

function test() {
    if (plateau.getGameOver() == true) {
        window.removeEventListener('keydown', onKeyPressed);
        $("#finalScore").val(plateau.getScore());
        $("#save").removeAttr("hidden");
        $("#replay").removeAttr("hidden");
        plateau.stop();
        clearInterval(interval);
    } else {
        plateau.moveAction();
    }

}