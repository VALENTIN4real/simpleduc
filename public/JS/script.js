function test() {
    var x = document.getElementById("selectEtat").value;

    if (x == 0) {
        x = 1;
    } else if (x = 1) {
        x = 0;
    } else
        alert("error");

    document.getElementById("selectEtat").value = x;
}