class Plateau {
    constructor() {
        this.canvas = document.getElementById("canvas");
        this.scoreText = document.getElementById("score");
        this.canvas.setAttribute('width', 400);
        this.canvas.setAttribute('height', 400);
        this.ctx = canvas.getContext('2d');
        this.ctx.fillStyle = "#000000";
        this.ctx.fillRect(0, 0, 400, 400);
        this.plateau = [];
        this.difficulty = document.getElementById("difficulty").value;
        this.gameover = false;
        this.eaten = false;
        this.head = new Head(this.ctx);
        this.snake = [this.head];
        this.bodyColor = this.generateRandomColors();
        this.restart();


    }

    getDifficulty(){
        return this.difficulty;
    }

    getScore() {
        return this.score;
    }

    getGameOver() {
        return this.gameover;
    }

    initHead() {
        this.head.setX(1);
        this.head.setY(1);
        this.plateau[this.head.getY()][this.head.getX()] = this.head;
        this.clearCTX();

    }

    getPlateau() {
        return this.plateau;
    }

    displayOnBoard(head) {
        if (head instanceof Graille) {
            this.ctx.fillStyle = "#FF0000";
        } else if (head instanceof Head) {
            this.ctx.fillStyle = "#FFAA00";
        } else {
            this.ctx.fillStyle = this.bodyColor;
            
        }
        this.ctx.fillRect(head.getX() * head.getWidth(), head.getY() * head.getHeight(), head.getWidth(), head.getHeight());
    }

    updatePos(keycode) {
        if ((keycode == 68 || keycode == 39)  && this.head.getMovement() != "left") {
            this.head.movement = "right";
        }
        if ((keycode == 81 || keycode == 37)  && this.head.getMovement() != "right") {
            this.head.movement = "left";
        }
        if ((keycode == 83 || keycode == 40) && this.head.getMovement() != "up") {
            this.head.movement = "down";
        }
        if ((keycode == 90 || keycode == 38) && this.head.getMovement() != "down") {
            this.head.movement = "up";
        }     
    }

    clearCTX() {
        this.ctx.clearRect(0, 0, canvas.width, canvas.height);
        this.ctx.fillStyle = "#000000";
        this.ctx.fillRect(0, 0, 400, 400);
        for (let i = 0; i < this.plateau.length; i++) {
            for (let j = 0; j < this.plateau[i].length; j++) {
                if (this.plateau[i][j] != 0) {
                    this.displayOnBoard(this.plateau[i][j]);
                }
            }
        }
    }

    spawnViande() {
        var coords = this.getAvailableCoords();
        var graille = new Graille();
        graille.setX(coords[0]);
        graille.setY(coords[1]);
        this.plateau[coords[1]][coords[0]] = graille;
        this.displayOnBoard(graille);
    }

    checkMovement(nextCase) {
        if (nextCase instanceof Graille) {
            this.score++;
            this.scoreText.innerText = this.score;
            this.addBodyPart();
            this.eaten = true;
            return true;
        } else if (nextCase instanceof Body) {
            return false;
        } else {
            return true;
        }

    }

    removeOldPositionHead() {
        for (let i = 0; i < this.plateau.length; i++) {
            for (let j = 0; j < this.plateau[i].length; j++) {
                if (this.plateau[i][j] instanceof Head) {
                    this.plateau[i][j] = 0;
                }
            }
        }
    }

    addBodyPart() {
        var x, y;
        var lastBody;
        if (this.snake.length > 1) {
            lastBody = this.snake[this.snake.length - 1];
            if (lastBody.getMovement() == "right") {
                x = lastBody.getX() - 1;
                y = lastBody.getY();
            } else if (lastBody.getMovement() == "left") {
                x = lastBody.getX() + 1;
                y = lastBody.getY();

            } else if (lastBody.getMovement() == "up") {
                x = lastBody.getX();
                y = lastBody.getY() + 1;
            } else {
                x = lastBody.getX();
                y = lastBody.getY() - 1;
            }
        } else {
            if (this.movement == "right") {
                x = this.head.getX() - 1;
                y = this.head.getY();
            } else if (this.movement == "left") {
                x = this.head.getX() + 1;
                y = this.head.getY();
            } else if (this.movement == "up") {
                x = this.head.getX();
                y = this.head.getY() + 1;
            } else {
                x = this.head.getX();
                y = this.head.getY() - 1;
            }
        }
        if (x < 0 || y < 0 || x > 9 || y > 9) {
            var coords = this.correctSpawnBody();
            x = coords[0];
            y = coords[1];
        }

        var body = new Body(x, y, this.ctx);

        body.setParent(this.snake[this.snake.length - 1]);

        body.setMovement(this.getMovementFromParent(body));

        this.snake.push(body);


        this.plateau[body.getY()][body.getX()] = body;
    }

