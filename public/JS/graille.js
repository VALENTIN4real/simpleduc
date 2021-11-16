class Graille {
    constructor(ctx) {
        this.ctx = ctx;
        this.width = 40;
        this.height = 40;
        this.x = 0;
        this.y = 0;
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

    getCoordinates() {
        var position = [];
        position[0] = this.getX();
        position[1] = this.getY();
        return position;
    }
}