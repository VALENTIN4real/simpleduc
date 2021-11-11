$(document).ready(function () {
    var id; 
    modalAccueil();
});

function modalAccueil(){
    $(".deleteButton").click(function () {
        $("#myModal").modal('show');
        id = $("#delbutton").val();
    })

    $(".perform").click(function () {
        window.location.href="https://s3-4223.nuage-peda.fr/index.php?page=accueil&item=1&idDel="+id;
    })

    $(".close").click(function () {
        $("#myModal").modal('hide');
    })
}

function modalMessagerie(){
    $("#newMessageButton").click(function () {
        $("#myModal").modal('show');
    })
}