    updateBodyPos() {
        this.snake.forEach(body => {
            if (!(body instanceof Head)) {
                this.plateau[body.getY()][body.getX()] = 0;
                body.setOldPosX(body.getX());
                body.setOldPosY(body.getY());
                body.setX(body.getParent().getOldPosX());
                body.setY(body.getParent().getOldPosY());
                body.setMovement(this.getMovementFromParent(body));
                this.plateau[body.getParent().getOldPosY()][body.getParent().getOldPosX()] = body;
                this.displayOnBoard(body);
            }
        });
    }

    getAvailableCoords() {
        var verif = false;
        var x;
        var y;
        do {
            x = this.getRandomInt(10);
            y = this.getRandomInt(10);
            if (this.plateau[y][x] == 0) {

                verif = true;
            }
        } while (!verif);


        return [x, y];

    }

    getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }


    restart() {
        for (let i = 0; i < 10; i++) {
            var table = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            this.plateau[i] = table;
        }
        this.initHead();
        this.spawnViande();
        this.snake = [this.head];
        this.score = 0;
        this.scoreText.innerText = this.score;
        this.gameover = false;

    }

    getMovementFromParent(body) {
        var parent = body.getParent();
        var movement = "";
        if (parent.getX() - body.getX() == -1) {
            movement = "left";
        } else if (parent.getX() - body.getX() == 1) {
            movement = "right";
        } else if (parent.getY() - body.getY() == -1) {
            movement = "up";
        } else {
            movement = "down";
        }
        return movement;

    }

    correctSpawnBody() {
        var lastBody = this.snake[this.snake.length - 1];
        var coords;
        for (let i = -1; i <= 1; i++) {
            for (let j = -1; j <= 1; j++) {
                if (lastBody.getX() + j >= 0 && lastBody.getX() + j <= 9 && lastBody.getY() + i >= 0 && lastBody.getY() + i <= 9) {
                    if (this.plateau[lastBody.getY() + i][lastBody.getX() + j] == 0) {
                        coords = [lastBody.getX() + j, lastBody.getY() + i];
                        break;
                    }

                }
            }
        }
        return coords;

    }


    gameOver() {
        alert("Votre score est de: " + this.score + "!\n Votre score est ajouté au leaderboard!");
        this.gameover = true;

    }

    moveAction() {
        this.head.setOldPosX(this.head.getX());
        this.head.setOldPosY(this.head.getY());

        if (this.head.getMovement() == "right") {
            this.head.setX(this.head.getX() + 1);
        } else if (this.head.getMovement() == "left") {
            this.head.setX(this.head.getX() - 1);
        } else if (this.head.getMovement() == "down") {
            this.head.setY(this.head.getY() + 1);
        } else {
            this.head.setY(this.head.getY() - 1);
        }
        if (this.head.getY() < 0 || this.head.getY() > 9 || this.head.getX() < 0 || this.head.getX() > 9) {
            this.gameOver();

        } else {
            var laCase = this.plateau[this.head.getY()][this.head.getX()];
            this.removeOldPositionHead();
            if (this.checkMovement(laCase)) {
                this.plateau[this.head.getY()][this.head.getX()] = this.head;
                this.updateBodyPos();
                if (this.eaten == true) {
                    this.spawnViande();
                    this.eaten = false;
                }
                this.clearCTX();
            } else {
                this.gameOver();

            }
        }
        this.clearCTX();
    }

    stop(){
        for (let i = 0; i < 10; i++) {
            var table = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            this.plateau[i] = table;
        }
        this.clearCTX();
    }

    generateRandomColors(){
        var colorsToNotTake = ["#FFAA00","#FF0000","#000000"];
        var colorBody = null;
        var verif = null;
        do{
            verif = true;
            colorBody = "#"+Math.floor(Math.random()*16777215).toString(16);
            colorsToNotTake.forEach(function(color){
                if(color == colorBody){
                    verif = false;    
                }
            });
        }while(!verif);

        return colorBody;
       
    }


}