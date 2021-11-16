$(document).ready(function () {
    var id;
    modalAccueil();
    modalMessagerie();
    addDevToEquipe();
    $(".close").click(function () {
        $("#myModal").modal('hide');
    })
    const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
    const format =  '&format=json';

    let zipcode = $('#codePostal');
    let city = $('#region');
    $('#codePostal').on('blur',function(){
        $(city).empty();
        let code = $(this).val();
        let url = apiUrl+code+format;
        fetch(url,{method: 'get'}).then(response => response.json()).then(results => {
            if(results.length > 1){
                $.each(results,function(key,value){
                $(city).append('<option value="'+value.nom+'">'+value.nom+'</option>');
                });
            }
        }).catch(err =>{
            console.log(err);
        });
    });


});

function modalAccueil() {
    $(".deleteButton").click(function () {
        $("#myModal").modal('show');
        id = $("#delbutton").val();
    })

    $("#perform").click(function () {
        window.location.href = "https://s3-4223.nuage-peda.fr/index.php?page=accueil&item=1&idDel=" + id;
    })
}

function modalMessagerie() {
    $("#newMessageButton").click(function () {
        $("#myModal").modal('show');
    })
}

function addDevToEquipe() {
    $("#buttonAdd").click(function () {
        var line = document.createElement("li");    
        var selector = document.createElement("select");
        selector.setAttribute('class', 'selectors');
        selector.setAttribute('name', 'selectors[]');
        var option;
        $("#selectModel").children().each(function (index) {
            if (isValueExisting(checkSelectors(), $("#selectModel").children()[index].innerText) == false) {         
                option = document.createElement("option");
                option.innerText = $("#selectModel").children()[index].innerText;
                option.value = $("#selectModel").children()[index].value;
                selector.append(option);
            }
        })
        if(selector.children.length > 0){
            line.append(selector);
            $("#listDev").append(line);
        }
    });
}

function checkSelectors() {
    var selectors = document.getElementsByClassName('selectors');
    var values = [];
    $.each(selectors, function (index) {
        console.log($(this).children(':selected').text());
        if (isValueExisting(values, $(this).children(':selected').text()) == false) {
            values[index] = $(this).children(':selected').text();
        }
    })
    return values;
}

function isValueExisting(array, value) {
    var verif = false;
    $.each(array, function (index) {
        if (array[index] == value) {
            verif = true;
        }
    })
    return verif;
}

