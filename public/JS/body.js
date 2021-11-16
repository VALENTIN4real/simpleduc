class Body {
    constructor(x, y, ctx) {
        this.x = x;
        this.y = y;
        this.width = 40;
        this.height = 40;
        this.parent = null;
        this.oldPosX = 0;
        this.oldPosY = 0;
        this.movement = null;
    }

    getMovement() {
        return this.movement;
    }

    setMovement(movement) {
        this.movement = movement;
    }

    getWidth() {
        return this.width;
    }

    getHeight() {
        return this.height;
    }

    getX() {
        return this.x;
    }

    getY() {
        return this.y;
    }

    setX(x) {
        this.x = x;
    }

    setY(y) {
        this.y = y;
    }

    getOldPosX() {
        return this.oldPosX;
    }

    getOldPosY() {
        return this.oldPosY;
    }

    setOldPosX(x) {
        this.oldPosX = x;
    }

    setOldPosY(y) {
        this.oldPosY = y;
    }

    getParent() {
        return this.parent;
    }

    setParent(parent) {
        this.parent = parent;
    }

    getCoordinates() {
        var position = [];
        position[0] = this.getX();
        position[1] = this.getY();
        return position;
    }
}