var groupes = document.getElementById("groupes");
var id = document.getElementById("idProjet").innerText;
console.log(id);
groupes.addEventListener('change',function(){
  var groupeValue = groupes[groupes.selectedIndex].value;
    window.location.href = "https://s3-4223.nuage-peda.fr/index.php?page=attribuerProjet&id=2&groupe="+groupeValue;
  $("#groupeId").val(groupeValue);
});