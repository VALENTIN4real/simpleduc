var play = document.getElementById("play");
var scoreText = document.getElementById("scoreText");
scoreText.setAttribute("hidden",true);
var plateau = null;
var interval;
var timeOnPressed = null;
var timeStamp = Date.now();

play.addEventListener("click",function(){
    plateau = new Plateau(400, 400);
    scoreText.removeAttribute("hidden");
    nomJoueur.setAttribute("hidden",true);
    play.setAttribute("hidden",true);
    window.addEventListener('keydown', onKeyPressed);
    play.setAttribute('disabled','disabled;')
    start();

});

function onKeyPressed(e){
    timeOnPressed = Date.now();
    if(timeOnPressed - timeStamp > 100){
        plateau.updatePos(e.keyCode);
        timeStamp = Date.now();
    }
}

function start(){
   interval = setInterval(test,300);
}

function test(){
    if(plateau.getGameOver() == true){
        window.removeEventListener('keydown',onKeyPressed);
        $("#finalScore").val(plateau.getScore());
        $("#save").removeAttr("hidden");
        plateau.stop();
        clearInterval(interval);
    }else {
        plateau.moveAction();
    }
    
}